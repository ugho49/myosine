<?php

namespace App\Http\Controllers;

use App\Http\Requests;

class AdminTarifController extends Controller
{
    public function index() {
        return view('backend.tarifs.index', []);
    }
}
