<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Video;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class AdminVideoController extends AbstractAdminController
{
    public function __construct() {
        parent::__construct();
        $this->addBreadcrumb("Gestion des Video", URL::route('admin_video'));
    }

    public function index() {
        $videos = Video::orderBy("created_at", "DESC")->get();
        return view('backend.videos.index', ["videos" => $videos]);
    }

    public function edit($id) {
        $video = Video::findOrFail($id);
        $this->addBreadcrumb("Modifier la video", URL::route('admin_video.edit', $id));
        return view('backend.videos.video', ["action" => "edit", "video" => $video]);
    }

    public function update(Request $request, $id) {

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100',
            'url' => 'required|url',
            'enabled' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin_video.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $video = Video::findOrFail($id);
        $video->title = Input::get('title');
        $video->url = Input::get('url');
        $video->enabled = Input::get('enabled');
        $video->save();

        // success
        Session::flash('flash_message', 'Video modifiée avec succès.');
        Session::flash('flash_type', 'success');

        return redirect()->route('admin_video');
    }

    public function create() {
        $video = new Video();
        $video->enabled = true;
        $this->addBreadcrumb("Créer une video", URL::route('admin_video.create'));
        return view('backend.videos.video', ["action" => "create", "video" => $video]);
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100',
            'url' => 'required|url',
            'enabled' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin_video.create')
                ->withErrors($validator)
                ->withInput();
        }

        $video = new Video();
        $video->title = Input::get('title');
        $video->url = Input::get('url');
        $video->enabled = Input::get('enabled');
        $video->save();

        // success
        Session::flash('flash_message', 'Video ajoutée avec succès.');
        Session::flash('flash_type', 'success');

        return redirect()->route('admin_video');
    }

    public function remove($id) {
        try {
            $video = Video::findOrFail($id);
            $video->delete();
            return Response::json(true, 200);
        } catch (ModelNotFoundException $ex) {
            return Response::json(false, 200);
        }
    }
}
