<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Instamojo\Instamojo;
use App\UserCart;
use App\Product;
use App\UserOrders;

class InstamojoController extends Controller
{


    private $instamojo_api_key;
    private $instamojo_auth_token;
    private $instamojo_end_point;

    function __construct()
    {
        $this->instamojo_api_key = env('INSTAMOJO_API_KEY');
        $this->instamojo_auth_token = env('INSTAMOJO_AUTH_TOKEN');
        $this->instamojo_end_point = env('INSTAMOJO_END_POINT');

    }

    public function createRequest(Request $request, $id)
    {

        $api = new Instamojo($this->instamojo_api_key, $this->instamojo_auth_token, $this->instamojo_end_point);

        $cart_item = UserCart::findOrFail($id);

        $product = Product::findOrFail($cart_item->product_id);

        $amount = $product->price * $cart_item->qnty;

        // create order record
        $order = UserOrders::create([
            'name' => $request->name,
            'address' => $request->address,
            'pincode' => $request->pincode,
            'phone_no' => $request->phone,
            'seller_id' => $product->seller_id,
            'state' => $request->state,
            'city' => $request->city,
            'user_id' => Auth::user()->id,
            'product_id' => $product->id,
            'total_amnt' => $amount,
            'qnty' => $cart_item->qnty,
            'payment_status' => 'pending'
        ]);


        try {
            $response = $api->paymentRequestCreate(array(
                "purpose" => $product->name,
                "amount" => $amount,
                "send_email" => true,
                "send_sms" => true,
                "email" => Auth::user()->email,
                "redirect_url" => "http://localhost:8000/thankyou/" . $id . "/" . $order->id,
                // "webhook" => "http://localhost:8000/webhook",
                "buyer_name" => $request->name,
                "phone" => $request->phone
            ));


            return redirect($response['longurl']);
        } catch (Exception $e) {

            return redirect()->route('cart.index')->with('error', 'Server error, Please try again!');

        }
    }

    public function webhook(Request $request)
    {
        dd($request->all());
    }

    public function thankyou(Request $request, $cart_id, $order_id)
    {

        $api = new Instamojo($this->instamojo_api_key, $this->instamojo_auth_token, $this->instamojo_end_point);

        $payment_id = $request->payment_id;

        $payment_request_id = $request->payment_request_id;


        try {
            $response = $api->paymentRequestStatus($request->payment_request_id);

            if ($response['status'] == "Completed") {


                $cart = UserCart::findOrFail($cart_id);
                $order = UserOrders::findOrFail($order_id);

                // update product stock quantity
                $product = Product::findOrFail($order->product_id);
                $product->stock_qnty = $product->stock_qnty - 1;
                $product->update();

                // update the order details for successful payment
                // update payment status
                $order->payment_status = 'complete';
                // update payment_id
                $order->payment_id = $payment_id;
                // update payment request id
                $order->payment_request_id = $payment_request_id;
                // update
                $order->update();

                // delete item from the cart after purchase
                $cart->delete();

                return redirect()->route('cart.index')->with('success', 'Order received, Please check your mail for more details.');

            } else {
                // remove the order record if not successful

                $order = UserOrders::findOrFail($order_id);
                $order->delete();

                return redirect()->route('cart.index')->with('error', 'Transaction unsuccessful, Please try again');
            }
        } catch (Exception $e) {
            print('Error: ' . $e->getMessage());
        }


    }
}
