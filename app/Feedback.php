<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';
    protected $fillable = [
        'feedback',
        'contact_number',
        'contact_email',
        'name'
    ];
}
