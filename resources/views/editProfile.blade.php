@extends('layout.mainlayout')
@inject('carbon', 'Illuminate\Support\Carbon')
@section('content')
<script>
function showModal(userId,assetType){
  $("#modalbody").empty(); 
  $.get({
    url: "getAsset",
    data: { "userId":userId,"assetType":assetType },
    success: function(res) {
            if(res.asset_type==4){
                $("#modalbody").append($('<p></p>').html("Company Document"));
            }else if(res.asset_type==5){
                $("#modalbody").append($('<p></p>').html("Thailand Hotel Association Document"));
            }
            $("#modalbody").append(
                // < src="path_of_your_pdf/your_pdf_file.pdf" type="application/pdf"   height="700px" width="500"></embed>
                $('<embed></embed>')
                    .attr("src", "/storage/"+res.asset_url).attr("type","application/pdf").attr("width","100%").attr("height","700px")
                    .html(""+res.asset_url)
                );
    }
  });
        // open the other modal
        $("#myModal").modal("show");
}

function showProvinces(){
    //PARAMETERS
    var url = "/api/province";
    var callback = function(result){
        $("#input_province").empty();
        for(var i=0; i<result.length; i++){
            $("#input_province").append(
                $('<option></option>')
                    .attr("value", ""+result[i].ch_id)
                    .html(""+result[i].changwat_e)
            );
        }
       
       // showAmphoes();
    };
    //CALL AJAX
    ajax(url,callback);
    $("#input_province").removeAttr("onclick");
}

function showAmphoes(){
    //INPUT
    var province_code = $("#input_province").val();
    //PARAMETERS
    var url = "/api/province/"+province_code+"/amphoe";
    var callback = function(result){
        //console.log(result);
        $("#input_amphoe").empty();
        for(var i=0; i<result.length; i++){
            $("#input_amphoe").append(
                $('<option></option>')
                    .attr("value", ""+result[i].am_id)
                    .html(""+result[i].amphoe_e)
            );
        }
        showDistricts();
    };
    //CALL AJAX
    ajax(url,callback);
}

function showDistricts(){
    //INPUT
    var province_code = $("#input_province").val();
    var amphoe_code = $("#input_amphoe").val();
    //PARAMETERS
    var url = "/api/province/"+province_code+"/amphoe/"+amphoe_code+"/district";
    var callback = function(result){
        //console.log(result);
        $("#input_district").empty();
        for(var i=0; i<result.length; i++){
            $("#input_district").append(
                $('<option></option>')
                    .attr("value", ""+result[i].ta_id)
                    .html(""+result[i].tambon_e)
            );
        }
        // showZipcode();
        hotelAddr();
    };
    //CALL AJAX
    ajax(url,callback);
}

function hotelAddr(){
    var hotelAddr =  $("#hotelname").val() 
    + ' ' + $("#input_district option:selected").text().trim()
    + ' ' + $("#input_amphoe option:selected").text().trim()
    + ' ' + $("#input_province option:selected").text().trim()
    + ' ' + $("#input_zipcode" ).val();
    $("#hoteladdress").val(hotelAddr);

}
function agentAddr(){
    var agentAddr =  $("#companyname").val()
    + ' ' + $("#ag_district option:selected").text().trim()
    + ' ' + $("#ag_amphoe option:selected").text().trim()
    + ' ' + $("#ag_province option:selected").text().trim()
    + ' ' + $("#ag_zipcode" ).val();
    $("#agentaddress").val(agentAddr);

}
function showAgProvinces(){
    //PARAMETERS
    
    var url = "/api/province";
    var callback = function(result){
      $("#ag_province").empty();
        for(var i=0; i<result.length; i++){
            $("#ag_province").append(
                $('<option></option>')
                    .attr("value", ""+result[i].ch_id)
                    .html(""+result[i].changwat_e)
            );
        }
        // $('#ag_province').attr('size', result.length)
      
       // showAgAmphoes();
    };
    //CALL AJAX
    ajax(url,callback);
    $("#ag_province").removeAttr("onclick");
}

