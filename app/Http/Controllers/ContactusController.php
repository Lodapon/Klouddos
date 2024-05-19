<?php

namespace App\Http\Controllers;

use App\Model\Location;
use App\Model\UserScore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ContactusController
{
    public function viewMyProfile(Request $request) {
        try {
            $account_id = session("user")->account_id;
            $profile = DB::select('select user_account.account_id ,user_account.username,user_account.created_date ,user_account.`role` 
            ,user_account.status ,user_account.email ,user_account.reason 
            ,user_profile.first_name ,user_profile.last_name,user_profile.tel 
            ,COALESCE(agent_desc.agent_name, hotel_desc.hotel_name) as profile_name
            ,COALESCE(agent_desc.agent_address, hotel_desc.hotel_address) as profile_address
            ,COALESCE(agent_desc.agent_email, hotel_desc.hotel_email) as profile_email
            ,COALESCE(agent_desc.agent_tel, hotel_desc.hotel_tel) as profile_tel
            ,hotel_desc.hotel_location as profile_location
            ,agent_desc.agent_type ,hotel_desc.hotel_rate ,hotel_desc.hotel_map
             from user_account inner join user_profile on user_account.account_id = user_profile.account_id  
                    left join hotel_desc on user_account.account_id = hotel_desc.account_id
                    left join agent_desc on user_account.account_id = agent_desc.account_id
           where user_account.account_id = ?',array($account_id));
           $pics = DB::select('select * from user_asset where account_id = ? and asset_type = 2 ',array($account_id));
           $logo = DB::select('select * from user_asset where account_id = ? and asset_type = 1 ',array($account_id));
           
           if(!$logo){
            //set defalut logo profile pic
                $logoUrl = '/assets-admin/images/KD_logo.png';
           }else{
                $logoUrl = '../storage/'.$logo[0]->asset_url;
           }
          if(session("user")->role== 'H'){
             $post = DB::table('rep_forum')->where('rep_by', $account_id)->count();
          }else{
             $post = DB::table('req_forum')->where('created_by', $account_id)->count();
          }

        //    $data = [ 'profile'=> $profile,
        //             'asset'=>$asset ];
            $userScore = UserScore::query()
                ->where("voted_to", "=", $account_id)
                ->first(DB::raw("avg(score) as average_score"));
        } catch(\Exception $e){
            return $e->getMessage();
        }
        // return view('viewProfile',['data'=> $data]);
        return view('contactus')
            ->with('profile',$profile[0])
            ->with('pics',$pics)
            ->with('logo',$logoUrl)
            ->with('cpost',$post)
            ->with('avgScore', $userScore->average_score);
    }

}
