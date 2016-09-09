<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\URL;

class MainController extends Controller
{
    public function index() {
        return view('frontend.index', []);
    }

    public function renseignements() {
        return view('frontend.renseignements', []);
    }

    public function terms() {
        $editeur = "Ugho STEPHAN";
        $site = "<a href=".URL::to('/').">Myosine</a>";
        return view('frontend.terms', ["editeur" => $editeur, "site" => $site]);
    }
}
