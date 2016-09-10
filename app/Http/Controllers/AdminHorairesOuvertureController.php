<?php

namespace App\Http\Controllers;

use App\Http\Requests;

class AdminHorairesOuvertureController extends Controller
{
    public function index() {
        return view('backend.horaires.ouverture.index', []);
    }
}