function showAgAmphoes(){
    //INPUT
    var province_code = $("#ag_province").val();
    //PARAMETERS
    var url = "/api/province/"+province_code+"/amphoe";
    var callback = function(result){
        //console.log(result);
        $("#ag_amphoe").empty();
        for(var i=0; i<result.length; i++){
            $("#ag_amphoe").append(
                $('<option></option>')
                    .attr("value", ""+result[i].am_id)
                    .html(""+result[i].amphoe_e)
            );
        }
        showAgDistricts();
    };
    //CALL AJAX
    ajax(url,callback);
}

function showAgDistricts(){
    //INPUT
    var province_code = $("#ag_province").val();
    var amphoe_code = $("#ag_amphoe").val();
    //PARAMETERS
    var url = "/api/province/"+province_code+"/amphoe/"+amphoe_code+"/district";
    var callback = function(result){
        //console.log(result);
        $("#ag_district").empty();
        for(var i=0; i<result.length; i++){
            $("#ag_district").append(
                $('<option></option>')
                    .attr("value", ""+result[i].ta_id)
                    .html(""+result[i].tambon_e)
            );
        }
        // showZipcode();
    };
    //CALL AJAX
    ajax(url,callback);
}
function ajax(url, callback){
    $.ajax({
        "url" : url,
        "type" : "GET",
        "dataType" : "json",
    })
        .done(callback); //END AJAX
}
</script>
<style>
.card{
  border: solid 1px #dee1e3;
  background-color: white;
}
.card-header {
  padding: .75rem 1.25rem;
  margin-bottom: 10px;
  background-color: rgba(0, 0, 0, .03);
  border-bottom: 1px solid rgba(0,0,0,.125);
  color:#003580;
}.card-body{
  padding-left: 15px;
  padding-right: 15px;
}
</style>
<div class="container">
  <div class="row">
      <div class="col-lg-8 breadcrumbf">
          Klous dos > Edit Profile > Profile
      </div>
  </div>
</div>

