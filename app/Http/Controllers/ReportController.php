<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function report(Request $request){
        $reqId = $request["reqId"];
        $repId = $request["repId"];
        $msg = $request["msg"];
        $account_id = session("user")->account_id;
        try{
            DB::beginTransaction();
            $report = DB::table('report')->insert(
                ['report_msg' => $msg,
                'req_id' => $reqId,
                'rep_id' => $repId,
                'status' => 'R',
                'created_by' => $account_id,
                'created_date' => date("Y-m-d")
                ]
            );
            // DB::table("req_forum")->where('req_id', $reqId)
            // ->update(['req_status' => 'R','updated_date' => date("Y-m-d")]);
            // if($repId){
            // DB::table("rep_forum")->where('rep_id', $repId)
            //         ->update(['rep_status' => 'R']);
            // }

            DB::commit();

        } catch(\Exception $e){
                //if there is an error/exception in the above code before commit, it'll rollback
            DB::rollBack();
            return $e->getMessage();
        }
        return response()->json($report);
    }
}
