<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function userAprove(){
        $users = DB::select('select user_account.account_id ,user_account.username,user_account.created_date ,user_account.`role` 
        ,user_account.status ,user_account.email ,user_account.reason 
        ,user_profile.first_name ,user_profile.last_name
        ,hotel_desc.hotel_address ,hotel_desc.hotel_email ,hotel_desc.hotel_tel ,hotel_desc.hotel_location
        ,agent_desc.agent_address ,agent_desc.agent_email ,agent_desc.agent_tel 
        from user_account 
                inner join user_profile on user_account.account_id = user_profile.account_id  
                left join hotel_desc on user_account.account_id = hotel_desc.account_id
                left join agent_desc on user_account.account_id = agent_desc.account_id');
        return view('admin/admin_usersapprove',['users'=>$users]);
    }

    public function approveuser(Request $request) {
 
        $appruser = $request["appruser"];
        $apprreason = $request["apprreason"];
    try{
        DB::beginTransaction();
        $i = 0;
        foreach ($appruser as $user){
            DB::table('user_account')->where('account_id', $user)->update(['status' => 'A','reason' => $apprreason[$i]]);
            $i++;
        }
        DB::commit();
    } catch(\Exception $e){
    //if there is an error/exception in the above code before commit, it'll rollback
        DB::rollBack();
        return $e->getMessage();
    }
        return response()->redirectToIntended("admin/usersAP");
    }

    public function rejectuser(Request $request) {
 
        $appruser = $request["appruser"];
        $apprreason = $request["apprreason"];
    try{
        DB::beginTransaction();
            $i = 0;
        foreach ($appruser as $user){
            DB::table('user_account')->where('account_id', $user)->update(['status' => 'R','reason' => $apprreason[$i]]);
            $i++;
        }
        DB::commit();
    } catch(\Exception $e){
    //if there is an error/exception in the above code before commit, it'll rollback
        DB::rollBack();
        return $e->getMessage();
    }
        return response()->redirectToIntended("admin/usersAP");
    }

    public function forumReport(){
        // $users = DB::select('select * from user_account');
        $reports = DB::table('report')
            ->join('req_forum', 'report.req_id', '=', 'req_forum.req_id')
            ->join('user_account as rp', 'rp.account_id', '=', 'report.created_by')
            ->join('user_account as fr', 'fr.account_id', '=', 'req_forum.created_by')
            ->select('report.*', 'req_forum.*', 'fr.username','fr.role','rp.username as user_rp')
            ->get();
        return view('admin/admin_forumreport',['reports'=>$reports]);
    }

    public function dismissreport(Request $request) {
 
    $reports = $request["rep"];
    try{
        DB::beginTransaction();
        foreach ($reports as $report){
            $id = explode("|", $report);
            DB::table('report')->where('report_id', $id[0])->update(['status' => 'M']);
        }
        DB::commit();
    } catch(\Exception $e){
    //if there is an error/exception in the above code before commit, it'll rollback
        DB::rollBack();
        return $e->getMessage();
    }
        return response()->redirectToIntended("admin/forumRP");
    }

    public function deletereport(Request $request) {
 
    $reports = $request["rep"];
    try{
        DB::beginTransaction();
        foreach ($reports as $report){
            $id = explode("|", $report);
            DB::table('report')->where('report_id', $id[0])->update(['status' => 'D']);
            DB::table('req_forum')->where('req_id', $id[1])->update(['req_status' => 'I','updated_date' => date("Y-m-d")]);
        }
        DB::commit();
    } catch(\Exception $e){
    //if there is an error/exception in the above code before commit, it'll rollback
        DB::rollBack();
        return $e->getMessage();
    }
        return response()->redirectToIntended("admin/forumRP");
    }

    public function viewDoc(Request $request){
        $userId = $request["userId"];
        $userAssets = DB::table('user_asset')->where('account_id',$userId)->orderBy('asset_type')->get();
        return response()->json($userAssets);
    }

    public function dashboard(){

        $profile = DB::select('select ua.account_id,p.first_name ,p.last_name ,a.asset_url ,ua.created_date from user_account ua 
        join user_asset a on ua.account_id = a.account_id 
        join user_profile p on ua.account_id  = p.account_id 
        where a.asset_type = 1 order by ua.created_date DESC LIMIT 8');
        $activeForum = DB::table('req_forum')->where('req_status', 'A')->count();
        $archieves = DB::table('req_forum')->where('req_status', 'I')->count();
        $sales = DB::table('req_forum')->where('req_status', 'C')->count();
        $member = DB::table('user_account')->count();
        $order = DB::select('select q.quo_id , ad.agent_name ,hd.hotel_location ,hd.hotel_name ,q.quo_total from req_forum f 
        join quotation q on f.req_id = q.req_id 
        join user_profile ag on f.created_by  = ag.account_id 
        join user_profile ht on q.created_by  = ht.account_id
        join hotel_desc hd on ht.account_id = hd.account_id 
        join agent_desc  ad on ag.account_id = ad.account_id
        where f.req_status = "C" order by f.updated_date DESC LIMIT 8');
        // DB::table('req_forum')->join('quotation','req_forum.req_id', '=', 'quotation.req_id')->where('req_forum.req_status','C')->join('user_profile','user_profile.account_id', '=', 'quotation.created_by')->orderByDesc('req_forum.updated_date')->limit(7)->get(); 
        
        $dashboard = [
            'activeForum'  => $activeForum,
            'archieves'   => $archieves,
            'sales' => $sales,
            'member' => $member,
            'newMember' => sizeof($profile)
        ];
        return view('admin/admin_dashboard')->with('dashboard',$dashboard)->with('profile',$profile)->with('orders',$order);
        // return view('admin/admin_dashboard',['dashboard'=> $dashboard]);
    }

    public function menuNoti(){
        $users = DB::table('user_account')->where('status', 'I')->count();
        $forums = DB::table('report')->where('status', 'R')->count();
        $dashboard = [
            'uaappr'  => $users,
            'frappr'   => $forums
        ];

        return response()->json($dashboard);
    }
}
