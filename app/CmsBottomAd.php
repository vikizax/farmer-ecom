<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsBottomAd extends Model
{
    protected $table = 'cms_bottom_ad';

    protected $fillable = ['image', 'ad_link'];
}
