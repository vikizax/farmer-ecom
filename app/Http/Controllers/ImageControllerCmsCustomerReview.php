<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageControllerCmsCustomerReview extends Controller
{
    public function show($imageName)
    {

        $storagePath = storage_path('app/customer_review_image/' . $imageName);
        return response()->file($storagePath);
    }
}
