<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Services\PhotoService;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;

class AdminPhotoController extends Controller
{
    public function index() {
        $service = new PhotoService();

        return view('backend.photos', ['photos' => $service->lister()]);
    }
    
    public function findAll() {
        $service = new PhotoService();
        return Response::json($service->lister(), 200);
    }

    public function upload() {
        if(Input::hasFile('file')) {
            //upload an image to the /img/tmp directory and return the filepath.
            $file = Input::file('file');
            $tmpFilePath = '/images/galery/';
            $tmpFileName = time() . '-' . $file->getClientOriginalName();
            $file = $file->move(public_path() . $tmpFilePath, $tmpFileName);
            $path = URL::to('/') . $tmpFilePath . $tmpFileName;
            return Response::json(['url'=> $path, 'name' => $tmpFileName], 200);
        } else {
            return Response::json(false, 400);
        }
    }

    public function delete($name) {
        $service = new PhotoService();
        return Response::json($service->delete($name), 200);
    }
}
