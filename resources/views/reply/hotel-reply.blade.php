@extends('layout.mainlayout')
@inject('carbon', 'Illuminate\Support\Carbon')

@section('content')

    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 breadcrumbf">
                    <a href="/landing">Home</a> > Reply Forum
                </div>
            </div>
        </div>


        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-8">

                    <!-- POST -->
                    <div class="post">
                        <div class="topwrap">
                            <div class="posttext pull-left" style="padding-left: 50px">
                                <input type="hidden" id="reqId" value="{{ $forum->req_id }}" />
                                <h2>{{ $forum->req_topic }}</h2>
                                <p><b>Room</b> : {{ $forum->req_room }}</p>
                                <p><b>Rating</b> required :
                                    @for ($i = 0; $i < $forum->req_rating; ++$i)
                                        <i class="fa fa-star hotel-star"></i>
                                    @endfor
                                </p>
                                <p><b>Period</b> : {{ (new $carbon($forum->req_st_date))->format('d-M-Y') . ' to ' . (new $carbon($forum->req_en_date))->format('d-M-Y') }}</p>
                                <p><b>Budget</b> : {{$forum->req_budget}}</p>
                                <p><b>Location</b> : {{ $forum->req_location }}</p>
                                <p><b>Special Requirement</b> : {{ $forum->req_remark }}</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="postinfobot">

                            <div class="posted pull-left">
                                <i class="fa fa-user-secret"></i><a href="{{'/profile/'.$forum->created_by}}">{{ $forum->creator_fullname }}</a>
                                <i class="fa fa-clock-o" style="margin-left: 20px"></i> Posted on : {{ (new $carbon($forum->created_date))->format('d M @ G:ia ') }}
                            </div>

                            <div class="next pull-right">
                                <!-- <a href="#"><i class="fa fa-pencil"></i></a> -->

                                <a href="javascript:showModal();"><i class="fa fa-flag"></i></a>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </div><!-- POST -->

                    <div class="row similarposts">
                        <div class="col-lg-10"><i class="fa fa-info-circle"></i> <p>Replies topic</p></div>
{{--                        <div class="col-lg-2 loading"><i class="fa fa-refresh"></i></div>--}}
                    </div>

                    <div class="postreply-container">
                        @include('reply.hotel-reply-block')
                    </div>



                    <!-- POST -->
                    <div class="post">

                        <form action="#" class="form" method="post">
                            @if(
                                ("1"==$forum->is_rating_required && $forum->req_rating == session("hotel")->hotel_rate)
                                || ("1"!=$forum->is_rating_required))
                                <div class="topwrap">
                                    <div class="userinfo pull-left">
                                        <div class="avatar">
                                        </div>
                                    </div>
                                    <div class="posttext pull-left">
                                        <div class="textwraper" style="margin-top: 7px; margin-bottom: 7px">
                                            <div class="postreply">Post a Reply</div>
                                            <textarea name="replyText" id="replyText" placeholder="Type your message here"></textarea>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="postinfobot">
                                        <div class="pull-right postreply">
                                            @if("1"==$forum->is_allow_quot)
                                            <div class="pull-left" style="margin-right: 10px">
                                                <button type="button" id="sendQuotation" class="btn btn-success">Send Quotation</button>
                                            </div>
                                            @endif
                                            <div class="pull-left">
                                                <button type="button" id="replyButton" class="btn btn-primary">Post Reply</button>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>

                                    <div class="clearfix"></div>
                                </div>
                            @else
                                <div class="postinfobot" style="text-align: center">
                                    ไม่สามารถตอบกลับได้เนื่องจากเจ้าของโพสอนุญาตให้เฉพาะโรงแรมตามดาวที่กำหนดเท่านั้น
                                </div>
                            @endif

                        </form>

                    </div><!-- POST -->


                </div>
            </div>
        </div>
        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">Report {{$forum->req_topic}}</h4>
                </div>
                <div class="modal-body">
                    {{-- <label for="msg"><b>message</b></label> --}}
                    <input type="text" class="form-control" placeholder="report message" id="msg" name="msg">
                    <input type="hidden" name="reqId" id="reqId" value="{{ $forum->req_id }}">
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn btn-primary" onclick="report()" data-dismiss="modal">Report</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

            </div>
        </div>
    </section>
    <script src="../../assets-custom/js/hotel-reply.js"></script>
@endsection