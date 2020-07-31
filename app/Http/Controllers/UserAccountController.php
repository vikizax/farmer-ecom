<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use App\User;
use App\UserOrders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page)
    {

        switch ($page) {
            case 'account':

                return view('user.accountIndex')->with('page', 'account');

                break;

            case 'orderHistory':

                $orders = UserOrders::where('user_id', Auth::user()->id)->get();

                foreach ($orders as $key => $order) {

                    $product = Product::where('id', $order->product_id)->first();
                    $category = ProductCategory::where('id', $product->category_id)->first();
                    $orders[$key]['item_name'] = $product->name;
                    $orders[$key]['category'] = $category->name;
                    $orders[$key]['img'] = $product->image;
                }


                return view('user.accountIndex')->with('page', 'orderHistory')->with('orders', $orders);

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $user = Auth::user();

        $data = [
            'first_name' => $request->input('first-name'),
            'last_name' => $request->input('last-name'),
            'email' => $request->input('email'),
            'phone_no' => $request->input('phone'),
            'address' => $request->input('address'),
            'pin_code' => $request->input('pincode'),
        ];

        $validator = Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'address' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone_no' => ['required', 'integer', 'digits:10'],
            'pin_code' => ['required', 'integer', 'digits:6'],
        ]);

        // dd($data);

        if ($validator->fails()) {
            return back()->withErrors($validator->messages())->withInput();
        }

        $user->update($data);
        return redirect()->back()->with('success', 'Update Successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
