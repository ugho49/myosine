<?php

namespace App\Http\Controllers;

use App\HoraireOuverture;
use App\Http\Requests;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminHorairesOuvertureController extends Controller
{
    public function index() {
        $horairesOuverture = HoraireOuverture::orderBy('num_jour', 'ASC')
            ->orderBy("isMatin_horaire", "DESC")
            ->get();
        
        return view('backend.horaires.ouverture.index', ["horaires" => $horairesOuverture]);
    }

    public function edit($id) {
        $horaire = HoraireOuverture::findOrFail($id);
        return view('backend.horaires.ouverture.edit', ["horaire" => $horaire]);
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'horaire_debut' => 'required_with:horaire_fin|date_format:H\hi',
            'horaire_fin' => 'required_with:horaire_debut|date_format:H\hi'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin_horaire_ouv.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $horaire = HoraireOuverture::findOrFail($id);
        $horaire->debut_horaire = Input::get('horaire_debut');
        $horaire->fin_horaire = Input::get('horaire_fin');
        $horaire->save();

        // success
        Session::flash('flash_message', "Horaire d'ouverture modifié avec succès.");
        Session::flash('flash_type', 'success');

        return redirect()->route('admin_horaire_ouv');
    }

    public function remove($id) {

        try {
            $hor = HoraireOuverture::findOrFail($id);
            $hor->debut_horaire = null;
            $hor->fin_horaire = null;
            $hor->save();
            return Response::json(true, 200);
        } catch (ModelNotFoundException $ex) {
            return Response::json(false, 200);
        }

    }
}
