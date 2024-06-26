<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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


    private $username;
    public function __construct($username)
    {
        $this->username = $username;
    }

    public function getUsername() {
        return $this->username;
    }
//
//    const ADMIN_TYPE = 'admin';
//    const DEFAULT_TYPE = 'default';
//    public function isAdmin()    {
//        return $this->type === self::ADMIN_TYPE;
//    }

}
