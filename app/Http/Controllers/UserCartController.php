<?php

namespace App\Http\Controllers;

use App\Product;
use App\UserCart;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user_id = Auth::user()->id;

        $cartItems = UserCart::where('user_id', $user_id)->get();

        $products = array();

        $total_price = 0;
        foreach ($cartItems as $key => $product) {

            $products[$key] = Product::findorFail($product->product_id);
            $products[$key]['qnty'] = $product->qnty;
            $products[$key]['cart_id'] = $product->id;

            $total_price = ($product->qnty * $products[$key]->price) + $total_price;
        }

        return view('user.cart')->with(['products' =>  $products, 'total_price' => $total_price]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        $user_id = Auth::user()->id;

        $cart = new UserCart();

        $exits = $cart->where('product_id', $id)->where('user_id', $user_id)->first();

        $stock = Product::findorFail($id)->stock_qnty;

        if ($stock == 0)
            return redirect()->back()->with('info', 'Item Out of Stock');


        if ($exits) {
            $cart->where('product_id', $id)->update(['qnty' => $exits->qnty  + 1]);
        } else {
            $cart->user_id = $user_id;

            $cart->product_id = $id;

            $cart->qnty = 1;

            $cart->save();
        }

        return redirect()->back()->with('success', 'Item Add to your Cart');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = UserCart::findOrFail($id);
        $item->delete();

        return redirect()->back();
    }
}
