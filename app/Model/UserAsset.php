<?php


namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class UserAsset extends Model
{
    protected $table = "user_asset";
    protected $fillable = ["account_id", "asset_url", "asset_type"];
    public $timestamps = false;
}