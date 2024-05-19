@extends('layout.frontlayout')

@section('content')
<script src="../../assets-custom/js/register.js"></script>
<style>
  body {font-family: Arial;}

  /* Style the tab */
  .tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
  }

  /* Style the buttons inside the tab */
  .tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
  }

  /* Change background color of buttons on hover */
  .tab button:hover {
    background-color: #003580;
  }

  /* Create an active/current tablink class */
  .tab button.active {
    background-color: #003580;
  }

  /* Style the tab content */
  .tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
  }
</style>


<section id="main" class="wrapper">
  <div class="inner">
    <!-- Content -->
    <h2 id="content">Sign Up</h2>
    <p>Please fill this form to create account</p>

    <div class="tab">
      <button class="tablinks" onclick="openTab(event, 'Hotel')" id="defaultOpen"><a href="#hotel">Hotel</button>
      <button class="tablinks" onclick="openTab(event, 'Agent')"><a href="#agent" data-toggle="tab" onclick="showAgProvinces()">Agent</a></button>
    </div>

    <div id="Hotel" class="tabcontent">
      <br>
      <form id="hotelRegForm" class="form-control" enctype="multipart/form-data" action="/regishotel" method="post">
        @csrf
        <h4>Hotel user information</h4>
        {{-- <img src="{{ Storage::disk('image')->url('image/47-94121944_2833366110050896_254106620466823168_o.jpg') }}" style="width: 100%; height: 100%;"> --}}
        <div class="row uniform">
          <div class="6u 12u$(xsmall)">
            Name
            <input type="text" class="form-control"  placeholder="Enter Name" name="name" required>
          </div>
          <div class="6u$ 12u$(xsmall)">
            Lastname
            <input type="text" class="form-control"  placeholder="Enter Lastname" name="lastname" required>
          </div>

          <div class="12u$ 12u$(xsmall)">
            Email
            <input type="text" class="form-control" placeholder="Enter Email" name="email" required pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="Invalid email address">
          </div>

          <div class="12u$ 12u$(xsmall)">
            Tel.
            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" placeholder="Enter Contact Number" name="telephone" required>
          </div>
        </div>
        <br>
        <h4>Hotel information</h4>
        <div class="row uniform">
          <div class="12u$ 12u$(xsmall)">
            Hotel Name
            <input type="text" id="hotelname" class="form-control" placeholder="Enter Hotel Name" name="hotelname" onchange="hotelAddr()" required>
          </div>
          <div class="12u$ 12u$(xsmall)">
            Hotel Email
            <input type="text" class="form-control" placeholder="Enter Hotel Email" name="hotelemail" required pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="Invalid email address">
          </div>
          <div class="12u$ 12u$(xsmall)">
            Hotel Phone Number
            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" placeholder="Enter Hotel Telephone" name="hoteltel" required>
          </div>

          <div class="12u$ 12u$(xsmall)">
            Address
            <input type="hidden" id="hoteladdress" class="form-control" name="hoteladdress" />
              {{-- <input type="text" class="form-control" placeholder="Enter Hotel Address" name="hoteladdress" required> --}}
              <div>
                <select class="form-control" id="input_province" name="province" onchange="showAmphoes()" required>
                  <option value="">กรุณาเลือกจังหวัด</option>
                </select>
              </div>
              <br>
              <div>
                <select class="form-control" id="input_amphoe" name="amphoe" onchange="showDistricts()" required>
                  <option value="">กรุณาเลือกอำเภอ</option>
                </select>
              </div>
              <br>
              <div>
                <select class="form-control" id="input_district" name="district"  required>
                  <option value="">กรุณาเลือกตำบล</option>
                </select>
              </div>
          </div>
        </div>
        
        <br>
        <div class="12u$ 12u$(xsmall)">
          Postol Code
          <input class="form-control" id="input_zipcode" name="zipcode" onchange="hotelAddr()"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Postol Code" required>
        </div>

        <br>
        <div class="12u$ 12u$(xsmall)">
          Rating
          <div class="select-wrapper">
            <select id="rate" name="rate">
              <option value="1">1 Star</option>
              <option value="2">2 Star</option>
              <option value="3">3 Star</option>
              <option value="4">4 Star</option>
              <option value="5">5 Star</option>
            </select>
          </div>
        </div>
        
        <br>
        <div class="row uniform">
          <div class="3u 12u$(xsmall)">
            Company Document
            <input type="file" id="company_doc" name="company_doc" required>
          </div>
          <div class="3u$ 12u$(xsmall)">
            THA Document:
            <input type="file" id="tha_doc" name="tha_doc" required>
          </div>
          <div class="3u$ 12u$(xsmall)">
            Sample Images
            <input type="file" id="sample_pic" name="sample_pic[]" multiple required>
          </div>
          <div class="3u$ 12u$(xsmall)">
            Profile Picture/ Logo
            <input type="file" id="profilepicH" name="profilepicH" required>
          </div>
        </div>

        <br>
        <div class="12u$">
          Nearly Attraction
          {{-- <input type="text" class="form-control"  name="attraction" required> --}}
          <input type="text" class="form-control" placeholder="Enter Nearly Attractions" id="attraction" name="attraction" data-role="tagsinput" required/>
        </div>
        
        <br>
        <h4>Account information</h4>
        <div class="row uniform">
          <div class="12u$ 12u$(xsmall)">
            Username
            <input type="text" class="form-control"  placeholder="Enter Username" name="username" pattern="\w+" required>
          </div>
          <div class="12u$ 12u$(xsmall)">
            Password
            <input type="password" class="form-control"  placeholder="Enter Password" id="password" name="psw" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="The password must contain at least 6 characters including numbers, uppercase and lowercase characters">
          </div>
          <div class="12u$ 12u$(xsmall)">
            Confirm Password
            <input type="password" class="form-control" placeholder="Repeat Password" id="confirm_password" required name="psw-repeat" >
          </div>
        </div>
        <br>
        <div class="6u$ 12u$(small)">
          <input type="checkbox" id="agreeH" name="agreeH" checked="">
          <label for="agreeH">I am agree Term & Condition</label>
        </div>

        <ul class="actions fit small">
          <li><a href="#" class="button special fit small" id="hotelReg">Submit</a></li>
          <li><a href=/ class="button fit small">Cancel</a></li>
        </ul>
      </form>
    </div>

    <div id="Agent" class="tabcontent">
      <br>
      <form id="agentRegForm" class="form-control" enctype="multipart/form-data" action="/regisagent" method="post">
        @csrf
        <h4>Agent user information</h4>
        <div class="row uniform">
          <div class="6u 12u$(xsmall)">
            Name
            <input type="text" class="form-control"  placeholder="Enter Name" name="name" required>
          </div>
          <div class="6u$ 12u$(xsmall)">
            Lastname
            <input type="text" class="form-control"  placeholder="Enter Lastname" name="lastname" required>
          </div>

          <div class="12u$ 12u$(xsmall)">
            Type
            <div class="select-wrapper">
              <select id="agenttype" name="agenttype">
                <option value="1">Travel Agent</option>
                <option value="2">Company</option>
                <option value="3">Organizer</option>
                <option value="4">Freelance</option>
              </select>
            </div>
          </div>

          <div class="12u$ 12u$(xsmall)">
            Email
            <input type="text" class="form-control" placeholder="Enter Email" name="email" required pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="Invalid email address">
          </div>

          <div class="12u$ 12u$(xsmall)">
            Tel.
            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" placeholder="Enter Contact Number" name="telephone" required>
          </div>

          <div class="12u$ 12u$(xsmall)">
            Company Name
            <input type="text" id='companyname' class="form-control" placeholder="Enter Company Name" onchange="agentAddr()" name="companyname" required>
          </div>
        
          <div class="12u$ 12u$(xsmall)">
            Address
            {{-- <input type="text" class="form-control" placeholder="Enter Address" name="companyaddress" required> --}}
              <input type="hidden" id="agentaddress" name="agentaddress">
              <div>
                <select class="form-control" id="input_province" name="province" onchange="showAmphoes()" required>
                  <option value="">กรุณาเลือกจังหวัด</option>
                </select>
              </div>
              <br>
              <div>
                <select class="form-control" id="input_amphoe" name="amphoe" onchange="showDistricts()" required>
                  <option value="">กรุณาเลือกอำเภอ</option>
                </select>
              </div>
              <br>
              <div>
                <select class="form-control" id="input_district" name="district"  required>
                  <option value="">กรุณาเลือกตำบล</option>
                </select>
              </div>
          </div>

          <div class="12u$ 12u$(xsmall)">
            Postol Code
            <input class="form-control" id="ag_zipcode" name="zipcode" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" onchange="agentAddr()" placeholder="Postol Code" required>
          </div>

          <div class="6u 12u$(xsmall)">
            Company Document
            <input type="file" id="company_doc" name="company_doc" required>
          </div>
          <div class="6u$ 12u$(xsmall)">
            Profile Picture/ Logo
            <input type="file" id="profilepicH" name="profilepicH" required>
          </div>
        </div>  


        <br>
        <h4>Account information</h4>
        <div class="row uniform">
          <div class="12u$ 12u$(xsmall)">
            Username
            <input type="text" class="form-control"  placeholder="Enter Username" name="username" required>
          </div>
          <div class="12u$ 12u$(xsmall)">
            Password
            <input type="password" class="form-control"  placeholder="Enter Password" id="passworda" name="psw" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="The password must contain at least 6 characters including numbers, uppercase and lowercase characters">
          </div>
          <div class="12u$ 12u$(xsmall)">
            Confirm Password
            <input type="password" class="form-control" placeholder="Repeat Password" id="confirm_passworda" required name="psw-repeat" >
          </div>
        </div>

          <br>
          <div class="6u$ 12u$(small)">
            <input type="checkbox" id="agreeA" name="agreeA" checked="">
            <label for="agreeA">I am agree Term & Condition</label>
          </div>
        
        <ul class="actions fit small">
          <li><a href="#" class="button special fit small" id="agentReg">Submit</a></li>
          <li><a href=/ class="button fit small">Cancel</a></li>
        </ul>
      </form>
    </div>
  </div>
</section>





<!-- Tab Script -->
<script>
  function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
  }

  // Get the element with id="defaultOpen" and click on it
  document.getElementById("defaultOpen").click();
</script>
<!--end Tab Script -->

@endsection