<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsTopAd extends Model
{
    protected $table = 'cms_top_ad';

    protected $fillable = [
        'ad_link', 'ad_title', 'image'
    ];
}
