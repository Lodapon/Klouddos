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
              <img class="profile-user-img img-fluid img-circle" src="../assets-admin/dist/img/user3-128x128.jpg" alt="User profile picture">
            </div>
            <!-- Hotel Name -->
            <h4 class="profile-username text-center">Grand Continental Hotel</h4> 
            <!-- Role : Hotel -->
            <p class="text-muted text-center">Hotel</p>

            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Post Reply  </b> <a class="float-right">32</a> <!-- or date join -->
              </li>
              <li class="list-group-item">
                <b>Deal</b> <a class="float-right">17</a>
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
            <p class="text-muted">Mr. Jarupath  Potter</p>

            <strong><i class="fas fa-book mr-1"></i> Email </strong>
            <p class="text-muted">Lordgift@hotmail.com</p>

            <strong><i class="fas fa-book mr-1"></i> Telephone </strong>
            <p class="text-muted">08x-xxx-xxxx</p>
          </div>

          <div class="card-header">
            <h3 class="card-title">Hotel Information</h3>
          </div>
          <div class="card-body">

            <strong><i class="fas fa-map-marker-alt mr-1"></i> Hotel Name</strong>
            <p class="text-muted">Inter Continental</p>

            <strong><i class="fas fa-map-marker-alt mr-1"></i> Contact Email</strong>
            <p class="text-muted">Intercontinental.hotel@mail.com</p>

            <strong><i class="fas fa-map-marker-alt mr-1"></i> Telephone</strong>
            <p class="text-muted">0x-xxx-xxxx</p>

            <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>
            <p class="text-muted">Malibu, California</p>

            <strong><i class="fas fa-map-marker-alt mr-1"></i> Rating</strong>
            <p class="text-muted">5 Stars</p>

            <strong><i class="fas fa-map-marker-alt mr-1"></i> Nearly Attraction</strong>
            <p class="text-muted">Central World, Siam Paragon, MBK center</p>
          </div>

          <div class="card-header">
            <h3 class="card-title">View Documents</h3>
          </div>
          <div class="card-body">

            <strong><i class="fas fa-pencil-alt mr-1"></i> Company Document</strong>
            <p><button type="button">View</button></p>
            <strong><i class="fas fa-pencil-alt mr-1"></i> Thailand Hotel Association</strong>
            <p><button type="button">View</button></p>
          </div>


          <div class="card-header">
            <h3 class="card-title">Your Sample Images</h3>
          </div>

          <div class="card-body">
            <img src="../assets-admin/dist/img/photo1.png" alt="example1" width="200" height="200">
            <img src="../assets-admin/dist/img/photo2.png" alt="example1" width="200" height="200">
            <img src="../assets-admin/dist/img/photo4.jpg" alt="example1" width="200" height="200">
          </div>

          <div class="card-header">
            <h3 class="card-title">Account Information</h3>
          </div>
          <div class="card-body">
            <strong><i class="fas fa-map-marker-alt mr-1"></i> Username</strong>
            <p class="text-muted">Lord Gift</p>
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