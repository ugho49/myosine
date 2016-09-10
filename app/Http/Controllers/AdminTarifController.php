<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Tarif;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminTarifController extends Controller
{
    public function index() {
        $tarifs = Tarif::orderBy(DB::raw("substr(nom_tarif,1,1)"))
            ->orderBy("prix_tarif")
            ->get();

        return view('backend.tarifs.index', ["tarifs" => $tarifs]);
    }

    public function edit($id) {
        $tarif = Tarif::findOrFail($id);
        return view('backend.tarifs.tarif', ["action" => "edit", "tarif" => $tarif]);
    }

    public function update(Request $request, $id) {

        $validator = Validator::make($request->all(), [
            'libelle' => 'required|max:100',
            'prix_normal' => 'required|numeric|min:0',
            'prix_etudiant' => 'required|numeric|min:0'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin_tarif.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $tarif = Tarif::findOrFail($id);
        $tarif->nom_tarif = Input::get('libelle');
        $tarif->prix_tarif = Input::get('prix_normal');
        $tarif->prixEtu_tarif = Input::get('prix_etudiant');
        $tarif->save();

        // success
        Session::flash('flash_message', 'Tarif modifié avec succès.');
        Session::flash('flash_type', 'success');

        return redirect()->route('admin_tarif');
    }

    public function create() {
        $tarif = new Tarif();
        return view('backend.tarifs.tarif', ["action" => "create", "tarif" => $tarif]);
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'libelle' => 'required|max:100',
            'prix_normal' => 'required|numeric|min:0',
            'prix_etudiant' => 'required|numeric|min:0'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin_tarif.create')
                ->withErrors($validator)
                ->withInput();
        }

        $tarif = new Tarif();
        $tarif->nom_tarif = Input::get('libelle');
        $tarif->prix_tarif = Input::get('prix_normal');
        $tarif->prixEtu_tarif = Input::get('prix_etudiant');
        $tarif->save();

        // success
        Session::flash('flash_message', 'Tarif créé avec succès.');
        Session::flash('flash_type', 'success');

        return redirect()->route('admin_tarif');
    }

    public function remove($id) {

        try {
            $tarif = Tarif::findOrFail($id);
            $tarif->delete();
            return Response::json(true, 200);
        } catch (ModelNotFoundException $ex) {
            return Response::json(false, 200);
        }

    }
}
