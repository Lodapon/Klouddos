<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    protected $table = "user_account";

    protected $fillable = ["username", "password", "salt", "role", "status", "email", "created_date", "reason"];
    public $timestamps = false;
}
