<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserOrders extends Model
{
    //
    protected $fillable = [
        'name',
        'city',
        'state',
        'address',
        'pincode',
        'phone_no',
        'seller_id',
        'user_id',
        ' payment_status',
        'payment_request_id',
        'payment_id',
        'product_id',
        'qnty',
        'total_amnt'
    ];
}
