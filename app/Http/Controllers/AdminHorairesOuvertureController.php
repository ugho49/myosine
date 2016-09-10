<?php

namespace App\Http\Controllers;

use App\HoraireOuverture;
use App\Http\Requests;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AdminHorairesOuvertureController extends Controller
{
    public function index() {
        $horairesOuverture = HoraireOuverture::orderBy('num_jour', 'ASC')
            ->orderBy("isMatin_horaire", "DESC")
            ->get();
        
        return view('backend.horaires.ouverture.index', ["horaires" => $horairesOuverture]);
    }

    public function edit($id) {
    }

    public function update(Request $request, $id) {
    }

    public function create() {
    }

    public function store(Request $request) {
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
