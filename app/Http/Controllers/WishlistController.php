<?php

namespace App\Http\Controllers;

use App\Product;
use App\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\FuncCall;

class WishlistController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;

        $query = Wishlist::where('user_id', $user_id)->get();

        $products = array();

        foreach ($query as $key => $product) {

            $products[$key] = Product::findorFail($product->product_id);
            $products[$key]['wishlist_id'] = $product->id;
        }

        return view('user.wishlist')->with('products', $products);
    }

    public function store($id)
    {
        $user_id = Auth::user()->id;

        $wishlist = new Wishlist();

        $exits = $wishlist->where('product_id', $id)->where('user_id', $user_id)->first();

        if ($exits) {

            return redirect()->back()->with('info', 'Item already in your wish list!');

        } else {
            $wishlist->user_id = $user_id;

            $wishlist->product_id = $id;

            $wishlist->save();
        }

        return redirect()->back()->with('success', 'Item Add to your wish list');
    }

    public function destroy($id)
    {
        $item = Wishlist::findOrFail($id);
        $item->delete();

        return redirect()->back();
    }
}
