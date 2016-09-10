<?php

namespace App\Http\Controllers;

use App\Bandeau;
use App\Http\Requests;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class AdminBandeauController extends AbstractAdminController
{

    public function __construct() {
        parent::__construct();
        $this->addBreadcrumb("Gestion Bandeau", URL::route('admin_bandeau'));
    }

    public function index() {
        $bandeaux = Bandeau::orderBy('date_create_sb', "ASC")
            ->orderBy('date_fin_sb', "DESC")
            ->get();

        return view('backend.bandeau.index', ["bandeaux" => $bandeaux]);
    }

    public function edit($id) {
        $bandeau = Bandeau::findOrFail($id);
        $this->addBreadcrumb("Modifier un Bandeau", URL::route('admin_bandeau.edit', $id));
        return view('backend.bandeau.bandeau', ["action" => "edit", "bandeau" => $bandeau]);
    }

    public function update(Request $request, $id) {

        $validator = Validator::make($request->all(), [
            'message' => 'required|max:250',
            'date_fin' => 'date_format:d/m/Y'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin_bandeau.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $bandeau = Bandeau::findOrFail($id);
        $bandeau->libelle_sb = Input::get('message');
        $date = null;
        if (!empty(Input::get('date_fin'))) {
            $date = date_format(date_create_from_format('d/m/Y', Input::get('date_fin')), 'Y-m-d');

        }
        $bandeau->date_fin_sb = $date;
        $bandeau->save();

        // success
        Session::flash('flash_message', 'Bandeau modifié avec succès.');
        Session::flash('flash_type', 'success');

        return redirect()->route('admin_bandeau');
    }

    public function create() {
        $bandeau = new Bandeau();
        $this->addBreadcrumb("Créer un Bandeau", URL::route('admin_bandeau.create'));
        return view('backend.bandeau.bandeau', ["action" => "create", "bandeau" => $bandeau]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'message' => 'required|max:250',
            'date_fin' => 'date_format:d/m/Y'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin_bandeau.create')
                ->withErrors($validator)
                ->withInput();
        }

        $bandeau = new Bandeau();
        $bandeau->libelle_sb = Input::get('message');
        $date = null;
        if (!empty(Input::get('date_fin'))) {
            $date = date_format(date_create_from_format('d/m/Y', Input::get('date_fin')), 'Y-m-d');

        }
        $bandeau->date_fin_sb = $date;
        $bandeau->save();

        // success
        Session::flash('flash_message', 'Bandeau créé avec succès.');
        Session::flash('flash_type', 'success');

        return redirect()->route('admin_bandeau');
    }

    public function remove($id) {

        try {
            $bandeau = Bandeau::findOrFail($id);
            $bandeau->delete();
            return Response::json(true, 200);
        } catch (ModelNotFoundException $ex) {
            return Response::json(false, 200);
        }

    }
}
