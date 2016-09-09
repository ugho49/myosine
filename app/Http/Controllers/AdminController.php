<?php

namespace App\Http\Controllers;

use App\Http\Requests;

class AdminController extends Controller
{
    public function index() {
        return view('backend.index', []);
    }
}
