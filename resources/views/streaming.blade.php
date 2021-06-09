@extends('layouts.app')

@section('breadcrumb')
  <!-- ##### Viral News Breadcumb Area Start ##### -->
  <div class="viral-news-breadcumb-area section-padding-50">
    <div class="container h-100">
        <div class="row h-100 align-items-center">

            <!-- Breadcumb Area -->
            <div class="col-lg-4 col-md-4 col-8">
                <h3>TV Online</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">TV Online</li>
                    </ol>
                </nav>
            </div>

            <div class="col-4 d-block d-md-none btn-app pl-0 pr-0">
                <a class="btn-download" href='https://play.google.com/store/apps/details?id=com.humabentang&pcampaignid=pcampaignidMKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1'><img class="download-btn lazyload" alt='Temukan di Google Play' data-src='{{asset('public/template/front/img/google-play-badge.png')}}'/></a>
                <a class="btn-download" href='#'><img class="download-btn lazyload" alt='Download on App Store' data-src='{{asset('public/template/front/img/appstore.png')}}'/></a>
            </div>

            @php($ads = Helper::getAds())
            <!-- Add Widget -->
            <div class="col-lg-8 col-md-8 col-12">
                <div class="add-widget">
                    <a href="{{$ads->ads_link}}"><img class="lazyload" data-src="{{asset($ads->ads_img_landscape)}}" alt=""></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Viral News Breadcumb Area End ##### -->

@endsection


@section('content')

<div class="hero-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="hero-slides owl-carousel">
                    {{-- @php($horo_slider_news = \App\News::where('news_status_delete', 0)->orderBy('news_publish_datetime' ,'desc')->take(9)->get()) --}}

                    @foreach($tv_list as $tv)
                        <!-- Single Blog Post -->
                        <div class="single-blog-post d-flex align-items-center mb-50">
                            <div class="post-thumb">
                                <a href="#"><img data-src="{{asset($tv->tv_img)}}" class="lazyload" alt=""></a>
                            </div>
                            <div class="post-data">
                            <a href="#" class="post-title">
                                    <h6>{{ Str::limit($tv->tv_name, 40, '...') }}</h6>
                                </a>
                                <div class="post-meta">
                                <p class="post-date"><a href="#">{{ Str::limit($tv->tv_description, 40, '...') }}</a></p>
                                </div>
                            </div>
                        </div>

                    @endforeach

                    @if(count($tv_list) < 1)
                        <h5 class="post-title">No tv available</h2>
                    @endif

                </div>
            </div>

        </div>
    </div>
</div>


<div class="blog-area section-padding-50">
    <div class="container">
        <div class="row">

            @if(count($tv_list) > 0)

            <div class="col-12 col-lg-8">
                <div class="blog-posts-area">

                    <!-- Single Featured Post -->
                    <div class="single-blog-post-details">
                        <div class="post-thumb">
                            {{-- <img src="img/bg-img/18.jpg" alt=""> --}}
                            {{-- <video id="my_video_1" class="video-js vjs-default-skin" controls preload="auto"
                            data-setup='{}'>
                                <source type="application/x-mpegURL" src="https://bitdash-a.akamaihd.net/content/MI201109210084_1/m3u8s/f08e80da-bf1d-4e3d-8899-f0f6155f6efa.m3u8">
                            </video> --}}
                            <video height="600" id="video" controls></video>

                        </div>
                        <div class="post-data">
                            {{-- <a href="#" class="post-catagory">Finance</a> --}}
                            <h2 class="post-title">{{$tv_list[0]->tv_name}}</h2>

                            {{$tv_list[0]->tv_description}}

                            <div class="post-meta">

                                <!-- Post Details Meta Data -->
                                <div class="post-details-meta-data mb-50 d-flex align-items-center justify-content-between">
                                    <!-- Post Author & Date -->
                                    <div class="post-authors-date">
                                        {{-- <p class="post-author">By <a href="#">Michael Smithson</a></p>
                                        <p class="post-date">5 Hours Ago</p> --}}
                                    </div>
                                    <!-- View Comments -->
                                    <div class="view-comments">
                                        <p class="views">1281 Views</p>
                                        <a href="#comments" class="comments">3 comments</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div id="frame" class="col-12 col-lg-4 px-sm-0 px-0">
                <div class="content">
                    <div class="contact-profile">
                        @if(Auth::user())
                            <img src="{{Auth::user()->picture}}" alt="" />
                            {{Auth::user()->username}}
                            <div class="social-media">
                                {{-- <i class="fa fa-facebook" aria-hidden="true"></i>
                                <i class="fa fa-twitter" aria-hidden="true"></i>
                                <i class="fa fa-instagram" aria-hidden="true"></i> --}}
                                <i class="fa fa-sign-out" aria-hidden="true"></i>
                            </div>
                        @else

                        <i class="fa fa-comment fa-2x m-2" aria-hidden="true"></i>Live Chat
                        <div class="social-media">
                            {{-- <i class="fa fa-facebook" aria-hidden="true"></i>
                            <i class="fa fa-twitter" aria-hidden="true"></i>
                            <i class="fa fa-instagram" aria-hidden="true"></i> --}}
                            <i class="fa fa-sign-in fa-lg login" aria-hidden="true"></i>
                        </div>
                        @endif



                    </div>
                    <div class="messages">
                        <ul>

                        </ul>
                    </div>
                    @if(Auth::user())

                    <div class="message-input">
                        <div class="wrap">
                        <input type="text" placeholder="Write your message..." />
                        <button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                        </div>
                    </div>

                    @else

                    <div class="message-input">
                        <div class="wrap d-flex justify-content-center">
                                <h6>Login to join Chat</h6>
                        </div>
                    </div>

                    @endif


                </div>
            </div>

            @endif


        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src='{{asset('public/template/front/js/stopExcecutionOnTimeout.js')}}'></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

