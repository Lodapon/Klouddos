@extends('layout.frontlayout')

@section('content')
<script src="../../assets-custom/js/register.js"></script>



<section id="main" class="wrapper">
  <div class="inner">
    <!-- Content -->
    <h2 id="content">View Profile</h2>

    <div class="row uniform">
      <div class="3u 12u$(xsmall)">
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle" src="../assets-admin/dist/img/user1-128x128.jpg" alt="User profile picture">
            </div>
            <!-- Hotel Name -->
            <h4 class="profile-username text-center">Tale to Tell Travel</h4> 
            <!-- Role : Hotel -->
            <p class="text-muted text-center">Travel Agent</p>

            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Post Create</b> <a class="float-right">15</a>
              </li>
              <li class="list-group-item">
                <b>Deal</b> <a class="float-right">15</a>
              </li>
            </ul>
            <p class="text-muted text-center">Created : 13 Jan 2020</p>
          </div>
        </div>
      </div>
      <div class="9u 12u$(xsmall)">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Register Information</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <strong><i class="fas fa-book mr-1"></i> Name </strong>
            <p class="text-muted">Mr. Akemi  Doumbeldor</p>

            <strong><i class="fas fa-book mr-1"></i> Agent Type</strong>
            <p class="text-muted">Travel Agent</p>

            <strong><i class="fas fa-book mr-1"></i> Email </strong>
            <p class="text-muted">akermi@hotmail.com</p>

            <strong><i class="fas fa-book mr-1"></i> Telephone </strong>
            <p class="text-muted">08x-xxx-xxxx</p>

            <strong><i class="fas fa-book mr-1"></i> Company Name</strong>
            <p class="text-muted">Travel to tell .co.,Ltd.</p>

            <strong><i class="fas fa-book mr-1"></i> Address</strong>
            <p class="text-muted">Malibu, California</p>
          </div>

          <div class="card-header">
            <h3 class="card-title">View Documents</h3>
          </div>
          <div class="card-body">
            <strong><i class="fas fa-pencil-alt mr-1"></i> Company Document</strong>
            <p><button type="button">View</button></p>
          </div>

          <div class="card-header">
            <h3 class="card-title">Account Information</h3>
          </div>
          <div class="card-body">
            <strong><i class="fas fa-map-marker-alt mr-1"></i> Username</strong>
            <p class="text-muted">Lord Aker</p>
            <strong><i class="fas fa-map-marker-alt mr-1"></i> Date Created</strong>
            <p class="text-muted">11 Jan 2019</p>
          </div>
          <!-- /.card-body -->
        </div> 

        <br>
        <ul class="actions fit small">
          <li><a href="#" class="button special fit small" id="agentReg">Edit Profile</a></li>
          <li><a href=/ class="button fit small">Cancel</a></li>
        </ul>

      </div>

      

    </div>

    
  </div>
</section>





@endsection