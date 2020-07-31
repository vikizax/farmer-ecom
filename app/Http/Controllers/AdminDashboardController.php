<?php

namespace App\Http\Controllers;

use App\Notifications\ProductApproveNotification;
use App\Notifications\ProductRejectNotification;
use App\Notifications\SellerRegistrationRejectNotification;
use App\Notifications\SellerRegistrationSuccessNotification;
use App\Product;
use App\ProductCategory;
use App\Seller;
use App\User;
use App\UserOrders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index($page)
    {

        $user = new User();

        switch ($page) {
            case 'approveProduct':

                $products = Product::where('approved', false)->get();

                $data = array();
                foreach ($products as $key => $product) {
                    $data[$key] = $product;
                    $category = ProductCategory::where('id', $product->category_id)->first()->name;
                    $data[$key]['category'] = $category;
                }

                return view('admin.dashboard')->with(['page' => 'approveProduct', 'products' => $data]);

                break;
            case 'approveSeller':

                $sellers = Seller::where('approved', false)->get();

                $users = array();

                foreach ($sellers as $key => $seller) {
                    $users[$key] = $user->where('id', $seller->user_id)->first();
                }

                return view('admin.dashboard')->with(['page' => 'approveSeller', 'users' => $users]);

                break;
            case 'productAnalysis':
                $data_set_product = array();

                $label = "[";
                // get the top 5 products who received most orders
                $orders = DB::table('user_orders')
                    ->select(DB::raw('count(*) as order_count, product_id'))
                    ->groupBy('product_id')
                    ->orderByDesc('order_count')
                    ->limit(5)
                    ->get();


                $numItems = count($orders);
                $i = 0;
                foreach ($orders as $key => $order) {
                    $product_name = Product::where('id', $order->product_id)->first()->name;
                    $data_set_product[$key] = $order->order_count;
                    $label = $label . '"' . $product_name . ' (PRODUCT ID: ' . $order->product_id . ')",';
                    if (++$i === $numItems) {
                        $label = $label . ']';
                    }
                }


                return view('admin.dashboard')->with(['page' => 'productAnalysis', 'data_set' => implode(',', $data_set_product), 'product_label' => $label]);

                break;
            case 'sellerAll':
                $sellers = Seller::where('approved', true)->get();

                $users = array();

                foreach ($sellers as $key => $seller) {
                    $users[$key] = $user->where('id', $seller->user_id)->first();
                }

                return view('admin.dashboard')->with(['page' => 'sellerAll', 'users' => $users]);

                break;
            case 'sellerAnalysis':

                $data_set_seller = array();

                $label = "[";
                // get the top 5 sellers who received most orders
                $orders = DB::table('user_orders')
                    ->select(DB::raw('count(*) as order_count, seller_id'))
                    ->groupBy('seller_id')
                    ->orderByDesc('order_count')
                    ->limit(5)
                    ->get();


                $numItems = count($orders);
                $i = 0;
                foreach ($orders as $key => $order) {
                    $user_id = Seller::where('id', $order->seller_id)->first()->user_id;
                    $seller_name = User::where('id', $user_id)->first()->first_name;
                    $data_set_seller[$key] = $order->order_count;
                    $label = $label . '"' . $seller_name . ' (USER ID: ' . $user_id . ')",';
                    if (++$i === $numItems) {
                        $label = $label . ']';
                    }
                }

                return view('admin.dashboard')->with(['page' => 'sellerAnalysis', 'data_set' => implode(',', $data_set_seller), 'seller_label' => $label]);

                break;

            case 'categoryAll':
                $categories = ProductCategory::get();

                return view('admin.dashboard')->with(['page' => 'categoryAll', 'categories' => $categories]);

                break;

            case 'transaction':

                $orders = UserOrders::all();


                foreach ($orders as $key => $order) {
                    $seller_user_id = Seller::where('id', $order->seller_id)->first()->user_id;

                    $orders[$key]['seller_user_id'] = $seller_user_id;

                }


                return view('admin.dashboard')->with(['page' => 'transaction', 'orders' => $orders]);

                break;

            default:
                abort(404);

                break;
        }
    }


    public function more($page, $id, $show = false)
    {
        switch ($page) {
            case 'approveProduct':

                $product = Product::findOrFail($id);

                $product['category'] = ProductCategory::where('id', $product->category_id)->first()->name;;

                // get user id from the seller table
                $user_id = Seller::findOrFail($product->seller_id)->user_id;

                $seller = User::findOrFail($user_id);

                return view('admin.dashboard')->with(['page' => 'approveProductMore', 'product' => $product, 'seller' => $seller]);

                break;
            case 'approveSeller':
                $seller = null;
                $details = User::findOrFail($id);

                if ($show) {
                    $seller = Seller::where('user_id', $id)->where('approved', true)->first();
                } else {
                    $seller = Seller::where('user_id', $id)->where('approved', false)->first();
                }

                $details['img'] = $seller->proof_url;

                return view('admin.dashboard')->with(['page' => 'approveSellerMore', 'user' => $details]);

                break;
//            case 'productAnalysis':
//                return view('admin.dashboard')->with('page', 'productAnalysis');
//
//                break;
//            case 'sellerAnalysis':
//                return view('admin.dashboard')->with('page', 'sellerAnalysis');
//
//                break;
//            case 'userAnalysis':
//                return view('admin.dashboard')->with('page', 'userAnalysis');
//
//                break;
            case 'editCategory':
                $category = ProductCategory::findOrFail($id);

                return view('admin.dashboard')->with(['page' => 'editCategory', 'category' => $category]);

                break;

            default:
                abort(404);

                break;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();

        return view('admin.dashboard')->with('page', 'addCategory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:product_category',
        ], $messages = [
            'unique' => 'Category already exist',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->messages());
        }

        ProductCategory::create([
            'name' => $request->name
        ]);

        return redirect()->back()->with('success', 'Category added success!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if (strpos($request->path(), 'approveSeller') !== false) {

            $user = User::where('id', $id)->first();

            // Change the user role for Seller registration
            // 2 = SELLER ROLE
            $user->role = 2;
            $user->save();

            // update seller in Seller table as approved
            $seller = Seller::where('user_id', $id)->first();
            $seller->approved = true;
            $seller->save();

            // notify the user for successful registration as Seller
            Notification::send($user, new SellerRegistrationSuccessNotification());

            return redirect('/admin/approveSeller')->with('success', 'Seller approved success');
        } else if (strpos($request->path(), 'updateCategory') !== false) {


            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:product_category',
            ], $messages = [
                'unique' => 'Category already exist',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages());
            }

            $category = ProductCategory::where('id', $id)->first();

            $category->name = $request->name;

            $category->save();

            return redirect()->back()->with('success', 'Category update success');
        } else if (strpos($request->path(), 'approveProduct') !== false) {

            $product = Product::findOrFail($id);

            $seller = User::findOrFail($product->seller_id);

            // change apprved value
            $product->approved = true;

            $product->save();

            // send seller Product approved notification
            Notification::send($seller, new ProductApproveNotification());

            return redirect('/admin/approveProduct')->with('success', 'Product approved success');
        } else {
            abort(400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if (strpos($request->path(), 'rejectSeller') !== false) {

            $user = User::where('id', $id)->first();


            $seller = Seller::where('user_id', $id)->first();

            // delete proof photo from disk
            Storage::delete("seller_proof/" . $seller->proof_url);

            // remove the row from Seller table
            $seller->delete();

            // notify the user for successful registration as Seller
            Notification::send($user, new SellerRegistrationRejectNotification());

            return redirect('/admin/approveSeller')->with('Seller reject success');

        } else if (strpos($request->path(), 'deleteCategory') !== false) {

            $category = ProductCategory::findOrFail($id);

            $category->delete();

            return redirect('/admin/categoryAll')->with('success', 'Category delete success');
        } else if (strpos($request->path(), 'rejectProduct') !== false) {

            $product = Product::findOrFail($id);

            $seller = User::findOrFail($product->seller_id);

            // delete the product image from disk
            Storage::delete("product_image/" . $product->image);

            $product->delete();

            // notify seller
            Notification::send($seller, new ProductRejectNotification());

            return redirect('/admin/approveProduct')->with('success', 'Product reject success');
        } else {
            abort(400);
        }
    }
}
