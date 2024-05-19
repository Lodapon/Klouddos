@extends('layout.adminlayout')
@inject('carbon', 'Illuminate\Support\Carbon')
@section('content')
<main role="main" class="container">

    <div class="wrapper">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Forum Report</h1>
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
                                            <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Recently Reviews</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false">Archieve</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-three-tabContent">
                                        <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                            <div class="card">
                                                <form id="reportform" method="POST">
                                                    @csrf
                                                    <div class="card-header">
                                                        <h3 class="card-title">Forums</h3>
                                                        <div class="card-tools">
                                                            <!-- <div class="input-group input-group-sm" style="width: 150px;">
                                                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                                                <div class="input-group-append">
                                                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                                                </div>
                                                            </div> -->
                                                        </div>
                                                    </div>
                                                    <div class="card-body table-responsive p-0">
                                                        <table class="table table-hover text-nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th></th>
                                                                    <th>ID</th>
                                                                    <th>Topic</th>
                                                                    <th>Report Msg</th>
                                                                    <th>Created by</th>
                                                                    <th>Role</th>
                                                                    <th>Date Created</th>
                                                                    <th>Reported by</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($reports as $report)
                                                                @if($report->status=='R')
                                                                <tr>
                                                                    <td style="text-align:center;">
                                                                        <div class="form-check">
                                                                        <input type="checkbox" class="form-check-input" name="rep[]" value="{{$report->report_id}}|{{$report->req_id}}" id="exampleCheck1">
                                                                        </div>
                                                                    </td>
                                                                    <td>{{$report->report_id}}</td>
                                                                    <td>{{$report->req_topic}}</td>
                                                                    <td>{{$report->report_msg}}</td>
                                                                    <td>{{$report->username}}</td>
                                                                    @if ($report->role == 'H')
                                                                    <td>Hotel</td>
                                                                    @else
                                                                    <td>Agent</td>
                                                                    @endif
                                                                    <td>{{(new $carbon($report->created_date))->format('d-M-Y')}}</td>
                                                                    <td>{{$report->user_rp}}</td>
                                                                </tr>
                                                                @endif
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="card-footer">
                                                        <button type="button" onclick="dismissrp()" class="btn btn-default">Dismiss</button>
                                                        <button type="button" onclick="deleterp()" class="btn btn-danger"> Delete </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Forums</h3>
                                                    <div class="card-tools">
                                                    </div>
                                                </div>
                                                <div class="card-body table-responsive p-0">
                                                    <table class="table table-hover text-nowrap">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Topic</th>
                                                                <th>Created by</th>
                                                                <th>Role</th>
                                                                <th>Date Created</th>
                                                                <th>Reported by</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($reports as $report)
                                                                @if($report->status!='R')
                                                                <tr>
                                                                    <td>{{$report->report_id}}</td>
                                                                    <td>{{$report->req_topic}}</td>
                                                                    <td>{{$report->username}}</td>
                                                                    @if ($report->role == 'H')
                                                                    <td>Hotel</td>
                                                                    @else
                                                                    <td>Agent</td>
                                                                    @endif
                                                                    <td>{{(new $carbon($report->created_date))->format('d-M-Y')}}</td>
                                                                    <td>{{$report->user_rp}}</td>
                                                                    @if ($report->status == 'D')
                                                                    <td><p class="text-danger">Deleted</p></td>
                                                                    @else
                                                                    <td><p class="text-muted">Dismiss<p></td>
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
                                                        <h3 class="card-title">Forums</h3>
                                                        <div class="card-tools">
                                                            <!-- <div class="input-group input-group-sm" style="width: 150px;">
                                                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                                                <div class="input-group-append">
                                                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                                                </div>
                                                            </div> -->
                                                        </div>
                                                    </div>
                                                    <div class="card-body table-responsive p-0">
                                                        <table class="table table-hover text-nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th>ID</th>
                                                                    <th>Topic</th>
                                                                    <th>Created by</th>
                                                                    <th>Role</th>
                                                                    <th>Date Created</th>
                                                                    <th>Date Archieved</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($reports as $report)
                                                                @if($report->status =='D')
                                                                <tr>
                                                                    <td>{{$report->report_id}}</td>
                                                                    <td>{{$report->req_topic}}</td>
                                                                    <td>{{$report->username}}</td>
                                                                    @if ($report->role == 'H')
                                                                    <td>Hotel</td>
                                                                    @else
                                                                    <td>Agent</td>
                                                                    @endif
                                                                    <td>{{(new $carbon($report->created_date))->format('d-M-Y')}}</td>
                                                                    <td>{{(new $carbon($report->updated_date))->format('d-M-Y')}}</td>
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

</main>
@endsection


