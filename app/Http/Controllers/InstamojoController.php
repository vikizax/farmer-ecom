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


    public function createRequest(Request $request, $id)
    {

        $api = new Instamojo("test_30eb970c72d93f6b6632fdaa10d", "test_961b7591967320daf5c4f1c11fc", "https://test.instamojo.com/api/1.1/");

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
            'city' =>$request->city,
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

        $api = new Instamojo("test_30eb970c72d93f6b6632fdaa10d", "test_961b7591967320daf5c4f1c11fc", "https://test.instamojo.com/api/1.1/");

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
