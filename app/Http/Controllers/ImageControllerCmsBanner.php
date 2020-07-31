<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageControllerCmsBanner extends Controller
{
    public function show($imageName)
    {

        $storagePath = storage_path('app/banner_image/' . $imageName);
        return response()->file($storagePath);
    }
}
