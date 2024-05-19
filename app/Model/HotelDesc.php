<?php


namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class HotelDesc extends Model
{
    protected $table = "hotel_desc";

    protected $fillable = ["account_id","hotel_name","hotel_rate","hotel_location","hotel_address","hotel_email","hotel_tel"];
    public $timestamps = false;

}