<div class="hero-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="hero-slides owl-carousel">
                    @php($horo_slider_news = \App\News::where('news_status_delete', 0)->where('news_status', 1)->orderBy('news_publish_datetime' ,'desc')->take(9)->get())

                    @foreach($horo_slider_news as $hero)
                        <!-- Single Blog Post -->
                        <div class="single-blog-post d-flex align-items-center mb-50">
                            <div class="post-thumb">
                            <a href="{{asset($hero->news_img)}}"><img data-src="{{asset($hero->news_img)}}" class="lazyload" alt=""></a>
                            </div>
                            <div class="post-data">
                            <a href="{{url('/berita/'.$hero->news_slug)}}" class="post-title">
                                    <h6>{{ Str::limit($hero->news_title, 40, '...') }}</h6>

                                </a>
                                <div class="post-meta">
                                <p class="post-date"><a href="#">{{$hero->news_publish_datetime->diffForHumans()}}</a></p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

        </div>
    </div>
</div>
