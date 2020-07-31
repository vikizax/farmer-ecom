<?php

namespace App\Http\Controllers;

use App\CmsBanner;
use App\CmsBottomAd;
use App\CmsCustomerReview;
use App\CmsTopAd;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserHomePageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // for featured products
        $counter = 0;
        $i_key = 0;

        // for best selling products
        $counter_j = 0;
        $key_j = 0;


        $featured_products = array(array());
        $data = null;

        $best_selling_products = array(array());

        $products = Product::where('approved', true)->inRandomOrder()->take(8)->get();

        foreach ($products as $key => $product) {

            $featured_products[$counter][$i_key] = $product;
            $i_key++;
            if ($key == 3) {
                $counter = 1;
                $i_key = 0;
            }

        }

        // get the top 8 products who received most orders
        $orders = DB::table('user_orders')
            ->select(DB::raw('count(*) as order_count, product_id'))
            ->groupBy('product_id')
            ->orderByDesc('order_count')
            ->limit(8)
            ->get();


        $banners = CmsBanner::get();

        $topAds = CmsTopAd::get();

        $reviews = CmsCustomerReview::get();

        $bottomAds = CmsBottomAd::get();

        $data_set_product = array();

        // if best selling count is not 8 then take random 8 from database
        if (count($orders) != 8) {

            $data_set_product = Product::where('approved', true)->inRandomOrder()->take(8)->get();

            foreach ($data_set_product as $key => $product) {

                $best_selling_products[$counter_j][$key_j] = $product;
                $key_j++;
                if ($key == 3) {
                    $counter_j = 1;
                    $key_j = 0;
                }

            }
            $data = [
                'featured_products' => $featured_products,
                'banners' => $banners,
                'topAds' => $topAds,
                'reviews' => $reviews,
                'bottomAds' => $bottomAds,
                'best_selling_products' => $best_selling_products
            ];

        }
        else {
            foreach ($orders as $key => $order) {
                $data_set_product[$key] = Product::where('id', $order->product_id)->first();
            }

            foreach ($data_set_product as $key => $product) {

                $best_selling_products[$counter_j][$key_j] = $product;
                $key_j++;
                if ($key_j == 3) {
                    $counter_j = 1;
                    $key_j = 0;
                }

            }

            $data = [
                'featured_products' => $featured_products,
                'banners' => $banners,
                'topAds' => $topAds,
                'reviews' => $reviews,
                'bottomAds' => $bottomAds,
                'best_selling_products' => $best_selling_products
            ];

        }

        return view('user.home')
            ->with($data);
    }
}
