<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageControllerCmsPopUp extends Controller
{
    public function show($imageName)
    {

        $storagePath = storage_path('app/popup_ad_image/' . $imageName);
        return response()->file($storagePath);
    }
}
