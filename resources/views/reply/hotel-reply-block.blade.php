@inject('carbon', 'Illuminate\Support\Carbon')
@if(@isset($replies))
@foreach($replies as $reply)

    @if($reply->role == "A")
    <div class="post" style="margin-right: 200px">
    @elseif($reply->role == "H")
    <div class="post" style="margin-left: 200px">
    @else
    <div class="post">
    @endif

        <div class="topwrap">
            <div class="posttext pull-left" style="padding-left: 50px">
                <p>{{ $reply -> rep_msg }}</p>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="postinfobot">

            <div class="posted pull-left">

                @if($reply->role == "A")
                <i class="fa fa-user-secret"></i>
                @elseif($reply->role == "H")
                <i class="fa fa-home"></i>
                @endif
                <a href="{{'/profile/'.$reply->rep_by}}">{{ $reply->replier_fullname }}</a>
                <i class="fa fa-clock-o" style="margin-left: 20px"></i> {{ (new $carbon($reply->created_date))->format('d M @ G:ia ') }}
            </div>

            <div class="next pull-right">
                <a href="javascript:showModal({{$reply->rep_id}});" class="down"><i class="fa fa-flag"></i></a>
            </div>

            <div class="clearfix"></div>
        </div>
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