<script type="text/javascript">

        if(Hls.isSupported()) {
          var video = document.getElementById('video');
          var hls = new Hls({
              debug: false,
              autoStartLoad: true
          });
          hls.loadSource('https://5e396e0211d7a.streamlock.net/jurnaltv/live/playlist.m3u8');
          hls.attachMedia(video);
          hls.on(Hls.Events.MEDIA_ATTACHED, function() {
            video.muted = false;
            video.play();
        });
       }
       // hls.js is not supported on platforms that do not have Media Source Extensions (MSE) enabled.
       // When the browser has built-in HLS support (check using `canPlayType`), we can provide an HLS manifest (i.e. .m3u8 URL) directly to the video element throught the `src` property.
       // This is using the built-in support of the plain video element, without using hls.js.
        else if (video.canPlayType('application/vnd.apple.mpegurl')) {
          video.src = 'https://5e396e0211d7a.streamlock.net/jurnaltv/live/playlist.m3u8';
          video.addEventListener('canplay',function() {
            video.play();
          });
        }


        // chat

        $(".messages").animate({ scrollTop: $(document).height() }, "slow");

        function newMessage() {
            message = $(".message-input input").val();
            if($.trim(message) == '') {
                return false;
            }
            $('<li class="replies"><img data-src="http://emilcarlsson.se/assets/mikeross.png" class="lazyload" alt="" /><p>' + message + '</p></li>').appendTo($('.messages ul'));
            $('.message-input input').val(null);
            $('.contact.active .preview').html('<span>You: </span>' + message);
            $(".messages").animate({ scrollTop: $(document).height() }, "slow");
        };

        function addMessage(data) {

            @if(Auth::user())
                id_users = {{Auth::user()->id}};
            @else
                id_users = 0;
            @endif

            //cek if own message

            if(data.user.id == id_users){
                status = 'replies';
            }else{
                status = 'sent';
            }

            if($.trim(data.message) == '') {
                return false;
            }
            $('<li class="'+status+'"><img data-src="'+data.user.picture+'" class="lazyload" alt="" /><p>' + data.message + '</p></li>').appendTo($('.messages ul'));
            $('.message-input input').val(null);
            $('.contact.active .preview').html('<span>You: </span>' + data.message);
            $(".messages").animate({ scrollTop: $(document).height() }, "slow");
        };

        $('.submit').click(function() {
            // newMessage();
            sendMessage();
        });

        $(window).on('keydown', function(e) {
        if (e.which == 13) {
            // newMessage();
            sendMessage()
            return false;
        }
        });

        Pusher.logToConsole = true;

        var pusher = new Pusher('cb071e8da9c0805e31e0', {
        cluster: 'ap1'
        });

        var channel = pusher.subscribe('jurnal_tv');
        channel.bind('new_messages', function(data) {
            // alert(JSON.stringify(data));
            addMessage(data);
        });




        function sendMessage(){

            @if(Auth::user())
                id_users = {{Auth::user()->id}};
            @else
                id_users = 0;
            @endif

            messages = $(".message-input input").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });
            $.ajax({
                type: 'POST',
                url: '{{url('/pusher/sendMessage')}}',
                data: {
                    user_id: id_users,
                    channel_id: 1,
                    message: messages,
                },
                success: function(data) {
                    console.log(data);
                },
                error: function(data) {
                    alert(JSON.stringify(data));
                }
                });
        }



</script>

@endsection
