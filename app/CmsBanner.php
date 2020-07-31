<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsBanner extends Model
{
    protected $table = 'cms_banner';
    protected $fillable = [
        'title', 'sub_title', 'image', 'link'
    ];
}
