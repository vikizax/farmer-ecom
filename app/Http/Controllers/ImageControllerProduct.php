<?php

namespace App\Http\Controllers;

class ImageControllerProduct extends Controller
{
    public function show($imageName)
    {

        $storagePath = storage_path('app/product_image/' . $imageName);
        return response()->file($storagePath);
    }
}
