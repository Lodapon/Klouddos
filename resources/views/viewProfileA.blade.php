@extends('layout.mainlayout')

@section('content')
<div class="container">
  <div class="row">
      <div class="col-lg-8 breadcrumbf">
          Klous dos > View Profile > Agent Profile
      </div>
  </div>
</div>

<div class="container">

  <div class="row">
    <div class="col-md-3">
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <div class="text-center">
            <img class="profile-user-img img-fluid img-circle" src="../assets-admin/dist/img/user1-128x128.jpg" alt="User profile picture">
          </div>
          <!-- Hotel Name -->
          <h3 class="profile-username text-center">Tale to Tell Travel</h3> 
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
          <strong><i class="fas fa-book mr-1"></i> Name </strong>
          <p class="text-muted">Mr. Akemi  Doumbeldor</p>

          <strong><i class="fas fa-map-marker-alt mr-1"></i> Agent Type</strong>
          <p class="text-muted">Travel Agent</p>

          <strong><i class="fas fa-book mr-1"></i> Email </strong>
          <p class="text-muted">akermi@hotmail.com</p>

          <strong><i class="fas fa-book mr-1"></i> Telephone </strong>
          <p class="text-muted">08x-xxx-xxxx</p>

          <strong><i class="fas fa-map-marker-alt mr-1"></i> Company Name</strong>
          <p class="text-muted">Travel to tell .co.,Ltd.</p>

          <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>
          <p class="text-muted">Malibu, California</p>

          <hr>

          <div class="card-header">
            <h3 class="card-title">View Documents</h3>
          </div>

          <strong><i class="fas fa-pencil-alt mr-1"></i> Company Document</strong>
          <p><button type="button">View</button></p>

          <hr>

          <div class="card-header">
            <h3 class="card-title">Account Information</h3>
          </div>

          <strong><i class="fas fa-map-marker-alt mr-1"></i> Username</strong>
          <p class="text-muted">Lord Aker</p>
          <strong><i class="fas fa-map-marker-alt mr-1"></i> Date Created</strong>
          <p class="text-muted">11 Jan 2019</p>

          <br>

        </div>
        <!-- /.card-body -->
      </div>
    </div>
  </div>

  <a href="#" class="btn btn-primary btn-block"><b>Edit Profile</b></a>
  <a href="/landing" class="btn btn-primary btn-block"><b>Back</b></a>

  <br>
</div>
@endsection