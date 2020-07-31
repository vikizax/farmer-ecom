<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsCustomerReview extends Model
{
    protected $table = 'cms_customer_review';
    protected $fillable = [
        'review', 'name', 'designation', 'image'
    ];
}
