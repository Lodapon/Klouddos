<?php


namespace App\Http\Controllers;


use App\Http\Utils\ReqStatus;
use App\Model\ReqForum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandingPageController
{
    private const ROW_PER_PAGE = 5;

    function index(Request $request) {
        $reqForums = null;

        $searchText = $request["q"];
        $dataList = [
            'forums' => self::retrieveForums($searchText),
//            'lastPageForums' => ceil(self::countForums($searchText)/self::ROW_PER_PAGE)
        ];

        return view("landing")->with($dataList);
    }

    private function retrieveForums(?String $searchText) {
        $reqForums = null;
        $searchTextWildcard = '%'.$searchText.'%';

        if ("" != $searchText && $searchText != null) {


            $role = session("user")->role;
            $account_id = session("user")->account_id;

            $reqForums = ReqForum::query()
                ->whereRaw("req_st_date >= NOW()")
                ->where("req_status", "=", ReqStatus::ACTIVE)
                ->whereRaw("(is_public = ? or created_by = ? or ?)", [true, session("user")->account_id, session("user")->role == "H"])
                ->whereRaw("(UPPER(req_topic) LIKE upper('{$searchTextWildcard}')")
                ->orWhereRaw("UPPER(req_location) LIKE upper('{$searchTextWildcard}'))")
                ->orderBy("updated_date", "desc")
                ->paginate(self::ROW_PER_PAGE,
                    ['*',
                     DB::raw("(select count(*) from rep_forum rp where req_forum.req_id = rp.req_id) as reply_amount,
                     (select count(DISTINCT(rep_by)) from rep_forum rp where  rp.req_id = req_forum.req_id and rp.rep_by <> req_forum.created_by) as c_reply_hotel ")
                    ]);

        } else {
            $reqForums = ReqForum::query()
                ->whereRaw("req_st_date >= NOW()")
                ->where("req_status", "=", ReqStatus::ACTIVE)
                ->whereRaw("(is_public = ? or created_by = ? or ?)", [true, session("user")->account_id, session("user")->role == "H"])
                ->orderBy("updated_date", "desc")
                ->paginate(self::ROW_PER_PAGE,
                    ['*',
                     DB::raw("(select count(*) from rep_forum rp where req_forum.req_id = rp.req_id) as reply_amount,
                     (select count(DISTINCT(rep_by)) from rep_forum rp where rp.req_id = req_forum.req_id and rp.rep_by <> req_forum.created_by) as c_reply_hotel ")
                    ]);
        }



        return $reqForums;
    }

//    private function countForums(?String $searchText) {
//        $count = null;
//        $searchTextWildcard = '%'.$searchText.'%';
//
//        if ("" != $searchText && $searchText != null) {
//            $count = DB::selectOne("select count(*) as count from req_forum where upper(req_topic) like upper(?) or upper(req_location) like upper(?)",
//                [$searchTextWildcard, $searchTextWildcard]);
//        } else {
//            $count = DB::selectOne("select count(*) as count from req_forum");
//        }
//
//        return $count->count;
//    }

}