<div class="sidebar-area">

    <!-- Newsletter Widget -->
    <div class="newsletter-widget mb-70">
        <h4 class="py-4">Berlangganan <br>berita kami</h4>
        <form action="#" method="post">
            <input type="text" name="text" placeholder="Name">
            <input type="email" name="email" placeholder="Email">
            <button type="submit" class="btn w-100">Subscribe</button>
        </form>
    </div>


    @php($trending_news = \App\News::where('news_status_delete', 0)
    ->withCount([
        'likes',
        'views',
        'comments' => function ($query) {
            $query->where('status_delete_coment', 0);
        }])
    ->orderBy('likes_count', 'desc')
    ->orderBy('views_count', 'desc')
    ->orderBy('comments_count', 'desc')
    ->take(3)
    ->get())

        <!-- Trending Articles Widget -->
        <div class="treading-articles-widget mb-70">
            <h4>Berita Populer</h4>

            @foreach($trending_news as $index=>$trending)


                <!-- Single Trending Articles -->
                <div class="single-blog-post style-4">
                    <!-- Post Thumb -->
                    <div class="post-thumb">
                        <a href="{{url($trending->news_img)}}"><img class="lazyload" data-src="{{asset($trending->news_img)}}" alt=""></a>
                        <span class="serial-number">{{$index + 1}}.</span>
                    </div>
                    <!-- Post Data -->
                    <div class="post-data">
                    <a href="{{url('/berita/'.$trending->news_slug)}}" class="post-title">
                            <h6>{{ Str::limit($trending->news_title, 50, '...') }}</h6>
                        </a>
                        <div class="post-meta">
                            <p class="post-author">Oleh <a href="#">{{$trending->authors->name}}</a></p>
                        </div>
                    </div>
                </div>

            @endforeach

        </div>


        @php($ads = Helper::getAds())
        <!-- Add Widget -->
         <div class="add-widget mb-70">
         <a href="{{$ads->ads_link}}"><img class="lazyload" data-src="{{asset($ads->ads_img)}}" alt=""></a>
         </div>


    <!-- Latest Comments -->
    <div class="latest-comments-widget">
        <h4 class="mb-2">Komentar Terbaru</h4>
        @php($lastest_comments = \App\NewsUserComent::with(['news','users'])->orderBy('created_at','desc')->where('status_delete_coment', 0)->take(3)->get())

        @foreach($lastest_comments as $lastcom)
            <!-- Single Comment Widget -->
            <div class="single-comments d-flex">
                <div class="comments-thumbnail">
                <img class="lazyload" data-src="{{asset($lastcom->users->picture)}}" alt="">
                </div>
                <div class="comments-text">
                <a href="#"><span>{{$lastcom->users->username}}</span> pada {{ Str::limit($lastcom->news->news_title, 25, '...') }} </a>
                    <p>06:34 am, April 14, 2018</p>
                </div>
            </div>
        @endforeach
    </div>

</div>
