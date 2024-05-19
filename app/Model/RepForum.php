<?php


namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class RepForum extends Model
{
    protected $table = "rep_forum";

    protected $fillable = ["req_id", "rep_msg", "rep_date", "rep_by", "rep_status", "root_rep_by"];
    public $timestamps = false;

}