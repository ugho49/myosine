<?php

namespace App\Http\Controllers;

use App\HoraireCours;
use App\Http\Requests;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AdminHorairesCoursController extends Controller
{
    public function index() {
        $horairesCours = HoraireCours::orderBy('num_jour')->get();

        return view('backend.horaires.cours.index', ["horaires" => $horairesCours]);
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
            $hor = HoraireCours::findOrFail($id);
            $hor->delete();
            return Response::json(true, 200);
        } catch (ModelNotFoundException $ex) {
            return Response::json(false, 200);
        }

    }
}
