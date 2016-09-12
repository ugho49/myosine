<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

abstract class AbstractAdminController extends Controller
{
    protected $breadcrumb = [];

    public function __construct() {
        parent::__construct();

        $this->removeBreadcrumbSession();
        $this->addBreadcrumb("Administration", URL::route('admin'));
    }

    protected function removeBreadcrumbSession() {
        if (Session::has('breadcrumb')) {
            Session::remove('breadcrumb');
        }
    }

    protected function addBreadcrumb($name, $url) {
        $this->breadcrumb = Session::get('breadcrumb');
        $this->breadcrumb[] = ["name" => $name, "url" => $url];
        Session::set('breadcrumb', $this->breadcrumb);
    }
}
