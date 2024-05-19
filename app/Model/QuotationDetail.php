<?php


namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class QuotationDetail extends Model
{
    protected $table = "quotation_detail";

    protected $fillable = ["room_type",
        "amount",
        "price_per_one",
        "remark",
        "quo_id"];
    public $timestamps = false;
}