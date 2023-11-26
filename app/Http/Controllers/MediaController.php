<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function show($path1, $path2, $filename)
    {
        $path = $path1."/".$path2."/".$filename;
        if(!Storage::exists($path)){
            abort(404);
        }

        return Storage::response($path);
    }
}
