<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageControllerCmsNavbar extends Controller
{
    public function show($imageName)
    {

        $storagePath = storage_path('app/navbar_brand_image/' . $imageName);
        return response()->file($storagePath);
    }
}
