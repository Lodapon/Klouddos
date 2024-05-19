@inject('carbon', 'Illuminate\Support\Carbon')
@if(@isset($nestedReplies))
@foreach($nestedReplies as $replies)
    <div class="post" style="padding-top: 20px;">

            @foreach($replies as $reply)
            <div class="topwrap">
                @if($reply->role == "H")
                <div class="posttext pull-left" style="padding-left: 50px">
                            <blockquote>
                                <span class="original">{{ (new $carbon($reply->created_date))->format('d M @ G:ia ') }}</span>
                                {{ $reply -> rep_msg }}
                            </blockquote>

{{--                            <p>{{ $reply -> rep_msg }}</p>--}}
                    </div>
                @else
                <div class="posttext pull-right" style="padding-left: 50px">
                        <blockquote>
                            <span class="original">{{ (new $carbon($reply->created_date))->format('d M @ G:ia ') }}</span>
                            {{ $reply -> rep_msg }}
                        </blockquote>
                </div>
                @endif


                    <div class="clearfix"></div>
                </div>

            @endforeach
        <div class="postinfobot">
            @if(@isset($replies))
            <div class="posted pull-left">
               
                <span style="padding-right: 8px"> Conversation with </span>
                <i class="fa fa-home"></i>
                <a href="{{'/profile/'.$replies[0]->rep_by}}">{{ $replies[0]->replier_fullname }}</a>
                <input id="replier{{$reply -> root_rep_by}}" type="hidden" value="{{ $replies[0]->replier_fullname }}">
                
{{--                <i class="fa fa-clock-o" style="margin-left: 20px"></i> Replied on : {{ (new $carbon($reply->created_date))->format('d M @ G:ia ') }}--}}
            </div>

            <div class="next pull-right">
                <a href="javascript:showModal({{$reply->rep_id}});" class="down"><i class="fa fa-flag"></i></a>
            </div>
            @endif
            <div class="clearfix"></div>
        </div>


        <!-- POST -->
        <div class="post">
            <form action="#" class="form" method="post">
                <div class="topwrap">
                    <div class="userinfo pull-left">
                        <div class="avatar">
                        </div>
                    </div>
                    <div class="posttext pull-left">
                        <div class="textwraper">
                            <div class="postreply">Post a Reply</div>
                            <textarea name="replyText" id="replyText{{ $reply -> root_rep_by }}" placeholder="Type your message here"></textarea>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="postinfobot">

                    <div class="pull-right postreply">
                        <div class="pull-left">
                            <button type="button" id="dealButton{{ $reply -> root_rep_by }}" class="btn btn-danger" onclick="deal({{ $reply -> root_rep_by }})">Request Quotation</button>&nbsp;
                        </div>
                        <div class="pull-left ml-3">
                            <button type="button" id="replyButton{{ $reply -> root_rep_by }}" class="btn btn-primary" onclick="reply({{ $reply -> root_rep_by }})">Post Reply</button>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </form>
        </div><!-- POST -->


    </div><!-- POST -->
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
    
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Report</h4>
            </div>
            <div class="modal-body">
                {{-- <label for="msg"><b>message</b></label> --}}
                <input type="text" class="form-control" placeholder="report message" id="msg" name="msg">
                <input type="hidden"  id="repId" name="repId">
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn btn-primary" onclick="report()" data-dismiss="modal">Report</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    
        </div>
    </div>
@endforeach
@endif