<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Services\PhotoService;
use Illuminate\Support\Facades\URL;

class PicturesController extends Controller
{
    private $options = [
        "data-nav"              => "thumbs",
        "data-allowfullscreen"  => "true",
        "data-loop"             => "true",
        "data-navposition"      => "top",
        "data-keyboard"         => "true",
        "data-arrows"           => "true",
        "data-click"            => "false",
        "data-trackpad"         => "false",
        "data-swipe"            => "true",
        "data-width"            => "100%",
        "data-height"           => "100%"
    ];
    
    public function index() {
        return view('frontend.pictures', ["fotorama" => $this->creerFotorama()]);
    }

    //créer la div "fotorama" avec les photos à l'intérieur
    private function creerFotorama(){

        $data = "";
        $formatOptions = "";

        $service = new PhotoService();

        foreach ($this->options as $k => $v) {
            $formatOptions .= $k.'="'.$v.'" '; //exemple data-nav="thumb"
        }

        $array = $service->lister();

        $data .= '<div class="fotorama" '. $formatOptions .'>';

        for ($i=0; $i < count($array); $i++) {
            $data .= '<img src="'.$array[$i]['url'].'" alt="'.$array[$i]['name'].'" />';
        }

        $data .= '</div>';

        return $data;
    }
}
