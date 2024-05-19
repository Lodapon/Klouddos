<?php

namespace App\Http\Controllers;

use App\Http\Utils\SecureUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class RegisterController extends Controller
{
    public function hotelRegister(Request $request) {
 
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
        $username = $request['username'];
        $psw = $request['psw'];
        $salt = SecureUtil::generateRandomString();

        $passwd = SecureUtil::hashing([$username, $psw, $salt]);
        try{
        DB::beginTransaction();
       
        $accId = DB::table("user_account")->insertGetId(
            ['username' => $username,
            'password' => $passwd,
            'salt' => $salt,
            'role' => 'H',
            'status' => 'I',
            'email' => $email,
            'created_date' => date("Y-m-d")
            ]
        );
       $address =  $province.':'.$amphoe.':'.$district.':'.$zipcode;
        DB::table("user_profile")->insert(
            ['account_id' => $accId ,
            'first_name' => $name,
            'last_name' => $lastname,
            'address' => $address,
            'tel' => $telephone,
            'citizen_id_card' => '1000000000001'
            ]
        );
        DB::table("hotel_desc")->insert(
            ['account_id' => $accId ,
            'hotel_name' => $hotelname,
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
            $fNameCD = $accId.'-'.$fComDoc->getClientOriginalName();
            Storage::disk('comDoc')->put($fNameCD, file_get_contents($fComDoc));
            File::move(storage_path('app/public/comDoc/'.$fNameCD), public_path('storage/comDoc/'.$fNameCD));   
                DB::table("user_asset")->insert(
                    ['account_id' => $accId,
                    'asset_url' => 'comDoc/'.$fNameCD,
                    'asset_type' => '4' //doc
                    ]
                );
        }

        $fHotelDoc = $request->file('tha_doc');
       //public_path('hotelDoc/' . $accId . '/');
        // if (!Storage::exists($folderHD)) {
        //     Storage::makeDirectory($folderHD, 0775, true, true);
        // }
        if (!empty($fHotelDoc)) {
            $fNameHD = $accId.'-'.$fHotelDoc->getClientOriginalName();
            // $fHotelDoc->move($folderHD , $fHotelDoc->getClientOriginalName());  
                // Storage::disk(['drivers' => 'local', 'root' => $folderHD])->put($fHotelDoc->getClientOriginalName(), file_get_contents($fHotelDoc));
                Storage::disk('hotelDoc')->put($fNameHD, file_get_contents($fHotelDoc));
                File::move(storage_path('app/public/hotelDoc/'.$fNameHD), public_path('storage/hotelDoc/'.$fNameHD));
                DB::table("user_asset")->insert(
                    ['account_id' => $accId,
                    'asset_url' => 'hotelDoc/'.$fNameHD,
                    'asset_type' => '5' //license
                    ]
                );
        }
        
        $pic = $request->file('sample_pic');
        // $folder = public_path('image//' . $accId . '//');
        // if (!Storage::exists($folder)) {
            // Storage::makeDirectory($folder, 0775, true, true);
        // }
        if (!empty($pic)) {
            foreach($pic as $img) {
                // Storage::disk(['drivers' => 'local', 'root' => $folder])->put($img->getClientOriginalName(), file_get_contents($img));
                // $img->move($folder, $img->getClientOriginalName());  

                $imgName = $accId.'-'.$img->getClientOriginalName();
                Storage::disk('image')->put($imgName, file_get_contents($img));
                File::move(storage_path('app/public/image/'.$imgName), public_path('storage/image/'.$imgName));
                DB::table("user_asset")->insert(
                    ['account_id' => $accId,
                    'asset_url' => 'image/'.$imgName,
                    'asset_type' => '2' //room
                    ]
                );
            }
        }

        $logo = $request->file('profilepicH');
        if (!empty($logo)) {
            $fNameLogo = $accId.'-images.jpg';
            Storage::disk('image')->put($fNameLogo, file_get_contents($logo));
            File::move(storage_path('app/public/image/'.$fNameLogo), public_path('storage/image/'.$fNameLogo));
            DB::table("user_asset")->insert(
                ['account_id' => $accId,
                'asset_url' => 'image/'.$fNameLogo,
                'asset_type' => '1' //logo
                ]
            );
        }
        DB::commit();
        self::sendNoti();
    } catch(\Exception $e){
    //if there is an error/exception in the above code before commit, it'll rollback
        DB::rollBack();
        return $e->getMessage();
    }
        return redirect('/')->with('message', 'You have signed up successfully');
    }

    public function agentRegister(Request $request) {

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
        $username = $request['username'];
        $psw = $request['psw'];
        $salt = SecureUtil::generateRandomString();

        $passwd = SecureUtil::hashing([$username, $psw, $salt]);
        DB::beginTransaction();
        try{
        $accId = DB::table("user_account")->insertGetId(
            ['username' => $username,
            'password' => $passwd,
            'salt' => $salt,
            'role' => 'A',
            'status' => 'I',
            'email' => $email,
            'created_date' => date("Y-m-d")
            ]
        );
        $address =  $province.':'.$amphoe.':'.$district.':'.$zipcode;
        DB::table("user_profile")->insert(
            ['account_id' => $accId ,
            'first_name' => $name,
            'last_name' => $lastname,
            'address' => $address,
            'tel' => $telephone,
            'citizen_id_card' => '1000000000001'
            ]
        );
        DB::table("agent_desc")->insert(
            ['account_id' => $accId ,
            'agent_name' => $companyname,
            'agent_type' => $agenttype,
            'agent_address' => $agentaddress,
            'agent_email' => $email,
            'agent_tel' => $telephone
            ]
        );
        $fComDoc = $request->file('company_doc');
        if (!empty($fComDoc)) {
            $fNameCD = $accId.'-'.$fComDoc->getClientOriginalName();
            Storage::disk('comDoc')->put($fNameCD, file_get_contents($fComDoc));
            File::move(storage_path('app/public/comDoc/'.$fNameCD), public_path('storage/comDoc/'.$fNameCD));   
                DB::table("user_asset")->insert(
                    ['account_id' => $accId,
                    'asset_url' => 'comDoc/'.$fNameCD,
                    'asset_type' => '4' //doc
                    ]
                );
        }

        $logo = $request->file('profilepicA');
        if (!empty($logo)) {
            $fNameLogo = $accId.'-images.jpg';
                Storage::disk('image')->put($fNameLogo, file_get_contents($logo));
                File::move(storage_path('app/public/image/'.$fNameLogo), public_path('storage/image/'.$fNameLogo));
                DB::table("user_asset")->insert(
                    ['account_id' => $accId,
                    'asset_url' => 'image/'.$fNameLogo,
                    'asset_type' => '1' //logo
                    ]
                );
        }
        DB::commit();
        self::sendNoti();
    } catch(\Exception $e){
    //if there is an error/exception in the above code before commit, it'll rollback
        DB::rollBack();
        return $e->getMessage();
    }
    return redirect('/')->with('message', 'You have signed up successfully');
    }

    public function sendNoti() {
    ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	date_default_timezone_set("Asia/Bangkok");

	$sToken = "PdQMiE8wshKZPSmFccQGuCrTeOCADiiT9EPAEBJufDq";
	$sMessage = "มีคนสมัครเข้ามาจ้า....";

	
	$chOne = curl_init(); 
	curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
	curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
	curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
	curl_setopt( $chOne, CURLOPT_POST, 1); 
	curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
	$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
	curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
	curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
	$result = curl_exec( $chOne ); 

	//Result error 
	if(curl_error($chOne)) 
	{ 
		echo 'error:' . curl_error($chOne); 
	} 
	else { 
		$result_ = json_decode($result, true); 
		echo "status : ".$result_['status']; echo "message : ". $result_['message'];
	} 
	curl_close( $chOne );   
    }
}
