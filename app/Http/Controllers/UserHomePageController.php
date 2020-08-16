<?php

namespace App\Http\Controllers;

use App\CmsBanner;
use App\CmsBottomAd;
use App\CmsCustomerReview;
use App\CmsFooter;
use App\CmsPopUp;
use App\CmsTopAd;
use App\Feedback;
use App\Product;
use App\Seller;
use App\User;

use App\UserOrders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;


class UserHomePageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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


        if(!$products->isEmpty()) {
            foreach ($products as $key => $product) {

                $featured_products[$counter][$i_key] = $product;
                $i_key++;
                if ($key == 3) {
                    $counter = 1;
                    $i_key = 0;
                }

            }
        }else {
            $featured_products = null;
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

            if(!$data_set_product->isEmpty()) {
                foreach ($data_set_product as $key => $product) {

                    $best_selling_products[$counter_j][$key_j] = $product;
                    $key_j++;
                    if ($key == 3) {
                        $counter_j = 1;
                        $key_j = 0;
                    }

                }

            }else {
                $best_selling_products = null;
            }

            $data = [
                'featured_products' => $featured_products,
                'banners' => $banners,
                'topAds' => $topAds,
                'reviews' => $reviews,
                'bottomAds' => $bottomAds,
                'best_selling_products' => $best_selling_products
            ];

        } else {
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

        $feedback_count = count(CmsCustomerReview::get());

        $orders_count = count(UserOrders::get());

        $product_count = count(Product::get());

        $seller_count = count(Seller::get());

        $data['footer_content'] = CmsFooter::first();

        $data['feedback_count'] = $feedback_count;
        $data['order_count'] = $orders_count;
        $data['product_count'] = $product_count;
        $data['seller_count'] = $seller_count;

        if ($request->is('/')) {
            if (CmsPopUp::all()->isNotEmpty()) {
                $popup = CmsPopUp::first()->image;
                alert()->image(null, null, route('cmsPopUpImage.show', $popup), '', '')->persistent();
            }


        }


        return view('user.home')
            ->with($data);

    }

    public function create(Request $request)
    {
        if (strpos($request->path(), 'contactus') !== false) {
            return view('user.feedback');
        }
    }

    public function store(Request $request)
    {
        if (strpos($request->path(), 'contactusStore') !== false) {

            $feedback_validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'feedback' => 'required|string|max:800',
                'contact_number' => 'required|integer|digits:10',
                'contact_email' => 'required|email'
            ], $messages = [
                'integer' => 'Contact number is not valid | Must not start with 0 | Must be of 10 digits'
            ]);

            if ($feedback_validator->fails()) {
                return back()->withInput()->withErrors($feedback_validator->messages());
            }

            Feedback::create([
                'name' => $request->name,
                'feedback' => $request->feedback,
                'contact_email' => $request->contact_email,
                'contact_number' => $request->contact_number
            ]);

            return redirect()->route('home')->with('success', 'Feedback Submitted');

        }
    }
}
