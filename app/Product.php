<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'seller_id', 'stock_qnty', 'price', 'type', 'description', 'category_id', 'approved', 'image'
    ];
}
