@extends('layout.mainlayout')
@inject('carbon', 'Illuminate\Support\Carbon')
@section('content')
{{--    @auth--}}

        <!-- Slider -->
        <div class="tp-banner-container">
            <div class="tp-banner" >
                <ul>
                    <!-- SLIDE  -->
                    <li data-transition="fade" data-slotamount="7" data-masterspeed="1500" >
                        <!-- MAIN IMAGE -->
                        <img src="{{ asset('images/slide4.jpg') }}" alt="slidebg1" data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
                        <!-- LAYERS -->
                    </li>
                    <li data-transition="fade" data-slotamount="7" data-masterspeed="1500" >
                        <!-- MAIN IMAGE -->
                        <img src="{{ asset('images/slide2.jpg') }}" alt="slidebg1" data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
                        <!-- LAYERS -->
                    </li>
                    <li data-transition="fade" data-slotamount="7" data-masterspeed="1500" >
                        <!-- MAIN IMAGE -->
                        <img src="{{ asset('images/slide3.jpg') }}" alt="slidebg1" data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
                        <!-- LAYERS -->
                    </li>
                </ul>
            </div>
        </div>
        <!-- //Slider -->

        <div class="headernav">
            <div class="container">
                <div class="row">
                    <div class="col search">
                        <div class="wrap">
                            <form action="/landing" method="get" class="form">
                                <div class="pull-left txt"><input type="text" class="form-control" name="q" id="searchText" placeholder="What are you looking for ?" value="{{ app('request')->input('q') }}"></div>
                                <div class="pull-right"><button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button></div>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <main role="main" class="container">

{{--            Auth::user() = {{ Auth::user()->getUsername() }}<BR/>--}}
{{--            session()->get("user") = {{ session()->get("user") }}--}}
{{--{{ session("user")--}}
{{--}}--}}
{{--            {{ $data }}--}}




            <section class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-xs-12 col-md-12">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <!-- <div class="col-lg-8 col-md-8"> -->
                        <div class="col-lg-12 col-md-12" style="margin-top: 20px;">

                            @foreach($forums as $forum)

                            <!-- POST -->
                            <div class="post">
                                <div class="wrap-ut pull-left">
                                    <div class="landing-cell pull-left">
                                        <div class="avatar">
                                            <a href="/profile/{{$forum->created_by}}">
                                                <img src="{{ Storage::disk('image')->url('image/'.$forum->created_by.'-images.jpg') }}" alt="" onerror="this.src='/assets-admin/images/KD_logo.png'" />
                                            </a>
                                            <!-- <div class="status green">&nbsp;</div> -->
                                        </div>

                                        <div class="icons"></div>

                                    </div>
                                    <div class="posttext pull-left">
                                        <h2><a href="{{ ((session("user")->role == "A") ? "/reply/agent/" : "/reply/hotel/"). $forum->req_id }}" target="_blank">{{ $forum->req_topic }}</a></h2>

                                        <p><i class="fa fa-calendar-o"></i> {{ (new $carbon($forum->req_st_date))->format('d-M-Y') . ' to ' . (new $carbon($forum->req_en_date))->format('d-M-Y') }}</p>
                                        <p><i class="fa fa-map-marker"></i> {{ $forum->req_location }}</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="postinfo pull-left">
                                    <div class="comments">
                                        <div class="commentbg">
                                            Reply<br>
                                            {{ $forum->reply_amount }}
                                            <div class="mark"></div>
                                        </div>
                                        <div class="commentbg">
                                            Hotel<br>
                                            {{ $forum->c_reply_hotel }}
                                            <div class="mark"></div>
                                        </div>
                                    </div>
                                    <div class="views"><i class="fa fa-bed"></i> {{ $forum->req_room }} room need</div>
                                    <div class="time"><i class="fa fa-clock-o"></i> {{ $carbon->createFromTimeString($forum->created_date)->diffForHumans() }}</div>
                                </div>
                                <div class="clearfix"></div>
                            </div><!-- POST -->

                            @endforeach
                        </div>
                        <!-- <div class="col-lg-4 col-md-4">
                            <div class="sidebarblock">
                                <h3>Location (Province)</h3>
                                <div class="divline"></div>
                                <div class="blocktxt">
                                    <ul class="cats">
                                        <li><a href="#">Phuket <span class="badge pull-right">22</span></a></li>
                                        <li><a href="#">Bangkok <span class="badge pull-right">12</span></a></li>
                                        <li><a href="#">Chiangmai<span class="badge pull-right">4</span></a></li>
                                        <li><a href="#">Krabi<span class="badge pull-right">2</span></a></li>
                                        <li><a href="#">Petchburi<span class="badge pull-right">1</span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sidebarblock">
                                <h3>Poll of the Week</h3>
                                <div class="divline"></div>
                                <div class="blocktxt">
                                    <p>Which game you are playing this week?</p>
                                    <form action="#" method="post" class="form">
                                        <table class="poll">
                                            <tr>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar color1" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 90%">
                                                            Call of Duty Ghosts
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="chbox">
                                                    <input id="opt1" type="radio" name="opt" value="1">
                                                    <label for="opt1"></label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar color2" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 63%">
                                                            Titanfall
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="chbox">
                                                    <input id="opt2" type="radio" name="opt" value="2" checked>
                                                    <label for="opt2"></label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar color3" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 75%">
                                                            Battlefield 4
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="chbox">
                                                    <input id="opt3" type="radio" name="opt" value="3">
                                                    <label for="opt3"></label>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                    <p class="smal">Voting ends on 19th of October</p>
                                </div>
                            </div>


                            <div class="sidebarblock">
                                <h3>My Active Threads</h3>
                                <div class="divline"></div>
                                <div class="blocktxt">
                                    <a href="#">This Dock Turns Your iPhone Into a Bedside Lamp</a>
                                </div>
                                <div class="divline"></div>
                                <div class="blocktxt">
                                    <a href="#">Who Wins in the Battle for Power on the Internet?</a>
                                </div>
                                <div class="divline"></div>
                                <div class="blocktxt">
                                    <a href="#">Sony QX10: A Funky, Overpriced Lens Camera for Your Smartphone</a>
                                </div>
                                <div class="divline"></div>
                                <div class="blocktxt">
                                    <a href="#">FedEx Simplifies Shipping for Small Businesses</a>
                                </div>
                                <div class="divline"></div>
                                <div class="blocktxt">
                                    <a href="#">Loud and Brave: Saudi Women Set to Protest Driving Ban</a>
                                </div>
                            </div>


                        </div> -->
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-xs-12 col-md-12 text-center">
                            {!! $forums->render() !!}
                        </div>
                    </div>
                </div>
            </section>

        </main>
{{--    @endauth--}}
        <script type="text/javascript" src="{{ asset('/assets-custom/js/landing.js') }}"></script>
@endsection

