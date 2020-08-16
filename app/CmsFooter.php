<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsFooter extends Model
{
    //
    protected $table = 'cms_footer';

    protected $fillable = [
        'footer_description',
        'footer_copyright',
        'contact_number',
        'contact_email',
        'location'
    ];
}
