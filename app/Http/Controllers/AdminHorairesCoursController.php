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
use Illuminate\Support\Facades\Validator;

class AdminHorairesCoursController extends Controller
{
    private $jours = [
        ["num" => 1, "name" => "Lundi"],
        ["num" => 2, "name" => "Mardi"],
        ["num" => 3, "name" => "Mercredi"],
        ["num" => 4, "name" => "Jeudi"],
        ["num" => 5, "name" => "Vendredi"],
        ["num" => 6, "name" => "Samedi"],
        ["num" => 7, "name" => "Dimanche"],
    ];

    private function getDayNameByNum($num) {
        foreach ($this->jours as $jour) {
            if ($jour['num'] == $num) {
                return $jour['name'];
            }
        }

        return null;
    }

    public function index() {
        $horairesCours = HoraireCours::orderBy('num_jour')->get();

        return view('backend.horaires.cours.index', ["horaires" => $horairesCours]);
    }

    public function edit($id) {
        $horaire = HoraireCours::findOrFail($id);
        $types = TypeCours::all();
        return view('backend.horaires.cours.cours', ["action" => "edit", "jours" => $this->jours, "horaire" => $horaire, "types" => $types]);
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'horaire_debut' => 'required|date_format:H\hi',
            'horaire_fin' => 'required|date_format:H\hi',
            'type_cours' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin_horaire_cours.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $horaire = HoraireCours::findOrFail($id);
        $horaire->id_typeC = Input::get('type_cours');
        $horaire->debut_cours = Input::get('horaire_debut');
        $horaire->fin_cours = Input::get('horaire_fin');
        $horaire->save();

        // success
        Session::flash('flash_message', 'Cours modifié avec succès.');
        Session::flash('flash_type', 'success');

        return redirect()->route('admin_horaire_cours');
    }

    public function create() {
        $horaire = new HoraireCours();
        $types = TypeCours::all();
        return view('backend.horaires.cours.cours', ["action" => "create", "jours" => $this->jours, "horaire" => $horaire, "types" => $types]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'horaire_debut' => 'required|date_format:H\hi',
            'horaire_fin' => 'required|date_format:H\hi',
            'type_cours' => 'required',
            'num_jour' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin_horaire_cours.create')
                ->withErrors($validator)
                ->withInput();
        }

        $horaire = new HoraireCours();
        $horaire->id_typeC = Input::get('type_cours');
        $horaire->debut_cours = Input::get('horaire_debut');
        $horaire->fin_cours = Input::get('horaire_fin');
        $horaire->num_jour = Input::get('num_jour');
        $horaire->jour_cours = $this->getDayNameByNum(Input::get('num_jour'));
        $horaire->save();

        // success
        Session::flash('flash_message', 'Cours créé avec succès.');
        Session::flash('flash_type', 'success');

        return redirect()->route('admin_horaire_cours');
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
