<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

// email auth implements MustVerifyEmail
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;


    /**
     * Users' roles
     *
     * @var array
     */
    public const ROLES = [
        'admin'     => 1,
        'seller'    => 2,
        'user'      => 3
    ];


    /**
     * determins if the user role is Admin
     * @return bool
     */
    public function isAdmin()
    {
        if (Auth::user()) {
            return Auth::user()->role == self::ROLES['admin'];
        }
    }
    /**
     * determins if the user role is Seller
     * @return bool
     */
    public function isSeller()
    {
        if (Auth::user()) {
            return Auth::user()->role == self::ROLES['seller'];
        }
    }

    /**
     * determins if the user role is Seller
     * @return bool
     */
    public function isUser()
    {
        if (Auth::user()) {
            return Auth::user()->role == self::ROLES['user'];
        }
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'phone_no', 'address', 'pin_code', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
