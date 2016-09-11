<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class AdminUsersController extends AbstractAdminController
{

    public function __construct() {
        parent::__construct();
        $this->addBreadcrumb("Gestion des utilisateurs", URL::route('admin_users'));
    }

    public function index() {
        return view('backend.users.index', []);
    }

    public function activate($id) {
        // TODO
    }

    public function desactivate($id) {
        // TODO
    }

    public function edit($id) {
        // TODO
        /*$this->addBreadcrumb("Modifier le tarif", URL::route('admin_tarif.edit', $id));
        return view('backend.tarifs.tarif', ["action" => "edit", "tarif" => $tarif]);*/
    }

    public function update(Request $request, $id) {
        // TODO
    }

    public function create() {
        // TODO
        /*$tarif = new Tarif();
        $this->addBreadcrumb("Créer un tarif", URL::route('admin_tarif.create'));
        return view('backend.tarifs.tarif', ["action" => "create", "tarif" => $tarif]);*/
    }

    public function store(Request $request) {
        // TODO
    }
}
