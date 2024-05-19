@extends('layout.mainlayout')
@inject('carbon', 'Illuminate\Support\Carbon')
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
<link href="{{ asset('/assets/css/bootstrap.min.css') }}" rel="stylesheet">
<script src="{{ asset('/assets/js/bootstrap.min.js') }}"></script>

<link rel="stylesheet" type="text/css" href="{{ asset('/assets-custom/css/quotation.css') }}" media="screen" />

@section('content')

<div class="container">
  <div class="row">
      <div class="col-lg-8 breadcrumbf">
          Klous dos > Quotation
      </div>
  </div>
</div>

<div class="content">

    <div class="bg row">
        <h1>Quotation</h1>
        <p>&nbsp;Generate Quotation via Klouddos.com or Upload your own.</p>
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
                      <li class="active"><a href="#up" data-toggle="tab">Upload FIle</a>
                      </li>
                      <li><a href="#gq" data-toggle="tab">Online Quotation</a>
                      </li>
                    </ul>
                </div>
                <div id="my-tab-content" class="tab-content container">
                    <div class="tab-pane" id="gq">
                        <form id="gqForm" class="form-horizontal m-t-20"  action="/quotation" method="post">
                            @csrf
                            <input type="hidden" name="reqId" value="{{ $forumInfo->req_id }}" />
                            <input type="hidden" name="dealWith" value="{{ $hotelInfo->account_id }}" />
                            <div class="card">
                                <div class="card-body">
                                    <div class="container">
                                        <div class="form-group row">
                                            <img src="{{ asset('images/Kloud Dos - LOGO-01.jpg') }}" alt="" height="165">
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-1 text-right"><h4>เรื่อง</h4></div>
                                            <div class="col-sm-4"><input type="text" name="quotTopic" id="quotTopic" class="form-control" value="{{$forumInfo["req_topic"]}}" /></div>
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
                                                    <td>
                                                        <input type="button" class="btn btn-custom btn-block " style="color: black" id="addrow" value="Add" />
                                                    </td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="col-sm-4 col-md-4 col-lg-4">
                                                        <input type="text" name="roomType0" class="form-control" required/>
                                                    </td>
                                                    <td class="col-sm-2 col-md-2 col-lg-2" style="background-color:#e8eaea;">
                                                        <input type="number" name="amount0" style="background-color:#e8eaea;" class="form-control form-amount" required/>
                                                    </td>
                                                    <td class="col-sm-2 col-md-2 col-lg-2">
                                                        <input type="number" name="price0"  class="form-control form-price" required/>
                                                    </td>
                                                    <td class="col-sm-2 col-md-2 col-lg-2" style="background-color:#e8eaea;">
                                                        <input type="text" name="remark0" style="background-color:#e8eaea;" class="form-control" required/>
                                                    </td>
                                                    <td class="col-sm-2 col-md-2 col-lg-2"><a class="deleteRow"></a>
                                                    </td>
                                                </tr>
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
                                                        <input type="text" id="total" name="total" disabled="disabled"  style="background-color:#003580;color: snow" class="form-control"/>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <div class="form-group row">
                                            <div class="col-sm-2 text-right"><h4>หมายเหตุ</h4></div>
                                            <div class="col-sm-8 text-right">
                                                <textarea name="quotRemark" id="quotRemark" class="form-control"></textarea>
                                                <span id="remarkCounter">0</span>/3000
                                            </div>
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
                                                    Vote To Agent :
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
                        <div class="row" align="center">
                            <button class="btn btn-primary btn-bordred waves-effect waves-light" style="width: 45%;" id="submitQuotation" >Submit</button>
                        </div>
                    </div>
                    <div class="tab-pane active" id="up">
                    <br>
                        <form id="upForm" class="form-horizontal m-t-20" enctype="multipart/form-data" action="/quotation" method="post">
                            @csrf
                            <input type="hidden" name="reqId" value="{{ $forumInfo->req_id }}" />
                            <input type="hidden" name="dealWith" value="{{ $hotelInfo->account_id }}" />
                            <div class="form-group">
                                <div class="col-sm-6">
                                  <label for="company_doc">Quotation File:</label>
                                  <input type="file" class="form-control" id="quo_doc" name="quo_doc" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4 text-right"></div>
                                <div class="col-sm-4  text-center">
                                    <div class="star-rating">
                                        Vote To Agent :
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
                        <div class="row" align="center">
                            <button class="btn btn-primary btn-bordred waves-effect waves-light" style="width: 45%;"  id="submitQuotationFile">Submit File</button>
                        </div>
                    </div>
                </div>
                {{-- <div class="card">
                    <a data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <h3 style="color: RGB(153, 156, 158)" >Online Quotation</h3>
                    </a>

                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">
                            <p> &nbsp; Please fill the form below</p>
                            <div class="container">
                                <table id="myTable" class=" table order-list">
                                    <thead>
                                        <tr>
                                            <td>Room Type</td>
                                            <td>Number of Rooms</td>
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

            <br>

            <br>
            <p></p>

        </main>
    </div>

</div>

@endsection

<!-- Custom Script -->
<script src="{{ asset('/assets-custom/js/quotation.js') }}"></script>
<script src="{{ asset('/assets-custom/js/rating.js') }}"></script>
