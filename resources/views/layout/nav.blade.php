<div class="headernav">
  <div class="container">
    <div class="row">
      <div class="col-lg-1 col-xs-3 col-sm-2 col-md-2 logo "><a href="/landing"><img src="{{ asset('images/Kloud Dos - LOGO-01.jpg') }}" alt="" height="65" /></a></div>
      <div class="avt">


        <!-- <div class="env pull-right"><i class="fa fa-user"></i></div> -->

        <div class="avatar pull-right dropdown">
          @if( session("user")->role == "A")
            <a href="/agent/post" class="btn btn-primary" style="margin-right: 20px">Start New Topic</a>
          @endif
          <a data-toggle="dropdown" href="#"><img src="{{ Storage::disk('image')->url('image/'.session("user")->account_id.'-images.jpg') }}" alt="" onerror="this.src='/assets-admin/images/KD_logo.png'"/><b class="caret"></b></a> 
          {{-- <a data-toggle="dropdown" href="#"><img src="{{ asset('images/avatar.jpg') }}" alt="" /></a> <b class="caret"></b> --}}
          <ul class="dropdown-menu" role="menu">
            <li role="presentation" style="margin-left: 10px;margin-right: 10px">Welcome back, {{ session("user")->username }}</li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="/viewProfile">My Profile</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-3" href="/contactus">Contact Klouddos</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-5" href="/logout">Log Out</a></li>
            <!-- <li role="presentation"><a role="menuitem" tabindex="-4" href="/register">Create account</a></li> -->
          </ul>

        </div>

        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>

{{-- <li role="presentation"><a role="menuitem" tabindex="-1" href="/viewProfileA">My Profile A</a></li>
     <li role="presentation"><a role="menuitem" tabindex="-1" href="/viewProfileH">My Profile H</a></li> --}}