<?php

namespace App\Http\Controllers;

use App\Bandeau;
use App\Informations;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public function __construct() {
        $this->bandeauContent();
        $this->informations();
    }

    private function bandeauContent() {
        //DB::enableQueryLog();
        $bandeauContent = Bandeau::where("date_create_sb", "<=", DB::raw('CURRENT_TIMESTAMP'))
            ->where(function($q){
                $q->where('date_fin_sb','>=', DB::raw('CURRENT_TIMESTAMP'));
                $q->orWhere("date_fin_sb", null);
            })
            ->orderBy('date_create_sb', "DESC")
            ->get();

        //dd(DB::getQueryLog());

        if (Session::has('bandeauContent')) {
            Session::remove('bandeauContent');
        }

        if (count($bandeauContent) > 0) {
            Session::set('bandeauContent', $bandeauContent);
        }
    }

    private function informations() {
        $informations = Informations::first();
        
        if (Session::has('informations')) {
            Session::remove('informations');
        }

        Session::set('informations', $informations);
    }
}
