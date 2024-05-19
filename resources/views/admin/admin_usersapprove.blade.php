@extends('layout.adminlayout')
@inject('carbon', 'Illuminate\Support\Carbon')
@section('content')
<script>
    function finduser(id) {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput"+id);
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable"+id);
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            if(id==1){
                td = tr[i].getElementsByTagName("td")[2];
            }else{
                td = tr[i].getElementsByTagName("td")[1];
            }
          if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = "";
            } else {
              tr[i].style.display = "none";
            }
          }       
        }
      }
</script>
<main role="main" class="container">

    <div class="wrapper">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h1 class="m-0 text-dark">User Approve</h1>
                  </div><!-- /.col -->
                </div><!-- /.row -->
              </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary card-outline card-tabs">
                                <div class="card-header p-0 pt-1 border-bottom-0">
                                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Pending</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Approve</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false">Reject</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-three-tabContent">
                                        <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                            <div class="card">
                                                <form id="userAppr" method="POST">
                                                    @csrf
                                                    <div class="card-header">
                                                        <h3 class="card-title">Pending Approval</h3>
                                                        <div class="card-tools">
                                                            {{-- <form class="form-inline"> --}}
                                                                <input type="text" id="myInput1" class="form-control" onkeyup="finduser(1)" placeholder="Search for User.." title="Type in a name">
                                                            {{-- </form> --}}
                                                        </div>
                                                    </div>
                                                    <div class="card-body table-responsive p-0">
                                                        <table class="table table-hover text-nowrap" id="myTable1">
                                                            <thead>
                                                                <tr>
                                                                    <th></th>
                                                                    <th>ID</th>
                                                                    <th>User</th>
                                                                    <th>Date</th>
                                                                    <th>Role</th>
                                                                    <th>Name</th>
                                                                    <th>Address</th>
                                                                    <th>Location</th>
                                                                    <th>Email</th>
                                                                    <th>Tel</th>
                                                                    <th>Reason</th>
                                                                    <th>View Doc</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($users as $user)
                                                                @if($user->status=='I')
                                                                <tr>
                                                                    <td style="text-align:center;">
                                                                        <div class="form-check">
                                                                            <input type="checkbox" class="form-check-input" name="appruser[]" value="{{$user->account_id}}">
                                                                        </div>
                                                                    </td>
                                                                    <td>{{$user->account_id}}</td>
                                                                    <td>{{$user->username}}</td>
                                                                    <td>{{(new $carbon($user->created_date))->format('d-M-Y')}}</td>
                                                                    @if ($user->role == 'H')
                                                                        <td><span class="tag tag-success">Hotel</span></td>
                                                                        <td>{{$user->first_name}} {{$user->last_name}}</td>
                                                                        <td>{{$user->hotel_address}}</td>
                                                                        <td>{{$user->hotel_location}}</td>
                                                                        <td>{{$user->hotel_email}}</td>
                                                                        <td>{{$user->hotel_tel}}</td>
                                                                    @else
                                                                        <td><span class="tag tag-danger">Agent</span></td>
                                                                        <td>{{$user->first_name}} {{$user->last_name}}</td>
                                                                        <td>{{$user->agent_address}}</td>
                                                                        <td></td>
                                                                        <td>{{$user->agent_email}}</td>
                                                                        <td>{{$user->agent_tel}}</td>
                                                                    @endif
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control form-control-sm" name="apprreason[]" placeholder="Enter ..." disabled id="reason">
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        {{-- <i class="fa fa-pencil-square-o" data-toggle="modal" data-target="#myModal" data-id="{{$user->account_id}}" aria-hidden="true"></i> --}}
                                                                        <i class="fa fa-pencil-square-o" onclick="showModal({{$user->account_id}})"></i> 
                                                                    </td>
                                                                </tr>
                                                                @endif
                                                                @endforeach
                                                        </table>
                                                    </div>
                                                    <div class="card-footer">
                                                        <button type="button" onclick="approve()" class="btn btn-success">Approve</button>
                                                        <button type="button" onclick="reject()" class="btn btn-danger"> Reject </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Recently Approve</h3>
                                                    <div class="card-tools">
                                                        <form class="form-inline">
                                                            {{-- <i class="fas fa-search" aria-hidden="true"></i> --}}
                                                            &nbsp;&nbsp;&nbsp;<input type="text" id="myInput2" class="form-control" onkeyup="finduser(2)" placeholder="Search for User.." title="Type in a name">
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="card-body table-responsive p-0">
                                                    <table class="table table-hover text-nowrap" id="myTable2">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>User</th>
                                                                <th>Date</th>
                                                                <th>Role</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($users as $user)
                                                            @if($user->status=='A')
                                                            <tr>
                                                                <td><a class="users-list-name" href="{{'/profile/'.$user->account_id}}"">{{$user->account_id}}</a></td>
                                                                <td>{{$user->username}}</td>
                                                                <td>{{(new $carbon($user->created_date))->format('d-M-Y')}}</td>
                                                                @if ($user->role == 'H')
                                                                    <td><span class="tag tag-success">Hotel</span></td>
                                                                @else
                                                                    <td><span class="tag tag-danger">Agent</span></td>
                                                                @endif
                                                            </tr>
                                                            @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
                                            <div class="card">
                                                <form action="/action_page.php">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Recently Reject</h3>
                                                        <div class="card-tools">
                                                        </div>
                                                    </div>
                                                    <div class="card-body table-responsive p-0">
                                                        <table class="table table-hover text-nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th>ID</th>
                                                                    <th>User</th>
                                                                    <th>Date</th>
                                                                    <th>Role</th>
                                                                    <th>Reason</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($users as $user)
                                                            @if($user->status=='R')
                                                            <tr>
                                                                <td>{{$user->account_id}}</td>
                                                                <td>{{$user->username}}</td>
                                                                <td>{{(new $carbon($user->created_date))->format('d-M-Y')}}</td>
                                                                @if ($user->role == 'H')
                                                                    <td><span class="tag tag-success">Hotel</span></td>
                                                                @else
                                                                    <td><span class="tag tag-danger">Agent</span></td>
                                                                @endif
                                                                <td>{{$user->reason}}</td>
                                                            </tr>
                                                            @endif
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
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
            <p  id="textlogo">Profile Picture/Logo</p>
            <div id="modallogo"><p>Some text in the modal.</p></div>
            <p  id="textimgs">Sample Image</p>
          <div id="modalbody"><p>Some text in the modal.</p></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
  
    </div>
  </div>
</main>

@endsection


