<?php


namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $table = "quotation";

    protected $fillable = ["quo_title",
        "quo_remark",
        "quo_total",
        "created_date",
        "created_by",
        "req_id",
        "asset_id"];

    const CREATED_AT = 'created_date';
    const UPDATED_AT = null;
}