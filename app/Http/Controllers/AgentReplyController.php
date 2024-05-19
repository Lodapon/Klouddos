<?php


namespace App\Http\Controllers;


use App\Http\Utils\ActiveFlag;
use App\Http\Utils\MailUtils;
use App\Model\HotelDesc;
use App\Model\RepForum;
use App\Model\ReqForum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AgentReplyController
{
    function index($id) {
        $reqforum = ReqForum::query()
            ->join("user_account as ua", "created_by", "=", "account_id")
            ->join("agent_desc as ad", "ua.account_id", "=", "ad.account_id")
            ->where("req_id", "=", $id)
            ->get(["req_forum.*", DB::raw("ad.agent_name as creator_fullname")])
            ->first();

        //hide reply if not forum owner
        $nestedReplies = null;
        if (session("user")->account_id == $reqforum->created_by) {
            $nestedReplies = $this->getHotelAndAgentReplies($id);
        }

        $dataList = [
            'forum' => $reqforum,
            'nestedReplies' => $nestedReplies
        ];

        return view("reply.agent-reply")->with($dataList);
    }

    function reply(Request $request) {
        $reqId = $request["reqId"];
        $replyTo = $request["replyTo"] ?: session("user")->account_id;

        DB::beginTransaction();
        RepForum::query()->create([
            "req_id" => $reqId,
            "rep_msg" => $request["replyText"],
            "rep_date" => date('Y-m-d H:i:s'),
            "rep_by" => session("user")->account_id,
            "rep_status" => ActiveFlag::ACTIVE,
            "root_rep_by" => $replyTo
        ]);

        $nestedReplies = $this->getHotelAndAgentReplies($reqId);

        DB::commit();

        $dataList = [
            'nestedReplies' => $nestedReplies
        ];
        return view("reply.agent-reply-block")->with($dataList);
    }

    function deal(Request $request) {
        $reqId = $request["reqId"];
        $dealWith = $request["dealWith"];

        Log::debug("Dealing >> ". $reqId . " with >> " . $dealWith);

        $forum = ReqForum::query()
            ->join("user_account as ua", "created_by", "=", "account_id")
            ->join("agent_desc as ad", "ua.account_id", "=", "ad.account_id")
            ->where("req_id", "=", $reqId)
            ->get(["req_topic", "ad.agent_name"])
            ->first();

        $hotel = HotelDesc::query()
            ->where("account_id", "=", $dealWith)
            ->get(["hotel_name", "hotel_email"])
            ->first();


        $link = config("app.url")."/quotation?id=". $reqId . "&deal=".$dealWith;
        //send email to hotel
        MailUtils::sendAgentInterestingEmailToHotel(
            $hotel->hotel_email,
            $hotel->hotel_name,
            $forum->agent_name,
            $forum->req_topic,
            $link);


        $nestedReplies = $this->getHotelAndAgentReplies($reqId);

        $dataList = [
            'nestedReplies' => $nestedReplies
        ];
        return view("reply.agent-reply-block")->with($dataList);
    }

    private function getHotelAndAgentReplies($reqId): array
    {
        $allHotelReplies = RepForum::query()->distinct()
            ->whereNotNull("root_rep_by")
            ->where("req_id", "=", $reqId)
            ->get("root_rep_by");

        $nestedReplies = [];
        foreach ($allHotelReplies as $row) {
            $replies = self::getRepliesByAgent($reqId, $row->root_rep_by);
            array_push($nestedReplies, $replies);
        }
        return $nestedReplies;
    }

    function getRepliesByAgent($reqId, $rootRepBy) {
        return RepForum::query()
            ->join("user_account as ua", "rep_by", "=", "account_id")
            ->leftJoin("agent_desc as ad", "ua.account_id", "=", "ad.account_id")
            ->leftJoin("hotel_desc as hd", "ua.account_id", "=", "hd.account_id")
            ->where("req_id", "=", $reqId)
            ->where("root_rep_by", "=", $rootRepBy)
            ->get(["rep_forum.*",
                "ua.role",
                DB::raw("COALESCE(ad.agent_name, hd.hotel_name) as replier_fullname")]);
    }

}