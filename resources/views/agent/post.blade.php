@extends('layout.mainlayout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 breadcrumbf">
                <a href="/landing">Home</a> > Create Forum
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
                <div class="col-lg-12 col-md-12">



                <!-- POST -->
                <div class="post">
                    <form action="post/submit" id="formPostForum" class="form newtopic" method="post">
                        @csrf
                        <div class="postinfobot">
                            <div class="posttext pull-left">

                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Topic" id="topic" name="topic" style="margin-top: 20px;" class="form-control" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="roomAmount">จำนวนห้อง</label>
                                        <input type="number" placeholder="0" id="roomAmount" name="roomAmount" class="form-control" />

                                    </div>
                                    <div class="col-md-6">
                                        <label for="hotelRating">Hotel Rating Required</label>
                                        <div class="star-rating">
                                            <span class="fa fa-star-o" data-rating="1"></span>
                                            <span class="fa fa-star-o" data-rating="2"></span>
                                            <span class="fa fa-star-o" data-rating="3"></span>
                                            <span class="fa fa-star-o" data-rating="4"></span>
                                            <span class="fa fa-star-o" data-rating="5"></span>
                                            <input type="hidden" name="hotelRating" class="rating-value" value="0">
                                            <br>
                                            <input type="checkbox" id="ratingRequired" name="ratingRequired" value="1"/>
                                            <label for="ratingRequired"> อนุญาตเฉพาะโรงแรมตามดาวที่กำหนดส่งใบเสนอราคา </label><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="checkInDate">Check-in</label>
                                        <input type="date" class="form-control" id="checkInDate" name="checkInDate" placeholder="01/01/2020"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="checkOutDate">Check-out</label>
                                        <input type="date" class="form-control" id="checkOutDate" name="checkOutDate" placeholder="01/01/2020"/>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="budget">งบประมาณรวม</label>
                                        <input type="text" class="form-control" id="budget" name="budget" placeholder="about 50k">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="attraction">สถานที่ท่องเที่ยวโดยรอบ/บริเวณใกล้เคียง</label>
                                        <input type="text" class="form-control" id="attraction" name="attraction" data-role="tagsinput"/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="facilities">สิ่งอำนวยความสะดวก</label>
                                        <textarea name="facilities" id="facilities" placeholder="Computer, studio, or floor"  class="form-control" ></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="checkbox" id="isPublic" name="isPublic" value="1"/>
                                        <label for="isPublic"> อนุญาตให้ Agent ท่านอื่นเห็นกระทู้นี้ </label><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="checkbox" id="allowQuot" name="allowQuot" value="1"/>
                                        <label for="allowQuot"> อนุญาตให้โรงแรมอัพโหลดใบเสนอราคาในช่อง reply โดยตรง </label><br>
                                    </div>
                                </div>

                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="postinfobot">

                            <div class="pull-right postreply">
                                <div class="pull-left">
                                    <button type="button" id="postForum" class="btn btn-primary" style="width: 100px">Post</button>
                                </div>&nbsp;
                                <a class="btn btn-cancel" href="/landing" style="width: 100px">Cancel</a>
                                <div class="clearfix"></div>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div><!-- POST -->


            </div>
{{--            <div class="col-lg-4 col-md-4">--}}

{{--            </div>--}}
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('/assets-custom/js/post.js') }}"></script>
    <script src="{{ asset('/assets-custom/js/rating.js') }}"></script>
@endsection

