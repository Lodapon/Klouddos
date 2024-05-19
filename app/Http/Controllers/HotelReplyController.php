<?php


namespace App\Http\Controllers;


use App\Model\RepForum;
use App\Model\ReqForum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HotelReplyController
{
    function index($id) {
//        DB::enableQueryLog();
        $reqforum = ReqForum::query()
            ->join("user_account as ua", "created_by", "=", "account_id")
            ->join("agent_desc as ad", "ua.account_id", "=", "ad.account_id")
            ->where("req_id", "=", $id)
            ->get(["req_forum.*", DB::raw("ad.agent_name as creator_fullname")])
            ->first();

//        Log::debug(DB::getQueryLog());

        $replies = self::getReplies($reqforum->req_id,  [session("user")->account_id, $reqforum->created_by]);

        $dataList = [
            'forum' => $reqforum,
            'replies' => $replies
        ];

        return view("reply.hotel-reply")->with($dataList);
    }

    function reply(Request $request) {

        $replyTo = $request["replyTo"] ?: session("user")->account_id;


        DB::beginTransaction();
        RepForum::query()->create([
            "req_id" => $request["reqId"],
            "rep_msg" => $request["replyText"],
            "rep_date" => date('Y-m-d H:i:s'),
            "rep_by" => session("user")->account_id,
            "rep_status" => "A",
            "root_rep_by" => $replyTo
        ]);

        $forumOwner = ReqForum::query()
            ->where("req_id", "=", $request["reqId"])
            ->get("created_by")
            ->first();

        $replies = self::getReplies($request["reqId"], [$forumOwner->created_by, session("user")->account_id]);
        DB::commit();

        $dataList = [
            'replies' => $replies,
        ];
        return view("reply.hotel-reply-block")->with($dataList);
    }

    function getReplies($reqId, array $replyBy) {
        return RepForum::query()
            ->join("user_account as ua", "rep_by", "=", "account_id")
            ->leftJoin("agent_desc as ad", "ua.account_id", "=", "ad.account_id")
            ->leftJoin("hotel_desc as hd", "ua.account_id", "=", "hd.account_id")
            ->where("req_id", "=", $reqId)
            ->whereIn("rep_by",  $replyBy)
            ->where("root_rep_by", "=", session("user")->account_id)
            ->get(["rep_forum.*",
                "ua.role",
                DB::raw("COALESCE(ad.agent_name, hd.hotel_name) as replier_fullname")]);
    }

}