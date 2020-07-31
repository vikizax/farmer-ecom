<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageControllerCmsBottomAd extends Controller
{
    public function show($imageName)
    {

        $storagePath = storage_path('app/bottomAd_image/' . $imageName);
        return response()->file($storagePath);
    }
}
