<?php


namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class ReqForum extends Model
{
    protected $table = "req_forum";

    protected $fillable = ["req_topic",
        "req_room",
        "req_rating",
        "req_st_date",
        "req_en_date",
        "req_location",
        "req_remark",
        "req_budget",
        "req_status",
        "created_date",
        "created_by",
        "updated_date"];

    const CREATED_AT = 'created_date';
    const UPDATED_AT = 'updated_date';
}