@extends('layout.mainlayout')
@inject('carbon', 'Illuminate\Support\Carbon')
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
<link href="{{ asset('/assets/css/bootstrap.min.css') }}" rel="stylesheet">
<script src="{{ asset('/assets/js/bootstrap.min.js') }}"></script>

<link rel="shortcut icon" href="/favicon.ico" />
<link rel="stylesheet" type="text/css" href="{{ asset('/assets-custom/css/quotation.css') }}" media="screen" />

@section('content')

<div class="container">
  <div class="row">
      <div class="col-lg-8 breadcrumbf">
          Klous dos > Quotation Preview
      </div>
  </div>
</div>

<div class="content">

    <div class="bg row">
        <h1>Quotation Review</h1>
        <p>&nbsp;Review Quotation for close forum.</p>
        <hr>
        
        <main role="main" class="container">

            <h3>Accommodation Details</h3>

                <br>
                <div class="topwrap">
                    <div class="posttext pull-left" style="padding-left: 50px">
                        <p>Topic : {{ $forumInfo->req_topic }}</p>
                        <p>Room : {{ $forumInfo->req_room }}</p>
                        <p>Rating required:
                            @for ($i = 0; $i < $forumInfo->req_rating; ++$i)
                                <i class="fa fa-star hotel-star"></i>
                            @endfor
                        </p>
                        <p>Period : {{ (new $carbon($forumInfo->req_st_date))->format('d-M-Y') . ' to ' . (new $carbon($forumInfo->req_en_date))->format('d-M-Y') }}</p>
                        <p>Location : {{ $forumInfo->req_location }}</p>
                        <p>Special Requirement : {{ $forumInfo->req_remark }}</p>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <br>

            <div id="accordion">
                <div id="content" center >
                    <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                    @if(!is_null($quotation->asset_id))
                      <li class="active"><a href="#up" data-toggle="tab">Upload FIle</a>
                      </li>
                    @else
                      <li class="active">
                        <a href="#gq" data-toggle="tab">Generate Quotation</a>
                      </li>
                    @endif
                    </ul>
                </div>
                <div id="my-tab-content" class="tab-content container">
                    <div class="tab-pane 
                    @if(is_null($quotation->asset_id))
                    active
                    @endif
                    " id="gq">
                        <form class="form-horizontal m-t-20">
                            <input type="hidden" id="quoId" value="{{ $quotation->quo_id }}" />
                            <div class="card">
                                <div class="card-body">
                                    <div class="container">
                                        <div class="form-group row">
                                            <img src="{{ asset('images/Kloud Dos - LOGO-01.jpg') }}" alt="" height="165">
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-1 text-right"><h4>เรื่อง</h4></div>
                                            <div class="col-sm-4"><h4>{{$quotation->quo_title}}</h4></div>
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-2"></div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-1 text-right"><h4>เรียน</h4></div>
                                            <div class="col-sm-4">
                                                <h4>{{$forumInfo["agent_fullname"]}}</h4>
                                                <h4>{{$forumInfo["agent_name"]}}</h4>
                                            </div>
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-2">
                                                <h4>{{$forumInfo["agent_tel"]}}</h4>
                                                <h4>{{$forumInfo["agent_email"]}}</h4>
                                                <h4>{{$forumInfo["agent_address"]}}</h4>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-1 text-right"></div>
                                            <div class="col-sm-4"></div>
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-2"></div>
                                        </div>
                                        <br>
                                        <br>
                                        <table id="myTable" class=" table order-list" style="max-width: 1130px;margin-left: 20px;">
                                            <thead>
                                                <tr style="background-color: #F2612A;color: snow">
                                                    <td>Room Type</td>
                                                    <td>Number Of Rooms</td>
                                                    <td>Price/Room</td>
                                                    <td>Remark</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($quotationDetail as $row)
                                                <tr>
                                                    <td class="col-sm-4 col-md-4 col-lg-4">
                                                        {{$row->room_type}}
                                                    </td>
                                                    <td class="col-sm-2 col-md-2 col-lg-2" style="background-color:#e8eaea;">
                                                        {{$row->amount}}
                                                    </td>
                                                    <td class="col-sm-2 col-md-2 col-lg-2">
                                                        {{$row->price_per_one}}
                                                    </td>
                                                    <td class="col-sm-2 col-md-2 col-lg-2" style="background-color:#e8eaea;">
                                                        {{$row->remark}}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr style="background-color: #F2612A;color: snow">
                                                    <td colspan="12" class="col-sm-12 col-md-12 col-lg-12">
                                                        จำนวนเป็นภาษาไทย
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="col-sm-4 col-md-4 col-lg-4">
                                                    </td>
                                                    <td class="col-sm-2 col-md-2 col-lg-2">
                                                    </td>
                                                    <td class="col-sm-2 col-md-2 col-lg-2" style="background-color:#003580;color: snow">
                                                        TOTAL
                                                    </td>
                                                    <td class="col-sm-2 col-md-2 col-lg-2" style="background-color:#003580;color: snow">
                                                        {{$quotation->quo_total}}
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <div class="form-group row">
                                            <div class="col-sm-2 text-right"><h4>หมายเหตุ</h4></div>
                                            <div class="col-sm-8"><h4>{{$quotation->quo_remark}}</h4></div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-8 text-right"></div>
                                            <div class="col-sm-2 text-center">{{$hotelInfo["hotel_name"]}}</div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-8 text-right"></div>
                                            <div class="col-sm-2" style="margin-top: -20px;margin-bottom: -30px;"><hr /></div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-8 text-right"></div>
                                            <div class="col-sm-2 text-center">({{$hotelInfo["hotel_fullname"]}})</div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4 text-right"></div>
                                            <div class="col-sm-4  text-center">
                                                <div class="star-rating">
                                                    Vote To Hotel :
                                                    <span class="fa fa-star-o" data-rating="1"></span>
                                                    <span class="fa fa-star-o" data-rating="2"></span>
                                                    <span class="fa fa-star-o" data-rating="3"></span>
                                                    <span class="fa fa-star-o" data-rating="4"></span>
                                                    <span class="fa fa-star-o" data-rating="5"></span>
                                                    <input type="hidden" name="voteScore" class="rating-value" value="0">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 text-right"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane 
                    @if(!is_null($quotation->asset_id))
                    active
                    @endif
                    " id="up">
                    <br>
                        <form class="form-horizontal m-t-20" >
                            <input type="hidden" name="reqId" value="{{ $forumInfo->req_id }}" />
                            <input type="hidden" name="dealWith" value="{{ $hotelInfo->account_id }}" />
                            <div class="form-group">
                                <div class="col-sm-6">
                                  <label for="company_doc">Quotation File:</label>
                                    <button type="button" class="btn btn-primary btn-block" style="width: 16%;" onclick="showModal({{$quotation->asset_id}})" >View</button>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4 text-right"></div>
                                <div class="col-sm-4  text-center">
                                    <div class="star-rating">
                                        Vote To Hotel :
                                        <span class="fa fa-star-o" data-rating="1"></span>
                                        <span class="fa fa-star-o" data-rating="2"></span>
                                        <span class="fa fa-star-o" data-rating="3"></span>
                                        <span class="fa fa-star-o" data-rating="4"></span>
                                        <span class="fa fa-star-o" data-rating="5"></span>
                                        <input type="hidden" name="voteScore" class="rating-value" value="0">
                                    </div>
                                </div>
                                <div class="col-sm-4 text-right"></div>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- <div class="card">
                    <a data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <h3 style="color: RGB(153, 156, 158)" >Generate Quotation</h3>
                    </a>

                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">
                            <p> &nbsp; Please fill the form below</p>
                            <div class="container">
                                <table id="myTable" class=" table order-list">
                                    <thead>
                                        <tr>
                                            <td>Room Type</td>
                                            <td>Amounts</td>
                                            <td>Price/Room</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="col-sm-6">
                                                <input type="text" name="roomType" class="form-control" />
                                            </td>
                                            <td class="col-sm-2">
                                                <input type="mail" name="amounts"  class="form-control"/>
                                            </td>
                                            <td class="col-sm-2">
                                                <input type="text" name="price"  class="form-control"/>
                                            </td>
                                            <td class="col-sm-2"><a class="deleteRow"></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" style="text-align: left;">
                                                <input type="button" class="btn btn-custom btn-block " id="addrow" value="Add" />
                                            </td>
                                        </tr>
                                        <tr>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <a data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <h3 style="color: RGB(153, 156, 158)" >Or Upload File</h3>
                    </a>

                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body">
                            <input type="file" id="quo_doc" name="quo_doc">
                        </div>
                    </div>
                </div> --}}
            </div>

<!--             <h3>Or Upload file</h3>
            <input type="file" id="quo_doc" name="quo_doc"> -->

            <div class="row" align="center">
                <button class="btn btn-primary btn-bordred waves-effect waves-light" style="width: 45%;" id="confirmQuotation" >Choose this Hotel and Close Forum</button>
            </div>
            <br>

            <br>
            <p></p>

        </main>
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
</div>

@endsection

<!-- Custom Script -->
<script src="{{ asset('/assets-custom/js/quotation-preview.js') }}"></script>
<script src="{{ asset('/assets-custom/js/rating.js') }}"></script>

