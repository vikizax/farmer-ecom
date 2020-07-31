<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use Illuminate\Http\Request;

class UserProductPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $filter = 'All', $search = null)
    {


        $title = 'All Products';
        $filter_set = array();
        $categories = ProductCategory::get();


        $products = null;
        foreach ($categories as $key => $category) {
            $filter_set[$key] = $category->name;
        }

        array_push($filter_set, 'All');

        if (in_array($filter, $filter_set)) {


            if($filter == 'All') {
                $products = Product::where('approved', true)
                    ->inRandomOrder();
            }else {
                $title = 'Filtered: ' . $filter;

                $category = ProductCategory::where('name', $filter)->first();

                $products = Product::where('approved', true)
                    ->where('category_id', $category->id)
                    ->inRandomOrder();
            }

            if($search) {
                $title = 'Search Result';
                $products = $products->where("name","LIKE","%{$search}%")->get();
            }else {
                $products = $products->get();
            }


        } else {
            abort(404);
        }


        return view('user.products')->with(['products' => $products, 'title' => $title, 'filter_set' => $filter_set]);
    }

    public function filter(Request $request) {
//        dd($request->all());
        return redirect()->route('product.index', $request->filter);
    }

    public function show($id)
    {
        $product = Product::findorFail($id);

        return view('user.productDetails')->with('product', $product);
    }
}
