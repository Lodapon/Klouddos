<?php

namespace App\Http\Controllers;

use App\Model\Location;
use App\Model\UserScore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
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
        return view('viewProfile')
            ->with('profile',$profile[0])
            ->with('pics',$pics)
            ->with('logo',$logoUrl)
            ->with('cpost',$post)
            ->with('avgScore', $userScore->average_score);
    }
    public function getAsset(Request $request){
        $userId = $request["userId"];
        $assetType = $request["assetType"];
        $userAssets = DB::table('user_asset')->where('account_id',$userId)->where('asset_type',$assetType)->get();
        return response()->json($userAssets[0]);
    }
    public function getAssetById($assetId){
        $userAssets = DB::table('user_asset')->where('asset_id',$assetId)->get();
        return response()->json($userAssets[0]);
    }
    public function viewProfile($id) {
        try {
            $account_id = $id;
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
           if($profile[0]->role== 'H'){
                $post = DB::table('rep_forum')->where('rep_by', $account_id)->count();
           } else {
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
        return view('profile')
            ->with('profile',$profile[0])
            ->with('pics',$pics)
            ->with('logo',$logoUrl)
            ->with('cpost',$post)
            ->with('avgScore', $userScore->average_score);
    }
    public function editProfile(Request $request) {
        try {
            $account_id = session("user")->account_id;
            $profile = DB::select('select user_account.account_id ,user_account.username,user_account.created_date ,user_account.`role` 
            ,user_account.status ,user_account.email ,user_account.reason ,user_profile.address
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
        
        $arrAddr =   explode(':',$profile[0]->address);

        $provinces = Location::select('ch_id', 'changwat_e')->distinct()->where('ch_id',$arrAddr[0])->orderBy('changwat_e')->get();
    
        $amphoes = Location::select('am_id', 'amphoe_e')->distinct()->where('am_id',$arrAddr[1])->get();

        $districts = Location::select('ta_id', 'tambon_e')->distinct()->where('ta_id',$arrAddr[2])->get();

        $addr = [ 'ch_id'=> $provinces[0]->ch_id,
                'changwat_e'=> $provinces[0]->changwat_e,
                'am_id'=> $amphoes[0]->am_id,
                'amphoe_e'=>$amphoes[0]->amphoe_e,
                'ta_id'=> $districts[0]->ta_id,
                'tambon_e'=>$districts[0]->tambon_e,
                'zipcode'=>$arrAddr[3]
                ];
        } catch(\Exception $e){
            return $e->getMessage();
        }
        // return view('viewProfile',['data'=> $data]);
        return view('editProfile')->with('profile',$profile[0])->with('pics',$pics)->with('logo',$logoUrl)->with('cpost',$post)->with('addr',$addr);
    }

    public function updateProfile(Request $request) {

        $account_id = session("user")->account_id;
        if(session("user")->role== 'H'){
            $name = $request["name"];
            $lastname = $request["lastname"];
            $email = $request["email"];
            $telephone = $request["telephone"];
            $hotelname = $request["hotelname"];
            $hotelemail = $request["hotelemail"];
            $hoteltel = $request["hoteltel"];
            $hoteladdress = $request["hoteladdress"];
            $hotelmap = $request["hotelmap"];  
            $rate = $request["rate"];
            $attraction = $request["attraction"];
            $province = $request["province"];
            $amphoe = $request["amphoe"];
            $district = $request["district"];
            $zipcode = $request["zipcode"];
            $address =  $province.':'.$amphoe.':'.$district.':'.$zipcode;
        
            try{
                DB::beginTransaction();
                DB::table("user_account")->where('account_id', $account_id)
                ->update(['email' => $email]);
                DB::table('user_profile')->where('account_id', $account_id)
                ->update(['first_name' => $name,
                'last_name' => $lastname,
                'address' => $address,
                'tel' => $telephone]);
                DB::table("hotel_desc")->where('account_id', $account_id)
                ->update(
                    ['hotel_name' => $hotelname,
                    'hotel_rate' => $rate,
                    'hotel_location' => $attraction,
                    'hotel_address' => $hoteladdress,
                    'hotel_email' => $hotelemail,
                    'hotel_tel' => $hoteltel,
                    'hotel_map' => $hotelmap  
                    ]
                );
                $fComDoc = $request->file('company_doc');
        
                if (!empty($fComDoc)) {
                    $oldDoc = DB::table("user_asset")->where('account_id', $account_id)->where('asset_type','4')->get();
                    $oldDocpath = public_path('storage').'/'.$oldDoc[0]->asset_url;
                    if(File::exists($oldDocpath)) File::delete($oldDocpath);
                    
                    $fNameCD = $account_id.'-'.$fComDoc->getClientOriginalName();
                    Storage::disk('comDoc')->put($fNameCD, file_get_contents($fComDoc));
                    File::move(storage_path('app/public/comDoc/'.$fNameCD), public_path('storage/comDoc/'.$fNameCD));
                        DB::table("user_asset")->where('account_id', $account_id)->where('asset_type','4')//doc
                        ->update(
                            ['asset_url' => 'comDoc/'.$fNameCD
                            ]
                        );
                }

                $fHotelDoc = $request->file('tha_doc');
           
                if (!empty($fHotelDoc)) {

                    $oldHDoc = DB::table("user_asset")->where('account_id', $account_id)->where('asset_type','5')->get();
                    $oldHDocpath = public_path('storage').'/'.$oldHDoc[0]->asset_url;
                    if(File::exists($oldHDocpath)) File::delete($oldHDocpath);
                    
                    $fNameHD = $account_id.'-'.$fHotelDoc->getClientOriginalName();
                    Storage::disk('hotelDoc')->put($fNameHD, file_get_contents($fHotelDoc));
                    File::move(storage_path('app/public/hotelDoc/'.$fNameHD), public_path('storage/hotelDoc/'.$fNameHD));
                        DB::table("user_asset")->where('account_id', $account_id)->where('asset_type','5')//license
                        ->update(
                            ['asset_url' => 'hotelDoc/'.$fNameHD
                            ]
                        );
                }
                
                $pic = $request->file('sample_pic');
                if (!empty($pic)) {
                    foreach($pic as $img) {
                        $imgName = $account_id.'-'.$img->getClientOriginalName();
                        Storage::disk('image')->put($imgName, file_get_contents($img));
                        File::move(storage_path('app/public/image/'.$imgName), public_path('storage/image/'.$imgName));
                        DB::table("user_asset")->insert(
                            ['account_id' => $account_id,
                            'asset_url' => 'image/'.$imgName,
                            'asset_type' => '2' //room
                            ]
                        );
                    }
                }

                $logo = $request->file('profilepicH');
                if (!empty($logo)) {
                    $fNameLogo = $account_id.'-images.jpg';
                    $logoPath = 'image/'.$fNameLogo;
                    
                    if(File::exists(public_path('storage').$logoPath)) File::delete(public_path('storage').$logoPath);
                    
                    Storage::disk('image')->put($fNameLogo, file_get_contents($logo));
                    File::move(storage_path('app/public/image/'.$fNameLogo), public_path('storage/'.$logoPath));
                    DB::table("user_asset")->where('account_id', $account_id)->where('asset_type','1')
                    ->update(
                        ['asset_url' => $logoPath
                        ]
                    );
                }

                DB::commit();

            } catch(\Exception $e){
                //if there is an error/exception in the above code before commit, it'll rollback
                    DB::rollBack();
                    return $e->getMessage();
            }
        
        }

        if(session("user")->role== 'A'){
            $name = $request["name"];
            $lastname = $request["lastname"];
            $email = $request["email"];
            $telephone = $request["telephone"];
            $companyname = $request["companyname"];
            $agenttype = $request["agenttype"];
            $agentaddress = $request["agentaddress"];
            $province = $request["province"];
            $amphoe = $request["amphoe"];
            $district = $request["district"];
            $zipcode = $request["zipcode"];

            try{
                DB::beginTransaction();
                DB::table("user_account")->where('account_id', $account_id)
                ->update(['email' => $email]);
                $address =  $province.':'.$amphoe.':'.$district.':'.$zipcode;
                DB::table("user_profile")->where('account_id', $account_id)
                ->update(
                    ['first_name' => $name,
                    'last_name' => $lastname,
                    'address' => $address,
                    'tel' => $telephone
                    // ,
                    // 'citizen_id_card' => '1000000000001'
                    ]
                );
                DB::table("agent_desc")->where('account_id', $account_id)
                ->update(
                    ['agent_name' => $companyname,
                    'agent_type' => $agenttype,
                    'agent_address' => $agentaddress,
                    'agent_email' => $email,
                    'agent_tel' => $telephone
                    ]
                );
                $fComDoc = $request->file('company_doc');
                if (!empty($fComDoc)) {
                    $oldDoc = DB::table("user_asset")->where('account_id', $account_id)->where('asset_type','4')->get();
                    $oldDocpath = public_path('storage').'/'.$oldDoc[0]->asset_url;
                    if(File::exists($oldDocpath)) File::delete($oldDocpath);
                    
                    $fNameCD = $account_id.'-'.$fComDoc->getClientOriginalName();
                    Storage::disk('comDoc')->put($fNameCD, file_get_contents($fComDoc));
                    File::move(storage_path('app/public/comDoc/'.$fNameCD), public_path('storage/comDoc/'.$fNameCD));
                        DB::table("user_asset")->where('account_id', $account_id)->where('asset_type','4')//doc
                        ->update(
                            ['asset_url' => 'comDoc/'.$fNameCD
                            ]
                        );
                }

                $logo = $request->file('profilepicA');
                if (!empty($logo)) {
                    $fNameLogo = $account_id.'-images.jpg';
                    $logoPath = 'image/'.$fNameLogo;
                    
                    if(File::exists(storage_path('app/public/image/').$logoPath)) File::delete(storage_path('app/public/image/').$logoPath);
                    
                    Storage::disk('image')->put($fNameLogo, file_get_contents($logo));
                    File::move(storage_path('app/public/image/'.$fNameLogo), public_path('storage/'.$logoPath));

                    DB::table("user_asset")->where('account_id', $account_id)->where('asset_type','1')
                    ->update(
                        ['asset_url' => $logoPath
                        ]
                    );
                }
                DB::commit();
            } catch(\Exception $e){
            //if there is an error/exception in the above code before commit, it'll rollback
                DB::rollBack();
                return $e->getMessage();
            }
        }


        return redirect('/viewProfile');
    }
}
