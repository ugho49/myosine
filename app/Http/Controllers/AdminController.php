<?php

namespace App\Http\Controllers;

use App\Http\Requests;

class AdminController extends AbstractAdminController
{
    public function index() {
        return view('backend.index', []);
    }
}
