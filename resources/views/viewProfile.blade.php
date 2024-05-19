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
          Klous dos > View Profile > Profile
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
            <li class="list-group-item text-center">
              {{ round($avgScore, 1) }} of 5 score<BR/>
              @for ($i = 0; $i < round($avgScore, 0); ++$i)
                <i class="fa fa-star hotel-star"></i>
              @endfor
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
        <div class="card-header">
          <h3 class="card-title">Register Information</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <strong><i class="fa fa-book mr-1"></i> Name </strong>
          <p class="text-muted">{{$profile->first_name}}  {{$profile->last_name}}</p>

          <strong><i class="fa fa-book mr-1"></i> Email </strong>
          <p class="text-muted">{{$profile->email}}</p>

          <strong><i class="fa fa-book mr-1"></i> Telephone </strong>
          <p class="text-muted">{{$profile->tel}}</p>

        @if ($profile->role == 'A')
          <strong><i class="fa fa-book mr-1"></i> Company Name</strong>
          <p class="text-muted">{{$profile->profile_name}}</p>

          <strong><i class="fa fa-book mr-1"></i> Address</strong>
          <p class="text-muted">{{$profile->profile_address}}</p>
        @endif
        </div>
        @if ($profile->role == 'H')
        <div class="card-header">
          <h3 class="card-title">Hotel Information</h3>
        </div>
        <div class="card-body">
          <strong><i class="fa fa-map-marker-alt mr-1"></i> Hotel Name</strong>
          <p class="text-muted">{{$profile->profile_name}}</p>

          <strong><i class="fa fa-map-marker-alt mr-1"></i> Contact Email</strong>
          <p class="text-muted">{{$profile->profile_email}}</p>

          <strong><i class="fa fa-map-marker-alt mr-1"></i> Telephone</strong>
          <p class="text-muted">{{$profile->profile_tel}}</p>

          <strong><i class="fa fa-map-marker-alt mr-1"></i> Address</strong>
          <p class="text-muted">{{$profile->profile_address}}</p>

          <strong><i class="fa fa-map-marker-alt mr-1"></i> Map</strong>
          <p class="text-muted">
            <a href="{{$profile->hotel_map}}" target="_blank" class="text-muted">{{$profile->hotel_map}}</a>
          </p>
          <strong><i class="fa fa-map-marker-alt mr-1"></i> Rating</strong>
          <p class="text-muted">
{{--            {{$profile->hotel_rate}}  Stars--}}
            @for ($i = 0; $i < $profile->hotel_rate; ++$i)
              <i class="fa fa-star hotel-star"></i>
            @endfor
          </p>


          <strong><i class="fa fa-map-marker-alt mr-1"></i> Nearly Attraction</strong>
          <p class="text-muted">{{$profile->profile_location}}</p>
          </div>
        @endif

          <div class="card-header">
            <h3 class="card-title">View Documents</h3>
          </div>
          <div class="card-body">
            <strong><i class="fa fa-pencil-alt mr-1"></i> Company Document</strong>
            <p><button type="button" class="btn btn-primary btn-block" style="width: 16%;" onclick="showModal({{$profile->account_id}},4)" >View</button></p>
            @if ($profile->role == 'H')
            <strong><i class="fa fa-pencil-alt mr-1"></i> Thailand Hotel Association</strong>
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
            <strong><i class="fa fa-map-marker-alt mr-1"></i> Username</strong>
            <p class="text-muted">{{$profile->username}}</p>
            <strong><i class="fa fa-map-marker-alt mr-1"></i> Date Created</strong>
            <p class="text-muted">{{(new $carbon($profile->created_date))->format('d-M-Y')}}</p>

            <br>
            <div class="form-group row">
              <div class="col-sm-6 text-center">
                <a href="editProfile" class="btn btn-primary btn-block"><b>Edit Profile</b></a>
              </div> 
              <div class="col-sm-6 text-center">
                <a href="/landing" class="btn btn-danger btn-block"><b>Back</b></a>
              </div>
            </div>
          </div>

<!--           <div class="card-header">
            <h3 class="card-title">Contact Klouddos</h3>
          </div> -->
          <!-- <div class="card-body"> -->
            <!-- <link href="contact-form.css" rel="stylesheet"> -->
            <!--   <div id="fcf-form">
                <h3 class="fcf-h3">Contact us</h3>
                
                <form id="fcf-form-id" class="fcf-form-class" method="post" action="/sendDirectContact">
                  @csrf
                    <div class="fcf-form-group">
                        <label for="Name" class="fcf-label">Your subject</label>
                        <div class="fcf-input-group">
                            <input type="text" id="Name" name="Name" class="fcf-form-control" required>
                        </div>
                    </div>

                    <div class="fcf-form-group">
                        <label for="Email" class="fcf-label">Your email address</label>
                        <div class="fcf-input-group">
                            <input type="email" id="Email" name="Email" class="fcf-form-control" required>
                        </div>
                    </div>

                    <div class="fcf-form-group">
                        <label for="Message" class="fcf-label">Your message</label>
                        <div class="fcf-input-group">
                            <textarea id="Message" name="Message" class="fcf-form-control" rows="6" maxlength="3000" required></textarea>
                        </div>
                    </div>

                    <div class="fcf-form-group">
                        <button type="submit" id="fcf-button" class="btn btn-primary btn-block">Send Message</button>
                    </div>
                    <br>
                </form>
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{!!Session::get('success') !!}</li>
                        </ul>
                    </div>
                @endif
              </div>
          </div> -->

          
        
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
@endsection