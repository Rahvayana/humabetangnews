<div class="welcome-slide-area">
    <div class="container">
        <div class="row">
            <div class="col-12">


                <div class="welcome-slides owl-carousel">

                    @php($headline_news = \App\News::where('news_status_delete', 0)->where('news_status', 1)->where('news_headlines_status', 1)->orderBy('news_publish_datetime')->take(6)->get())

                    {{-- @for ($x = 1; $x <= 2; $x++) --}}

                    <div class="single-welcome-slide">
                        <div class="row no-gutters">
                            <div class="col-12 col-lg-8">
                                <!-- Welcome Post -->
                                <div class="welcome-post">
                                    <img data-src="{{asset($headline_news[0]->news_img)}}" class="lazyload" alt="">
                                    <div class="post-content" data-animation="fadeInUp" data-duration="500ms">
                                    <a href="{{url('berita/kategori/'. $headline_news[0]->category->news_categories_slug)}}" class="tag">{{$headline_news[0]->category->news_categories_name}}</a>
                                    <a href="{{url('berita/'.$headline_news[0]->news_slug)}}" class="post-title">{{ Str::limit($headline_news[0]->news_title, 50, '...') }}</a>
                                        <p>{{$headline_news[0]->news_publish_datetime->diffForHumans()}}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="welcome-posts--">

                                    @foreach($headline_news->skip(1)->take(2) as $first)

                                    <!-- Welcome Post -->
                                    <div class="welcome-post style-2">
                                    <img data-src="{{asset($first->news_img)}}" class="lazyload" alt="">
                                        <div class="post-content" data-animation="fadeInUp" data-delay="500ms" data-duration="500ms">
                                            <a href="{{url('berita/kategori/'. $first->category->news_categories_slug)}}" class="tag tag-2">{{$first->category->news_categories_name}}</a>
                                            <a href="{{url('berita/'.$first->news_slug)}}" class="post-title">{{ Str::limit($first->news_title, 40, '...') }}</a>
                                            <p>{{$first->news_publish_datetime->diffForHumans()}}</p>
                                        </div>
                                    </div>

                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="single-welcome-slide">
                        <div class="row no-gutters">
                            <div class="col-12 col-lg-8">
                                <!-- Welcome Post -->
                                <div class="welcome-post">
                                    <img class="lazyload" data-src="{{asset($headline_news[3]->news_img)}}" alt="">
                                    <div class="post-content" data-animation="fadeInUp" data-duration="500ms">
                                        <a href="{{url('berita/kategori/'.$headline_news[3]->category->news_categories_slug)}}" class="tag">{{$headline_news[3]->category->news_categories_name}}</a>
                                        <a href="{{url('berita/'.$headline_news[3]->news_slug)}}" class="post-title">{{ Str::limit($headline_news[3]->news_title, 50, '...') }}</a>
                                        <p>{{$headline_news[3]->news_publish_datetime->diffForHumans()}}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="welcome-posts--">

                                    @foreach($headline_news->skip(4)->take(2) as $second)

                                    <!-- Welcome Post -->
                                    <div class="welcome-post style-2">
                                    <img class="lazyload" data-src="{{asset($second->news_img)}}" alt="">
                                        <div class="post-content" data-animation="fadeInUp" data-delay="500ms" data-duration="500ms">
                                            <a href="{{url('berita/kategori/'. $second->category->news_categories_slug)}}" class="tag tag-2">{{$second->category->news_categories_name}}</a>
                                            <a href="{{url('berita/'.$second->news_slug)}}" class="post-title">{{ Str::limit($second->news_title, 40, '...') }}</a>
                                            <p>{{$second->news_publish_datetime->diffForHumans()}}</p>
                                        </div>
                                    </div>

                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>







                </div>
            </div>
        </div>
    </div>
</div>
