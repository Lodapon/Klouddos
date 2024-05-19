<?php


namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class UserScore extends Model
{
    protected $table = "user_score";
    protected $fillable = ["voted_to", "req_id", "score", "voted_by", "voted_date"];
    const CREATED_AT = 'voted_date';
    const UPDATED_AT = null;
}