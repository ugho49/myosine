<?php

namespace App\Http\Controllers;

use App\Http\Requests;

class AdminBandeauController extends Controller
{
    public function index() {
        return view('backend.bandeau', []);
    }
}
