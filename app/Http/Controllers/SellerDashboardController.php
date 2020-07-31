<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use App\Seller;
use App\User;
use App\UserOrders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SellerDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page)
    {

        switch ($page) {
            case 'productAnalysis':

                $data_set_product = array();

                $label = "[";
                // get the top 5 products who received most orders
                $orders = DB::table('user_orders')
                    ->select(DB::raw('count(*) as order_count, product_id'))
                    ->where('seller_id', Auth::user()->id)
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


                return view('seller.dashboard')->with(['page' => 'productAnalysis', 'data_set' => implode(',', $data_set_product), 'product_label' => $label]);

                break;

            case 'addProduct':

                $categories = ProductCategory::get();

                return view('seller.dashboard')->with(['page' => 'addProduct', 'categories' => $categories]);

                break;

            case 'listApprovedProduct':

                $products = Product::where('approved', true)->get();

                $data = array();
                foreach ($products as $key => $product) {
                    $data[$key] = $product;
                    $category = ProductCategory::where('id', $product->category_id)->first()->name;
                    $data[$key]['category'] = $category;
                }


                return view('seller.dashboard')->with(['page' => 'listApprovedProduct', 'products' => $data]);

                break;

            case 'listPendingProduct':

                $products = Product::where('approved', false)->get();

                $data = array();
                foreach ($products as $key => $product) {
                    $data[$key] = $product;
                    $category = ProductCategory::where('id', $product->category_id)->first()->name;
                    $data[$key]['category'] = $category;
                }


                return view('seller.dashboard')->with(['page' => 'listPendingProduct', 'products' => $data]);

                break;

            case 'listOrders':

                $seller_id = Seller::where('user_id', Auth::user()->id)->first()->id;

                $orders = UserOrders::where('seller_id', $seller_id)->get();

                foreach ($orders as $key => $order) {
                    $product = Product::where('id', $order->product_id)->first();
                    $orders[$key]['product_name'] = $product->name;
                    $orders[$key]['img'] = $product->image;
                }


                return view('seller.dashboard')->with(['page' => 'listOrders', 'orders' => $orders]);

                break;

            default:
                abort(404);
                break;
        }
    }

    public function showOrderDetails(Request $request, $id) {
        $order = UserOrders::findOrFail($id);

        $order['product_name'] = Product::where('id', $order->product_id)->first()->name;


        return view('seller.dashboard')->with(['page' => 'orderDetails', 'order' => $order]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (strpos($request->path(), 'addProduct') !== false) {

            $categories = ProductCategory::get();

            return view('seller.dashboard')->with(['page' => 'addProduct', 'categories' => $categories]);
        } else {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user_id = Auth::user()->id;

        $seller = Seller::where('user_id', $user_id)->first();

        $seller_id = $seller->id;

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', 'min:1'],
            'stock_qnty' => ['required', 'integer'],
            'price' => ['required', 'integer'],
            'type' => ['required', 'string'],
            'description' => ['required', 'string', 'max:255', 'min:1'],
            'category_id' => ['required'],
            'image' => 'required|mimes:jpg,jpeg,png|max:4096',
        ], $messages = [
            'image' => 'Please insert image only',
            'max' => 'Image should be less than 4 MB'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->messages())->withInput();
        }

        $img_name = $request->file('image')->store('product_image');


        Product::create([
            'name' => $request->name,
            'seller_id' => $seller_id,
            'stock_qnty' => $request->stock_qnty,
            'price' => $request->price,
            'type' => $request->type,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'image' => explode('/', $img_name)[1]
        ]);

        return redirect()->back()->with('success', 'Product successfully listed for approval, please wait for admin to confirm.');
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
    public function edit(Request $request, $id)
    {


        $product = Product::findOrFail($id);

        $categories = ProductCategory::get();

        $category = ProductCategory::where('id', $product->category_id)->first()->name;
        $product['category'] = $category;

        return view('seller.dashboard')->with(['page' => 'manageApprovedProduct', 'product' => $product, 'categories' => $categories]);
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
        if (strpos($request->path(), 'updateProduct') !== false) {


            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255', 'min:1'],
                'stock_qnty' => ['required', 'integer'],
                'price' => ['required', 'integer'],
                'type' => ['required', 'string'],
                'description' => ['required', 'string', 'max:255', 'min:1'],
                'category_id' => ['required'],
                'image' => 'required|mimes:jpg,jpeg,png|max:4096',
            ], $messages = [
                'image' => 'Please insert image only',
                'max' => 'Image should be less than 4 MB'
            ]);


            if ($validator->fails()) {
                return back()->withErrors($validator->messages())->withInput();
            }

            $img_name = $request->file('image')->store('product_image');


            $product = Product::findOrFail($id);

            //delete old product image from disk
            Storage::delete("product_image/" . $product->image);

            $product->name = $request->name;
            $product->stock_qnty = $request->stock_qnty;
            $product->price = $request->price;
            $product->type = $request->type;
            $product->description = $request->description;
            $product->category_id = $request->category_id;
            $product->image = explode('/', $img_name)[1];


            $product->save();

            return redirect()->back()->with('success', 'Product update success');
        } else {
            abort(404);
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

        if (strpos($request->path(), 'deleteProduct') !== false) {

            $product = Product::findOrFail($id);

            // delete the product image from disk
            Storage::delete("product_image/" . $product->image);

            //remove the record from db
            $product->delete();

            return redirect('/seller/listApprovedProduct')->with('success', 'Product remove success');
        }
    }
}
