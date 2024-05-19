@extends('layout.mainlayout')
@section('content')
<script src="../../assets-custom/js/register.js"></script>
<style>
.content {
			/* height: 400px; */
			/* width: 80%; */
			margin-top: auto;
      margin-bottom: auto;
      margin: 0 auto;
			/* background: white; */
			position: relative;
			display: flex;
			justify-content: center;
			flex-direction: column;
			padding-bottom: 10px;
      padding-top: 10px;
      overflow-x: hidden;
      /* box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); */
			/* -webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); */
			/* -moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); */
			/* border-radius: 5px; */

		}
    .form-horizontal .form-group {
      margin-left: 15px;
      margin-right: 15px;
    }
    .bg{
      background-color: white;
      padding-left: 20px;
      padding-right: 20px;
      border-radius: 5px;
    }
    .vertical-center {
      display: flex;
      justify-content: center;
      align-items: center;
      max-width: 50%;
    }
</style>
{{-- <div class="container">
  <div class="row">
      <div class="col-lg-8 breadcrumbf">
          Klous dos > Sign up
      </div>
  </div>
</div> --}}
<div class="container" style="max-width: 800px;">
    <div class="bg row">
      <h1>Sign up</h1>
        <p>Please fill in this form to create an account.</p>
      <hr>
    <main role="main">
      <div id="content" center >
        <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
          <li class="active"><a href="#hotel" data-toggle="tab">Hotel</a>
          </li>
          <li><a href="#agent" data-toggle="tab" onclick="showAgProvinces()">Agent</a>
          </li>
        </ul>
      </div>
      <div id="my-tab-content" class="tab-content">
        <div class="tab-pane active" id="hotel">
          <form id="hotelRegForm" class="form-horizontal m-t-20" enctype="multipart/form-data" action="/regishotel" method="post">
            @csrf
            <div class="form-group">
              <h2>Hotel User Information</h2>
              {{-- <img src="{{ Storage::disk('image')->url('image/47-94121944_2833366110050896_254106620466823168_o.jpg') }}" style="width: 100%; height: 100%;"> --}}
              <div class="form-group row">
                <div class="col-sm-6">
                    <label for="name"><b>Name</b></label>
                    <input type="text" class="form-control"  placeholder="Enter Name" name="name" required>
                </div>
                <div class="col-sm-6">
                    <label for="name"><b>Lastname</b></label>
                    <input type="text" class="form-control"  placeholder="Enter Lastname" name="lastname" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-12">
                  <label for="email"><b>Email</b></label>
                  <input type="text" class="form-control" placeholder="Enter Email" name="email" required pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="Invalid email address">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-12">
                  <label for="telephone"><b>Telephone</b></label>
                  <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" placeholder="Enter Contact Number" name="telephone" required>
                </div>
              </div>

              <h2>Hotel Information</h2>
              <div class="form-group row">
                <div class="col-sm-12">
                  <label for="hotelname"><b>Hotel Name</b></label>
                  <input type="text" id="hotelname" class="form-control" placeholder="Enter Hotel Name" name="hotelname" onchange="hotelAddr()" required>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-sm-12">
                  <label for="email"><b>Hotel Email</b></label>
                  <input type="text" class="form-control" placeholder="Enter Hotel Email" name="hotelemail" required pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="Invalid email address">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-sm-12">
                  <label for="hoteltel"><b>Hotel Telephone</b></label>
                  <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" placeholder="Enter Hotel Telephone" name="hoteltel" required>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-sm-12">
                  <label for="hoteladdress"><b>Hotel Address</b></label>
                  <input type="hidden" id="hoteladdress" class="form-control" name="hoteladdress" />
                </div>
                <div class="col-sm-12" style="padding-bottom: 10px;">
                  <select class="form-control" id="input_province" name="province" onchange="showAmphoes()" required>
                    <option value="">กรุณาเลือกจังหวัด</option>
                  </select>
                </div>
                <div class="col-sm-12" style="padding-bottom: 10px;">
                  <select class="form-control" id="input_amphoe" name="amphoe" onchange="showDistricts()" required>
                    <option value="">กรุณาเลือกอำเภอ</option>
                  </select>
                </div>
                <div class="col-sm-12" style="padding-bottom: 10px;">
                  <select class="form-control" id="input_district" name="district"  required>
                    <option value="">กรุณาเลือกตำบล</option>
                  </select>
                </div>
                <div class="col-sm-12">
                  <input class="form-control" id="input_zipcode" name="zipcode" onchange="hotelAddr()"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Postal code" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-12">
                  <label for="hotelmap"><b>Hotel Link Map</b></label>
                  <input type="text" id="hotelmap" class="form-control" placeholder="Enter Hotel Google Map" name="hotelmap"  required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-12">
                  <label for="rate">Rating:</label>
                  <select class="form-control" id="rate" name="rate">
                    <option value="5">5 stars</option>
                    <option value="4">4 stars</option>
                    <option value="3">3 stars</option>
                    <option value="2">2 stars</option>
                    <option value="1">1 stars</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-6">
                  <label for="company_doc">Company Document:</label>
                  <input type="file" class="form-control" id="company_doc" name="company_doc" required>
                </div>
                <div class="col-sm-6">
                  <label for="tha_doc">Thailand Hotel Association Document:</label>
                  <input type="file" class="form-control" id="tha_doc" name="tha_doc" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-6">
                  <label for="sample_pic">Sample Image:</label>
                  <input type="file" class="form-control" id="sample_pic" name="sample_pic[]" multiple required>
                </div>
                <div class="col-sm-6">
                  <label for="sample_pic">Profile Picture/Logo:</label>
                  <input type="file" class="form-control" id="profilepicH" name="profilepicH" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-12">
                  <label for="attraction"><b>Nearby Attraction</b></label>
                  {{-- <input type="text" class="form-control"  name="attraction" required> --}}
                  <input type="text" class="form-control" placeholder="Enter Nearby Attraction" id="attraction" name="attraction" data-role="tagsinput" required/>
                </div>
              </div>

              <h2>Account Information</h2>
              <div class="form-group row">
                <div class="col-sm-12">
                  <label for="username"><b>Username</b></label>
                  <input type="text" class="form-control"  placeholder="Enter Username" name="username" pattern="\w+" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-12">
                  <label for="psw"><b>Password</b></label>
                  <input type="password" class="form-control"  placeholder="Enter Password" id="password" name="psw" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="The password must contain at least 6 characters including numbers, uppercase and lowercase characters">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-12">
                  <label for="psw-repeat"><b>Repeat Password</b></label>
                  <input type="password" class="form-control" placeholder="Repeat Password" id="confirm_password" required name="psw-repeat" >
                </div>
              </div>
            <hr>
              
            <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
              <div class="form-group row">
                <div class="col-sm-12 text-center">
                  <button class="btn btn-primary btn-bordred waves-effect waves-light" id="hotelReg" style="width: 50%;">Sign up</button>
                </div>
               </div>
            </div>
          
            <div class="container signin">
              <p>Already have an account? <a href="/">Sign in</a>.</p>
            </div>
        </form>
        </div>
        <div class="tab-pane" id="agent">
          <form id="agentRegForm" class="form-horizontal m-t-20" enctype="multipart/form-data" action="/regisagent" method="post">
            @csrf
            <div class="form-group">
              <h2>Agent Information</h2>

              <div class="form-group row">
                <div class="col-sm-6">
                    <label for="name"><b>Name</b></label>
                    <input type="text" class="form-control"  placeholder="Enter Name" name="name" required>
                </div>
                <div class="col-sm-6">
                    <label for="name"><b>Lastname</b></label>
                    <input type="text" class="form-control"  placeholder="Enter Lastname" name="lastname" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-12">
                  <label for="agenttype">Type:</label>
                  <select id="agenttype" class="form-control" name="agenttype">
                    <option value="1">Travel Agent</option>
                    <option value="2">Company</option>
                    <option value="3">Organizer</option>
                    <option value="4">Freelance</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-12">
                  <label for="email"><b>Email</b></label>
                  <input type="text" class="form-control" placeholder="Enter Email" name="email" required pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="Invalid email address">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-12">
                  <label for="telephone"><b>Telephone</b></label>
                  <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" placeholder="Enter Contact Number" name="telephone" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-12">
                  <label for="companyname"><b>Company Name</b></label>
                  <input type="text" id='companyname' class="form-control" placeholder="Enter Company Name" onchange="agentAddr()" name="companyname" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-12">
                  <label for="companyaddress"><b>Address</b></label>
                  <input type="hidden" id="agentaddress" name="agentaddress">
                </div>
                <div class="col-sm-12" style="padding-bottom: 10px;">
                  <select class="form-control" id="ag_province" name="province" onchange="showAgAmphoes()" required>
                    <option value="">กรุณาเลือกจังหวัด</option>
                  </select>
                </div>
                <div class="col-sm-12" style="padding-bottom: 10px;">
                  <select class="form-control" id="ag_amphoe" name="amphoe" onchange="showAgDistricts()" required>
                    <option value="">กรุณาเลือกอำเภอ</option>
                  </select>
                </div>
                <div class="col-sm-12" style="padding-bottom: 10px;">
                  <select class="form-control" id="ag_district" name="district" onchange="agentAddr()" required>
                    <option value="">กรุณาเลือกตำบล</option>
                  </select>
                </div>
                <div class="col-sm-12" style="padding-bottom: 10px;">
                  <input class="form-control" id="ag_zipcode" name="zipcode" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" onchange="agentAddr()" placeholder="Postal code" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-6">
                  <label for="company_doc">Company Document:</label>
                  <input type="file" class="form-control" id="company_doc" name="company_doc" required>
                </div>
                <div class="col-sm-6">
                  <label for="sample_pic">Profile Picture/Logo:</label>
                  <input type="file" class="form-control" id="profilepic_A" name="profilepicA" required>
                </div>
              </div>
              <h2>Account Information</h2>
              <div class="form-group row">
                <div class="col-sm-12">
                  <label for="psw"><b>Username</b></label>
                  <input type="text" class="form-control"  placeholder="Enter Username" name="username" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-12">
                  <label for="psw"><b>Password</b></label>
                  <input type="password" class="form-control"  placeholder="Enter Password" id="passworda" name="psw" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="The password must contain at least 6 characters including numbers, uppercase and lowercase characters">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-12">
                  <label for="psw-repeat"><b>Repeat Password</b></label>
                  <input type="password" class="form-control" placeholder="Repeat Password" id="confirm_passworda" required name="psw-repeat" >
                </div>
              </div>
              <hr>

              <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
              <div class="form-group row">
                <div class="col-sm-12 text-center">
                  <button class="btn btn-primary btn-bordred waves-effect waves-light" id="agentReg" style="width: 50%;">Sign up</button>
                </div>
              </div>
            </div>
          
            <div class="container signin">
              <p>Already have an account? <a href="/">Sign in</a>.</p>
            </div>
        </form>
        </div>
      </div>
    </div>
    </main>
  </div>
</div>
@endsection