<div class="container">

  <div class="row">
    <div class="col-md-3">
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <div class="text-center">
            <img class="profile-user-img img-fluid img-circle" style="width: 128px;height: 128px;border: solid 1px #dee1e3;margin-top: 10px;" src="{{$logo}}" alt="User profile picture" onerror="this.src='/assets-admin/images/KD_logo.png'">
          </div>
          <!-- Hotel Name -->
          {{-- @foreach($data['profile'] as $profile) --}}
            <h3 class="profile-username text-center" style="color:#003580;">{{$profile->profile_name}}</h3> 
          {{-- @endforeach --}}
        
          <!-- Role : Hotel -->
          @if ($profile->role == 'H')
          <p class="text-muted text-center">Hotel</p>
          @else
            @switch($profile->agent_type)
                @case(1)
                  <p class="text-muted text-center">Travel Agent</p>
                  @break
                @case(2)
                  <p class="text-muted text-center">Company</p>
                  @break
                @case(3)
                  <p class="text-muted text-center">Organizer</p>
                  @break

                @case(4)
                  <p class="text-muted text-center">Freelance</p>
                  @break
            @endswitch
          @endif
          <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
              @if ($profile->role == 'H')
                <b>Post Reply</b> <a class="float-right">{{$cpost}}</a>
                @else 
                <b>Post Create</b> <a class="float-right">{{$cpost}}</a>
              @endif
            </li>
            {{-- <li class="list-group-item">
              <b>Deal</b> <a class="float-right">0</a>
            </li> --}}
          </ul>
          <p class="text-muted text-center">Created : {{(new $carbon($profile->created_date))->format('d-M-Y')}}</p>
        </div>
      </div>
    </div>
    <div class="col-md-9">
      <div class="card card-primary">
        @if ($profile->role == 'A')
        <div class="card-header">
          <h3 class="card-title">Register Information</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <form id="agentRegForm" class="form-horizontal m-t-20" enctype="multipart/form-data" action="/updateProfile" method="post">
            @csrf
            <div class="form-group row">
            <div class="col-sm-6">
                <label for="name"><b>Name</b></label>
                <input type="text" class="form-control"  placeholder="Enter Name" name="name" value="{{$profile->first_name}}" required>
            </div>
            <div class="col-sm-6">
                <label for="name"><b>Lastname</b></label>
                <input type="text" class="form-control"  placeholder="Enter Lastname" name="lastname" value="{{$profile->last_name}}" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-12">
              <label for="agenttype">Type:</label>
             
              <select id="agenttype" class="form-control" name="agenttype">
                <option value="1" {{ ($profile->agent_type == "1") ? "selected" : "" }}>Travel Agent</option>
                <option value="2" {{ ($profile->agent_type == "2") ? "selected" : "" }}>Company</option>
                <option value="3" {{ ($profile->agent_type == "3") ? "selected" : "" }}>Organizer</option>
                <option value="4" {{ ($profile->agent_type == "4") ? "selected" : "" }}>Freelance</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-12">
              <label for="email"><b>Email</b></label>
              <input type="text" class="form-control" placeholder="Enter Email" name="email" value="{{$profile->email}}" required pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="Invalid email address">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-12">
              <label for="telephone"><b>Telephone</b></label>
              <input type="text" value="{{$profile->tel}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" placeholder="Enter Contact Number" name="telephone" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-12">
              <label for="companyname"><b>Company Name</b></label>
              <input type="text" value="{{$profile->profile_name}}" id="companyname" class="form-control" placeholder="Enter Company Name" onchange="agentAddr()" name="companyname" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-12">
              <label for="companyaddress"><b>Address</b></label>
              <input type="hidden" id="agentaddress" name="agentaddress">
            </div>
              
            <div class="col-sm-12" style="padding-bottom: 10px;">
              <select class="form-control" id="ag_province" name="province" onclick="showAgProvinces()" onchange="showAgAmphoes()" required>
                <option value="{{ $addr['ch_id'] }}"> {{$addr['changwat_e'] }}</option>
                <option value=""></option>
                <option value=""></option>
                <option value=""></option>
                <option value=""></option>
              </select>
            </div>
            <div class="col-sm-12" style="padding-bottom: 10px;">
              <select class="form-control" id="ag_amphoe" name="amphoe" onchange="showAgDistricts()" required>
                <option value="{{ $addr['am_id'] }}">{{$addr['amphoe_e'] }}</option>
              </select>
            </div>
            <div class="col-sm-12" style="padding-bottom: 10px;">
              <select class="form-control" id="ag_district" name="district" onchange="agentAddr()" required>
                <option value="{{ $addr['ta_id'] }}">{{$addr['tambon_e'] }}</option>
              </select>
            </div>
            <div class="col-sm-12" style="padding-bottom: 10px;">
              <input class="form-control" value="{{ $addr['zipcode'] }}" id="ag_zipcode" name="zipcode" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" onchange="agentAddr()" placeholder="Postal code" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-6">
              <label for="company_doc">Company Document:</label>
              <input type="file" class="form-control" id="company_doc" name="company_doc">
            </div>
            <div class="col-sm-6">
              <label for="sample_pic">Profile Picture/Logo:</label>
              <input type="file" class="form-control" id="profilepic_A" name="profilepicA">
            </div>
          </div>
            <br>
            <div class="form-group row">
              <div class="col-sm-6 text-center">
                <button class="btn btn-primary btn-block" type="submit" >Update Profile</button>
              </div> 
              <div class="col-sm-6 text-center">
                <a href="javascript:history.go(-1)" class="btn btn-danger btn-block"><b>Back</b></a>
              </div>
            </div>
          </form>
        </div>
        @endif
        @if ($profile->role == 'H')
        <div class="card-header">
          <h3 class="card-title">Register Information</h3>
        </div>
        <div class="card-body">
          <form id="hotelRegForm" class="form-horizontal m-t-20" enctype="multipart/form-data" action="/updateProfile" method="post">
            @csrf
              {{-- <img src="{{ Storage::disk('image')->url('image/47-94121944_2833366110050896_254106620466823168_o.jpg') }}" style="width: 100%; height: 100%;"> --}}
              <div class="form-group row">
                <div class="col-sm-6">
                    <label for="name"><b>Name</b></label>
                    <input type="text" value="{{$profile->first_name}}" class="form-control"  placeholder="Enter Name" name="name" required>
                </div>
                <div class="col-sm-6">
                    <label for="name"><b>Lastname</b></label>
                    <input type="text" value="{{$profile->last_name}}" class="form-control"  placeholder="Enter Lastname" name="lastname" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-12">
                  <label for="email"><b>Email</b></label>
                  <input type="text" value="{{$profile->email}}" class="form-control" placeholder="Enter Email" name="email" required pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="Invalid email address">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-12">
                  <label for="telephone"><b>Telephone</b></label>
                  <input type="text" value="{{$profile->tel}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" placeholder="Enter Contact Number" name="telephone" required>
                </div>
              </div>

              <h3>Hotel Information</h3>
              <div class="form-group row">
                <div class="col-sm-12">
                  <label for="hotelname"><b>Hotel Name</b></label>
                  <input type="text" value="{{$profile->profile_name}}" id="hotelname" class="form-control" placeholder="Enter Hotel Name" name="hotelname" onchange="hotelAddr()" required>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-sm-12">
                  <label for="email"><b>Hotel Email</b></label>
                  <input type="text" value="{{$profile->profile_email}}" class="form-control" placeholder="Enter Hotel Email" name="hotelemail" required pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="Invalid email address">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-sm-12">
                  <label for="hoteltel"><b>Hotel Telephone</b></label>
                  <input type="text" value="{{$profile->profile_tel}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" placeholder="Enter Hotel Telephone" name="hoteltel" required>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-sm-12">
                  <label for="hoteladdress"><b>Hotel Address</b></label>
                  <input type="hidden" id="hoteladdress" class="form-control" name="hoteladdress" />
                </div>
                <div class="col-sm-12" style="padding-bottom: 10px;">
                  <select class="form-control" id="input_province" name="province" onclick="showProvinces()" onchange="showAmphoes()" required>
                    <option value="{{ $addr['ch_id'] }}"> {{$addr['changwat_e'] }}</option>
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>
                  </select>
                </div>
                <div class="col-sm-12" style="padding-bottom: 10px;">
                  <select class="form-control" id="input_amphoe" name="amphoe" onchange="showDistricts()" required>
                    <option value="{{ $addr['am_id'] }}">{{$addr['amphoe_e'] }}</option>
                  </select>
                </div>
                <div class="col-sm-12" style="padding-bottom: 10px;">
                  <select class="form-control" id="input_district" name="district"  required>
                    <option value="{{ $addr['ta_id'] }}">{{$addr['tambon_e'] }}</option>
                  </select>
                </div>
                <div class="col-sm-12">
                  <input class="form-control" value="{{ $addr['zipcode'] }}" id="input_zipcode" name="zipcode" onchange="hotelAddr()"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Postal code" required>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-sm-12">
                  <label for="hotelmap"><b>Hotel Link Map</b></label>
                  <input type="text" value="{{$profile->hotel_map}}" id="hotelmap" class="form-control" placeholder="Enter Hotel Google Map" name="hotelmap"  required>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-sm-12">
                  <label for="rate">Rating:</label>
                  <select class="form-control" id="rate" name="rate">
                    <option value="5" {{($profile->hotel_rate == "5") ? "selected" : "" }}>5 stars</option>
                    <option value="4" {{($profile->hotel_rate == "4") ? "selected" : "" }}>4 stars</option>
                    <option value="3" {{($profile->hotel_rate == "3") ? "selected" : "" }}>3 stars</option>
                    <option value="2" {{($profile->hotel_rate == "2") ? "selected" : "" }}>2 stars</option>
                    <option value="1" {{($profile->hotel_rate == "1") ? "selected" : "" }}>1 stars</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-6">
                  <label for="company_doc">Company Document:</label>
                  <input type="file" class="form-control" id="company_doc" name="company_doc">
                </div>
                <div class="col-sm-6">
                  <label for="tha_doc">Thailand Hotel Association Document:</label>
                  <input type="file" class="form-control" id="tha_doc" name="tha_doc">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-6">
                  <label for="sample_pic">Sample Image:</label>
                  <input type="file" class="form-control" id="sample_pic" name="sample_pic[]" multiple>
                </div>
                <div class="col-sm-6">
                  <label for="sample_pic">Profile Picture/Logo:</label>
                  <input type="file" class="form-control" id="profilepicH" name="profilepicH">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-12">
                  <label for="attraction"><b>Nearly Attractions</b></label>
                  <input type="hidden" id="tag" value="{{$profile->profile_location}}">
                  <input type="text" class="form-control" placeholder="Enter Nearly Attractions" id="attraction" name="attraction" data-role="tagsinput" required/>
                </div>
              </div>
            </div>

            <br>
            <div class="form-group row">
              <div class="col-sm-6 text-center">
                <button class="btn btn-primary btn-block" type="submit" >Update Profile</button>
              </div> 
              <div class="col-sm-6 text-center">
                <a href="javascript:history.go(-1)" class="btn btn-danger btn-block"><b>Back</b></a>
              </div>
            </div>
            </form>
          {{-- <strong><i class="fas fa-map-marker-alt mr-1"></i> Hotel Name</strong>
          <p class="text-muted">{{$profile->profile_name}}</p>

          <strong><i class="fas fa-map-marker-alt mr-1"></i> Contact Email</strong>
          <p class="text-muted">{{$profile->profile_email}}</p>

          <strong><i class="fas fa-map-marker-alt mr-1"></i> Telephone</strong>
          <p class="text-muted">{{$profile->profile_tel}}</p>

          <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>
          <p class="text-muted">{{$profile->profile_address}}</p>

          <strong><i class="fas fa-map-marker-alt mr-1"></i> Rating</strong>
          <p class="text-muted">{{$profile->hotel_rate}}  Stars</p>

          <strong><i class="fas fa-map-marker-alt mr-1"></i> Nearly Attraction</strong>
          <p class="text-muted">{{$profile->profile_location}}</p>
          </div> --}}
        @endif

          <div class="card-header">
            <h3 class="card-title">View Documents</h3>
          </div>
          <div class="card-body">
            <strong><i class="fas fa-pencil-alt mr-1"></i> Company Document</strong>
            <p><button type="button" class="btn btn-primary btn-block" style="width: 16%;" onclick="showModal({{$profile->account_id}},4)" >View</button></p>
            @if ($profile->role == 'H')
            <strong><i class="fas fa-pencil-alt mr-1"></i> Thailand Hotel Association</strong>
            <p><button type="button" class="btn btn-primary btn-block" style="width: 16%;" onclick="showModal({{$profile->account_id}},5)" >View</button></p>
          </div>
          <div class="card-header">
            <h3 class="card-title">Your Sample Images</h3>
          </div>
          <div class="card-body">
            @foreach ($pics as $pic)
            <img src="../storage/{{$pic->asset_url}}" alt="example1" width="200" height="200">
            @endforeach
            {{-- <img src="../assets-admin/dist/img/photo1.png" alt="example1" width="200" height="200">
            <img src="../assets-admin/dist/img/photo2.png" alt="example1" width="200" height="200">
            <img src="../assets-admin/dist/img/photo4.jpg" alt="example1" width="200" height="200"> --}}
            @endif
          </div>
          <div class="card-header">
            <h3 class="card-title">Account Information</h3>
          </div>
          <div class="card-body">
            <strong><i class="fas fa-map-marker-alt mr-1"></i> Username</strong>
            <p class="text-muted">{{$profile->username}}</p>
            <strong><i class="fas fa-map-marker-alt mr-1"></i> Date Created</strong>
            <p class="text-muted">{{(new $carbon($profile->created_date))->format('d-M-Y')}}</p>
          </div>
        
        <!-- /.card-body -->
      </div>
    </div>
  </div>

  
  <br>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">View Document</h4>
      </div>
      <div class="modal-body">
        <div id="modalbody"><p>Some text in the modal.</p></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script>
  $(document).ready(function() {
    hotelAddr();
    agentAddr();
    var tag = $("#tag").val();
    if(tag){
      $('#attraction').tagsinput('add',tag);
    }
  });	
  </script>
@endsection