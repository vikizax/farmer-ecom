<?php

namespace App\Http\Controllers;

use App\Notifications\SellerNotification;
use App\Seller;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class SellerController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.sellerRegister');
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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|mimes:jpg,jpeg,png|max:4096',
        ], $messages = [
            'image' => 'Please insert image only',
            'max'   => 'Image should be less than 4 MB'
        ]);

        if ($validator->fails()) {
            // dd($validator->messages());
            return back()->withErrors($validator->messages());
        }

        $id = Auth::user()->id;

        $seller = Seller::where('user_id', $id)->first();


        if ($seller === null) {
            $img_name = $request->file('image')->store('seller_proof');

            Seller::create([
                'user_id' => $id,
                'proof_url' => explode('/', $img_name)[1]
            ]);

            $admin = User::where('role', 1)->get();

            Notification::send($admin, new SellerNotification());

            return redirect()->back()->with('success', 'Application forwarded to the admin. Please wait for the approval. You will recieve notification in your mail.');
        } else if ($seller->approved === true) {
            return redirect('/');
        } else {
            return redirect()->back()->with('info', 'Already applied! Please wait for approval');
        }
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
        //
    }
}
