<?php

namespace App\Http\Controllers;

use App\HoraireCours;
use App\HoraireOuverture;
use App\Http\Requests;
use App\Tarif;
use Illuminate\Support\Facades\DB;

class TarifHoraireController extends Controller
{
    public function index() {
        $tarifs = Tarif::orderBy(DB::raw("substr(nom_tarif,1,1)"))
            ->orderBy("prix_tarif")
            ->get();

        $horairesOuvertureRAW = HoraireOuverture::orderBy('num_jour', 'ASC')
            ->orderBy("isMatin_horaire", "DESC")
            ->get();

        $horairesOuverture = $this->formatHorOuv($horairesOuvertureRAW);

        $horairesCoursRAW = HoraireCours::orderBy('num_jour')->get();

        $horairesCours = $this->formatHorCours($horairesCoursRAW);

        return view('frontend.tarifs', ["tarifs" => $tarifs, "horairesCours" => $horairesCours, "horairesOuverture" => $horairesOuverture]);
    }

    private function formatHorOuv($horairesOuvertureRAW) {
        $horairesOuverture = [];

        for ($i = 1; $i <= 7; $i++) {
            $tab = [];
            foreach ($horairesOuvertureRAW as $hor) {
                if ($hor->num_jour == $i) {
                    $tab[] = $hor;
                }
            }
            $horairesOuverture[] = $tab;
        }

        return $horairesOuverture;
    }

    private function formatHorCours($horairesCoursRAW) {
        $horairesCours = [];

        for ($i = 1; $i <= 7; $i++) {
            $tab = [];
            foreach ($horairesCoursRAW as $hor) {
                if ($hor->num_jour == $i) {
                    $tab[] = $hor;
                }
            }
            $horairesCours[] = $tab;
        }

        $horairesCours = array_filter( $horairesCours );

        return $horairesCours;
    }
}
