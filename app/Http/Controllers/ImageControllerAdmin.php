<?php

namespace App\Http\Controllers;

class ImageControllerAdmin extends Controller
{

    public function show($imageName)
    {

        $storagePath = storage_path('app/seller_proof/' . $imageName);
        return response()->file($storagePath);
    }
}
