<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgentPostController extends Controller
{

    function submit(Request $request) {
        $topic = $request["topic"];
        $roomAmount = intval($request["roomAmount"]);
        $hotelRating = $request["hotelRating"];
        $checkInDate = $request["checkInDate"];
        $checkOutDate = $request["checkOutDate"];
        $budget = $request["budget"];
        $attraction = $request["attraction"];
        $facilities = $request["facilities"];
        $isPublic = $request["isPublic"];
        $isAllowQuot = $request["allowQuot"];
        $isRatingRequired = $request["ratingRequired"];

        DB::table("req_forum")->insert(['req_topic' => $topic,
            'req_room' => $roomAmount,
            'req_rating' => $hotelRating,
            'req_st_date' => $checkInDate,
            'req_en_date' => $checkOutDate,
            'req_location' => $attraction,
            'req_remark' => $facilities,
            'req_budget' => $budget,
            'req_status' => 'A',
            'is_public' => ($isPublic == "1"),
            'is_allow_quot' => ($isAllowQuot == "1"),
            'is_rating_required' => ($isRatingRequired == "1"),
            'created_date' => date('Y-m-d H:i:s'),
            'created_by' => session("user")->account_id,
            'updated_date' => date('Y-m-d H:i:s')]);

        return response()->json(true);
    }
}