<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class AdminSettingsController extends AbstractAdminController
{
    public function __construct() {
        parent::__construct();
        $this->addBreadcrumb("Paramètres", URL::route('admin_settings'));
    }

    public function index() {
        $information = Session::get('informations');
        $user = Auth::user();

        return view('backend.settings', ["informations" => $information, "user" => $user]);
    }

    public function editSalle(Request $request) {

        $validator = Validator::make($request->all(), [
            'email' => 'email|required',
            'phone' => 'required|max:20',
            'adresse' => 'required|max:100'
        ]);

        if ($validator->fails()) {
            return redirect()->to(route('admin_settings').'?type=info_salle#info_salle')
                ->withErrors($validator)
                ->withInput();
        }

        // success
        Session::flash('flash_message', 'Les informations sont modifiés avec succès');
        Session::flash('flash_type', 'success');

        $information = Session::get('informations');
        $information->tel_salle = Input::get('phone');
        $information->adresse_salle = Input::get('adresse');
        $information->mail_salle = Input::get('email');
        $information->save();

        return redirect()->route('admin_settings');
    }
}
