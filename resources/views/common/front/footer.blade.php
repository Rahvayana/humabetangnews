<footer class="footer-area">

    <!-- Main Footer Area -->
    <div class="main-footer-area">
        <div class="container">
            <div class="row">

                <!-- Footer Widget Area -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="footer-widget-area">
                        <!-- Footer Logo -->
                        {{-- <div class="footer-logo">
                        <a href="{{url('/')}}"><img src="{{asset($config->logo)}}" alt="logo"></a>
                        </div> --}}

                        @php($category = \App\NewsCategory::where('news_categories_status_delete', 0)->orderBy('news_categories_order', 'asc')->get())

                        <!-- Footer Nav -->
                        <div class="footer-nav">
                            <ul>
                                <li class="active"><a href="#">Top 10</a></li>
                                <li><a href="{{url('/tv-online')}}">TV Online</a></li>
                                <li><a href="{{url('/video')}}">Video</a></li>
                                <li><a href="{{url('/kontak')}}">Kontak Kami</a></li>
                            </ul>
                        </div>

                        <div class="row">
                            <a class="btn-download" href='https://play.google.com/store/apps/details?id=com.humabentang&pcampaignid=pcampaignidMKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1'><img class="download-btn lazyload" alt='Temukan di Google Play' data-src='{{asset('public/template/front/img/google-play-badge.png')}}'/></a>
                        </div>
                        <div class="row">
                            <a class="btn-download" href='#'><img class="download-btn lazyload" alt='Download on App Store' data-src='{{asset('public/template/front/img/appstore.png')}}'/></a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <!-- Newsletter Widget -->
                    <div class="newsletter-widget">
                        <h4 class="py-4">Berlangganan <br>berita kami</h4>
                        <form action="#" method="post">
                            <input type="text" name="text" placeholder="Name">
                            <input type="email" name="email" placeholder="Email">
                            <button type="submit" class="btn w-100">Subscribe</button>
                        </form>
                    </div>
                </div>

                <!-- Footer Widget Area -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="footer-widget-area">
                        <!-- Widget Title -->
                        <h4 class="widget-title mt-0 mb-1">Berita Terbaru</h4>
                        @php($lastest_news = \App\News::where('news_status_delete', 0)->orderBy('news_publish_datetime', 'desc')->take(3)->get())

                        @foreach($lastest_news as $lastnews)
                                   <!-- Single Latest Post -->
                            <div class="single-blog-post style-2 d-flex align-items-center">
                                <div class="post-thumb">
                                    <a href="{{asset($lastnews->news_img)}}"><img class="lazyload" data-src="{{asset($lastnews->news_img)}}" alt=""></a>
                                </div>

                                <div class="post-data">
                                    <a href="{{url('/berita/'.$lastnews->news_slug)}}" class="post-title">
                                        <h6>{{ Str::limit($lastnews->news_title, 40, '...') }}</h6>
                                    </a>
                                    <div class="post-meta">
                                        {{-- <p class="post-date"><a href="#">7:00 AM | April 14</a></p> --}}
                                        <p class="post-date"><a href="#">{{$lastnews->news_publish_datetime->format('h:i A')}} | {{$lastnews->news_publish_datetime->format('d F')}}</a></p>

                                    </div>
                                </div>
                            </div>
                        @endforeach




                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Footer Area -->
    <div class="bottom-footer-area pt-2 pb-2">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <!-- Copywrite -->
                <p><a href="{{url('/')}}"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    {{ $config->web_app_name }}
                </a>
                <span class="text-center text-sm-left">
                    {{ $config->footer }}
                </span>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                </div>
            </div>
        </div>
    </div>
</footer>
