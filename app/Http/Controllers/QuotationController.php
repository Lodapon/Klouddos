<?php


namespace App\Http\Controllers;


use App\Http\Utils\MailUtils;
use App\Http\Utils\ReqStatus;
use App\Model\HotelDesc;
use App\Model\Quotation;
use App\Model\QuotationDetail;
use App\Model\ReqForum;
use App\Model\UserAsset;
use App\Model\UserScore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
class QuotationController
{
    function prepare(Request $request) {
        $reqId = $request["id"];
        $dealWith = $request["deal"];

        //clicked from reply (signed in)
        if ($dealWith == null) {
            if(session("user")->role == 'H') {
                $dealWith = session("user")->account_id;
            }
        }

        $params = $this->getQuotationInfo($reqId, $dealWith);
        return view("quotation.quogen")->with($params);
    }


    function submit(Request $request) {

        $reqId = $request["reqId"];
        $accountIdHotel = $request["dealWith"];
        $quotTopic = $request["quotTopic"];
        $quotList = $request["quotList"];
        $quotRemark = $request["quotRemark"];
        $quotTotal = $request["quotTotal"];


        $uploadedFile = $request->file('quo_doc');

        $voteScore = $request["voteScore"];

        DB::beginTransaction();

//        Log::debug($request["quotTopic"]);
        $inserted = Quotation::insertGetId([
            "quo_title" => $quotTopic,
            "quo_remark" => $quotRemark,
            "quo_total" => $quotTotal,
            "created_by" => $accountIdHotel,
            "req_id" => $reqId,
            'created_date' => date("Y-m-d H:i:s")
        ]);//(["quo_id", "created_by"]);

        if (isset($quotList)) {
            foreach ($quotList as $item) {
                QuotationDetail::query()->create([
                    "room_type" => $item["roomType"],
                    "amount" => $item["amount"],
                    "price_per_one" => $item["price"],
                    "quo_id" => $inserted
                ]);
            }
        }
        if (!empty($uploadedFile)) {
            $fNameHD = $inserted.'-'.$uploadedFile->getClientOriginalName();
            Storage::disk('quoDoc')->put($fNameHD, file_get_contents($uploadedFile));
            File::move(storage_path('app/public/quoDoc/'.$fNameHD), public_path('storage/quoDoc/'.$fNameHD));
            $asset_id = DB::table("user_asset")->insertGetId(
                [
                    'account_id' => $accountIdHotel,
                    'asset_url' => 'quoDoc/'.$fNameHD,
                    'asset_type' => '6' //license
                ]
            );

            Quotation::query()->where('quo_id', $inserted)->update([
               "asset_id" => $asset_id
            ]);
        }

        $forum = Quotation::query()
            ->join("req_forum as rf", "quotation.req_id", "=", "rf.req_id")
            ->join("user_account as ac", "ac.account_id", "=", "rf.created_by")
            ->join("agent_desc as ad", "ac.account_id", "=", "ad.account_id")
            ->where("quo_id", "=", $inserted)
            ->first(["req_topic", "agent_name", "agent_email", DB::raw("rf.created_by as agent_account_id")]);

        $hotel = HotelDesc::query()
            ->where("account_id", "=", $accountIdHotel)
            ->get(["hotel_name", "hotel_email"])
            ->first();

        UserScore::query()->create([
            "voted_to" => $forum->agent_account_id,
            "req_id" => $reqId,
            "score" => $voteScore,
            "voted_by" => $accountIdHotel
        ]);
        DB::commit();


        $link = config("app.url")."/quotation/preview?id=". $inserted;
        MailUtils::sendHotelQuotationEmailToAgent(
            $forum->agent_email,
            $hotel->hotel_name,
            $forum->agent_name,
            $forum->req_topic,
            $link);

        if(!$uploadedFile) {
          return ["message" => "Quotation in review."];
        } else{
          return redirect('/');
        }
    }

    /**
     * @param $reqId
     * @param $dealWith
     * @return array
     */
    public function getQuotationInfo($reqId, $dealWith): array
    {
        $forum = ReqForum::query()
            ->join("user_account as ua", "created_by", "=", "account_id")
            ->join("user_profile as up", "ua.account_id", "=", "up.account_id")
            ->join("agent_desc as ad", "ua.account_id", "=", "ad.account_id")
            ->where("req_id", "=", $reqId)
            ->first(["req_forum.*", DB::raw("concat(first_name, ' ', last_name) as agent_fullname"), "ad.agent_name", "ad.agent_email", "ad.agent_tel", "ad.agent_address"]);

        $hotel = HotelDesc::query()
            ->join("user_account as ua", "hotel_desc.account_id", "=", "ua.account_id")
            ->join("user_profile as up", "ua.account_id", "=", "up.account_id")
            ->where("hotel_desc.account_id", "=", $dealWith)
            ->first(["hotel_name", DB::raw("concat(first_name, ' ', last_name) as hotel_fullname"), "ua.account_id"]);

        $params = [
            "forumInfo" => $forum,
            "hotelInfo" => $hotel
        ];
        return $params;
    }

    public function quotationPreview(Request $request) {

        $quoId = $request["id"];

        $quot = Quotation::query()
            ->where("quo_id", "=", $quoId)
            ->first();

        $quotDetail = QuotationDetail::query()
            ->where("quo_id", "=", $quoId)
            ->get("*");

        $reqId = $quot["req_id"];
        $dealWith = $quot["created_by"];

        $params = $this->getQuotationInfo($reqId, $dealWith);
        $params["quotation"] = $quot;
        $params["quotationDetail"] = $quotDetail;
        return view("quotation.quo-preview")->with($params);
    }

    public function quotationPreviewSubmit(Request $request) {
        $quoId = $request["quoId"];
        $voteScore = $request["voteScore"];

        $quot = Quotation::query()
            ->where("quo_id", "=", $quoId)
            ->first(["req_id", DB::raw("created_by as hotel_account_id")]);

        DB::beginTransaction();
        ReqForum::query()
            ->where("req_id", "=", $quot["req_id"])
            ->update([
                "req_status" => ReqStatus::CLOSE
            ]);

        $forum = ReqForum::query()
            ->where("req_id", "=", $quot["req_id"])
            ->first(DB::raw("created_by as agent_account_id"));

        UserScore::query()->create([
            "voted_to" => $quot->hotel_account_id,
            "req_id" => $quot["req_id"],
            "score" => $voteScore,
            "voted_by" => $forum->agent_account_id
        ]);
        DB::commit();


        $forum = Quotation::query()
            ->join("req_forum as rf", "quotation.req_id", "=", "rf.req_id")
            ->join("user_account as ac", "ac.account_id", "=", "rf.created_by")
            ->join("agent_desc as ad", "ac.account_id", "=", "ad.account_id")
            ->where("quo_id", "=", $quoId)
            ->first(["req_topic", "agent_name", "agent_tel", "agent_email", "quotation.created_by"]);

        $hotel = HotelDesc::query()
            ->where("account_id", "=", $forum->created_by)
            ->first(["hotel_name", "hotel_email"]);

        MailUtils::sendAgentEndDealToHotel(
          $hotel->hotel_email,
          $hotel->hotel_name,
          $forum->agent_name,
          $forum->req_topic,
          $forum->agent_tel,
          $forum->agent_email);

        return ["message" => "Forum closed."];
    }

}