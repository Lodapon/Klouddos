<?php

namespace App\Http\Controllers;

use App\Model\Location;

class LocationController extends Controller
{
    public function provinces()
  {
    $provinces = Location::select('ch_id', 'changwat_e')->distinct()->orderBy('changwat_e')->get();
    return response()->json($provinces);
  }
  public function amphoes($province_code)
  {
    $amphoes = Location::select('am_id', 'amphoe_e')->distinct()->where('ch_id',$province_code)->get();
    return response()->json($amphoes);
  }
  public function districts($province_code,$amphoe_code)
  {
    $districts = Location::select('ta_id', 'tambon_e')->distinct()->where('ch_id',$province_code)->where('am_id',$amphoe_code)->get();
    return response()->json($districts);
  }
  public function detail($province_code,$amphoe_code,$district_code)
  {
    $districts = Location::where('ch_id',$province_code)
      ->where('am_id',$amphoe_code)        
      ->where('ta_id',$district_code)
      ->get();
    return response()->json($districts);
  }
}
