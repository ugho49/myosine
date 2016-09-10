<?php

namespace App\Http\Controllers;

use App\HoraireCours;
use App\Http\Requests;
use App\TypeCours;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class AdminHorairesTypeCoursController extends AbstractAdminController
{
    public function __construct() {
        parent::__construct();
        $this->addBreadcrumb("Gestion des horaires de cours", URL::route('admin_horaire_cours'));
        $this->addBreadcrumb("Gestion des types de cours", URL::route('admin_type_cours'));
    }

    public function index() {
        $types = TypeCours::all();
        return view('backend.horaires.cours.type.index', ["types" => $types]);
    }

    public function edit($id) {
        $type = TypeCours::findOrFail($id);
        $this->addBreadcrumb("Modifier un type de cours", URL::route('admin_type_cours.edit', $id));
        return view('backend.horaires.cours.type.type', ["action" => "edit", "type" => $type]);
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'libelle' => 'required|max:100'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin_type_cours.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $type = TypeCours::findOrFail($id);
        $type->libelle_typeC = Input::get('libelle');
        $type->save();

        // success
        Session::flash('flash_message', 'Cours modifié avec succès.');
        Session::flash('flash_type', 'success');

        return redirect()->route('admin_type_cours');
    }

    public function create() {
        $type = new TypeCours();
        $this->addBreadcrumb("Créer un type de cours", URL::route('admin_type_cours.create'));
        return view('backend.horaires.cours.type.type', ["action" => "create", "type" => $type]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'libelle' => 'required|max:100'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin_type_cours.create')
                ->withErrors($validator)
                ->withInput();
        }

        $type = new TypeCours();
        $type->libelle_typeC = Input::get('libelle');
        $type->save();

        // success
        Session::flash('flash_message', 'Cours créé avec succès.');
        Session::flash('flash_type', 'success');

        return redirect()->route('admin_type_cours');
    }

    public function remove($id) {

        try {
            $type = TypeCours::findOrFail($id);

            $horairesCours = HoraireCours::where('id_typeC', $id)->get();

            // Si le type est assigné à un ou plusieurs horaire, impossible de le supprimer
            if (count($horairesCours) > 0) {
                return Response::json(["error" => true, "message" => "Impossible de supprimer ce type, des horaires possède ce type de cours."], 200);
            }

            $type->delete();
            return Response::json(["error" => false], 200);
        } catch (ModelNotFoundException $ex) {
            return Response::json(["error" => true, "message" => "Type de cours innexistant en base"], 200);
        }

    }
}
