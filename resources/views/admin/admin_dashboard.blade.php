@extends('layout.adminlayout')
@inject('carbon', 'Illuminate\Support\Carbon')
@section('content')
<main role="main" class="container">

    <!-- <div class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed"> -->
    <div class="wrapper">
        <!-- nav here -->

        <div class="content-wrapper"> <!-- This class make content so tight -->

                <!-- Content Header (Page header) -->
                <div class="content-header">
                  <div class="container-fluid">
                    <div class="row mb-2">
                      <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Dashboard</h1>
                      </div><!-- /.col -->
                    </div><!-- /.row -->
                  </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <!-- Info boxes -->
                        <div class="row">
                          <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-comments"></i></span>

                              <div class="info-box-content">
                                <span class="info-box-text">Active Forums</span>
                                <span class="info-box-number">{{$dashboard['activeForum']}}</span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                          </div>
                          <!-- /.col -->
                          <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-check"></i></span>

                              <div class="info-box-content">
                                <span class="info-box-text">Archieves</span>
                                <span class="info-box-number">{{$dashboard['archieves']}}</span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                          </div>
                          <!-- /.col -->

                          <!-- fix for small devices only -->
                          <div class="clearfix hidden-md-up"></div>

                          <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                              <div class="info-box-content">
                                <span class="info-box-text">Sales</span>
                                <span class="info-box-number">{{$dashboard['sales']}}</span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                          </div>
                          <!-- /.col -->
                          <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                              <div class="info-box-content">
                                <span class="info-box-text">Users</span>
                                <span class="info-box-number">{{$dashboard['member']}}</span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <div class="col-md-12">
                                {{-- <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Monthly Recap Report</h5>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="text-center">
                                                        <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                                                    </p>
                                                    <div class="chart">
                                                        <!-- Sales Chart Canvas -->
                                                        <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="row">
                                                <div class="col-sm-4 col-6">
                                                    <div class="description-block border-right">
                                                        <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 2</span>
                                                        <h5 class="description-header">32</h5>
                                                        <span class="description-text">ROOMS SALE</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 col-6">
                                                    <div class="description-block border-right">
                                                        <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 8</span>
                                                        <h5 class="description-header">3</h5>
                                                        <span class="description-text">COMPLETE ORDER</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 col-6">
                                                    <div class="description-block border-right">
                                                        <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 20%</span>
                                                        <h5 class="description-header">$24,813.53</h5>
                                                        <span class="description-text">TOTAL PROFIT</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Latest Members</h3>
                                        <div class="card-tools">
                                          <span class="badge badge-danger">{{$dashboard['newMember']}} New Members</span>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <ul class="users-list clearfix">
                                            @foreach ($profile as $user)
                                            <li>
                                                <img src="{{'../storage/'.$user->asset_url}}" style="width: 128px;height: 128px;border: solid 1px #dee1e3;" onerror="this.src='/assets-admin/images/KD_logo.png'" alt="User Image">
                                                <a class="users-list-name" href="{{'/profile/'.$user->account_id}}"">{{$user->first_name}} {{$user->last_name}}</a>
                                                <span class="users-list-date">{{(new $carbon($user->created_date))->format('d-M-Y')}}</span>
                                            </li>
                                            @endforeach
                                        </ul>
                                        <!-- /.users-list -->
                                    </div>
                                   
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header border-transparent">
                                        <h3 class="card-title">Latest Orders</h3>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table m-0">
                                                <thead>
                                                <tr>
                                                    <th>Order ID</th>
                                                    <th>Agent</th>
                                                    <th>Nearly Attraction</th>
                                                    <th>Hotel</th>
                                                    <th>Budget</th>
                                                </tr>
                                                </thead>
                                            <tbody>
                                                @foreach ($orders as $order)
                                                <tr>
                                                    <td><a href="/quotation/preview?id={{$order->quo_id}}">{{$order->quo_id}}</a></td>
                                                    <td>{{$order->agent_name}}</td>
                                                    <td>{{$order->hotel_location}}</td>
                                                    <td>{{$order->hotel_name}}</td>
                                                    <td>{{$order->quo_total}}</td>
                                                </tr>
                                                @endforeach
                                                {{-- <tr>
                                                    <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                                    <td>Krabi</td>
                                                    <td>Novotel</td>
                                                    <td>2</td>
                                                </tr>
                                                <tr>
                                                    <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                                    <td>Chiangmai</td>
                                                    <td>Holidai Inn</td>
                                                    <td>8</td>
                                                </tr>
                                                <tr>
                                                    <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                                    <td>Bangkok</td>
                                                    <td>Novotel</td>
                                                    <td>14</td>
                                                </tr>
                                                <tr>
                                                    <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                                    <td>Karnchanaburi</td>
                                                    <td>Karnchanaburi Lodge</td>
                                                    <td>4</td>
                                                </tr>
                                                <tr>
                                                    <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                                    <td>Bangkok</td>
                                                    <td>Shang Gri La</td>
                                                    <td>7</td>
                                                </tr>
                                                <tr>
                                                    <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                                    <td>Chonburi</td>
                                                    <td>Holiday Inn</td>
                                                    <td>19</td>
                                                </tr> --}}
                                            </tbody>
                                          </table>
                                        </div>
                                        <!-- /.table-responsive -->
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
