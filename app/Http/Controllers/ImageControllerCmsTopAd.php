<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageControllerCmsTopAd extends Controller
{
    public function show($imageName)
    {

        $storagePath = storage_path('app/topAd_image/' . $imageName);
        return response()->file($storagePath);
    }
}
