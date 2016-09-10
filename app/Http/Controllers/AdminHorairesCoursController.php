<?php

namespace App\Http\Controllers;

use App\Http\Requests;

class AdminHorairesCoursController extends Controller
{
    public function index() {
        return view('backend.horaires.cours.index', []);
    }
}
