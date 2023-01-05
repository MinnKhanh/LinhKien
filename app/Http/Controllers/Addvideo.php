<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class Addvideo extends Controller
{
    public function __construct()
    {
        View::share('active', 3);
    }
    public function index()
    {
        return view('addvideo');
    }
    public function uploadFile($file, $is_image = true)
    {
        $name = $file->getClientOriginalName();

        $fileName = time() . '_' . $name;

        $pathStorage = 'app/public/contents/images/';

        if (!$is_image) {
            $pathStorage = 'app/public/contents/videos/';
        }

        // UPLOAD IMAGE
        $file->move(storage_path($pathStorage), $fileName);

        $path = 'contents/images/' . $fileName;
        if (!$is_image) {
            $path = 'contents/videos/' . $fileName;
        }
        return $path;
    }

    public function store(Request $request)
    {
        // dd($request->phim);
        $pathVideo = $this->uploadFile($request->phim, false);
        DB::table('video')->insert([
            'type' => 1,
            'video_url' => $pathVideo
        ]);
    }
}
