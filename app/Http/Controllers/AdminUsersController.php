<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Role;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class AdminUsersController extends AbstractAdminController
{

    public function __construct() {
        parent::__construct();
        $this->addBreadcrumb("Gestion des utilisateurs", URL::route('admin_users'));
    }

    public function index() {
        $users = User::all();
        return view('backend.users.index', ["users" => $users]);
    }

    public function activate($id) {
        try {
            $user = User::findOrFail($id);

            if (!Auth::user()->hasRole('root')) {
                return Response::json(["error" => true, "message" => "Droits insuffisants"], 200);
            }

            $user->enabled = 1;
            $user->save();

            return Response::json(["error" => false], 200);
        } catch (ModelNotFoundException $ex) {
            return Response::json(["error" => true, "message" => "Utilisateur inconnu"], 200);
        }
    }

    public function desactivate($id) {
        try {
            $user = User::findOrFail($id);

            if (!Auth::user()->hasRole('root')) {
                return Response::json(["error" => true, "message" => "Droits insuffisants"], 200);
            }

            if (Auth::user()->id == $id) {
                return Response::json(["error" => true, "message" => "Vous ne pouvez pas vous désactiver"], 200);
            }

            $user->enabled = 0;
            $user->save();

            return Response::json(["error" => false], 200);
        } catch (ModelNotFoundException $ex) {
            return Response::json(["error" => true, "message" => "Utilisateur inconnu"], 200);
        }
    }

    public function edit($id) {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $this->addBreadcrumb("Modifier l'utilisateur", URL::route('admin_users.edit', $id));
        return view('backend.users.user', ["action" => "edit", "user" => $user, "roles" => $roles]);
    }

    public function update(Request $request, $id) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:150',
            'email' => 'required|email|unique:users,email,'.$id,
            'enabled' => 'required',
            'roles'  => 'required|array'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin_users.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::findOrFail($id);
        $user->email = Input::get('email');
        $user->name = Input::get('name');
        $user->enabled = Input::get('enabled');
        $user->save();

        $user->removeAllRoles();

        foreach (Input::get('roles') as $role) {
            $user->assignRole($role);
        }

        // success
        Session::flash('flash_message', 'Utilisateur modifié avec succès.');
        Session::flash('flash_type', 'success');

        return redirect()->route('admin_users');
    }

    public function create() {
        $user = new User();
        $roles = Role::all();
        $this->addBreadcrumb("Créer un utilisateur", URL::route('admin_users.create'));
        return view('backend.users.user', ["action" => "create", "user" => $user, "roles" => $roles]);
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:150',
            'email' => 'required|email|unique:users,email',
            'enabled' => 'required',
            'roles'  => 'required|array'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin_users.create')
                ->withErrors($validator)
                ->withInput();
        }

        $user = new User();
        $user->email = Input::get('email');
        $user->name = Input::get('name');
        $user->enabled = Input::get('enabled');
        $randomPassword = $this->generateRandomPassword();
        $user->password = bcrypt($randomPassword);
        $user->save();

        foreach (Input::get('roles') as $role) {
            $user->assignRole($role);
        }

        // success
        Session::flash('flash_message', 'Utilisateur créé avec succès.');
        Session::flash('flash_type', 'success');

        return redirect()->route('admin_users');
    }

    private function generateRandomPassword() {
        $char = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $charLong = "";

        for ($i = 0; $i < 30; $i++) {
            $charLong .= $char;
            $charLong = str_shuffle($charLong);
        }

        $chaineAleatoire = substr($charLong, 0, 20);

        return $chaineAleatoire;
    }
}
