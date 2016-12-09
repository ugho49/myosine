<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Services\PhotoService;
use App\Video;
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
        "data-height"           => "100%",
        "data-hash"             => "true",
        "data-autoplay"         => "false",
    ];
    
    public function index() {
        $service = new PhotoService();
        $videos = Video::orderBy("created_at", "DESC")->get();

        return view('frontend.pictures', [
                "options" => $this->getOptionsFormat(),
                "images_urls" => $service->lister(),
                "videos" => $videos
            ]);
    }

    //créer les options en html
    private function getOptionsFormat() {
        $formatOptions = "";

        foreach ($this->options as $k => $v) {
            $formatOptions .= $k.'="'.$v.'" ';
        }

        return $formatOptions;
    }
}
