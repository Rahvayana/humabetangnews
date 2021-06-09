@extends('layouts.app')

@section('breadcrumb')
  <!-- ##### Viral News Breadcumb Area Start ##### -->
  <div class="viral-news-breadcumb-area section-padding-50">
    <div class="container h-100">
        <div class="row h-100 align-items-center">

            <!-- Breadcumb Area -->
            <div class="col-lg-4 col-md-4 col-8">
                <h3>Kategori</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$kategori->news_categories_name}}</li>
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
<div class="blog-area section-padding-50">

    <div class="container">
        <div class="row">
            <!-- Blog Posts Area -->
            <div class="col-12 col-lg-8">
                <div class="row">

                    @foreach($all_news as $news)
                        <!-- Single Blog Post -->
                        <div class="col-12 col-lg-6">
                            <div class="single-blog-post style-3">
                                <!-- Post Thumb -->
                                <div class="post-thumb">
                                    <a href="{{asset($news->news_img)}}"><img class="lazyload" data-src="{{asset($news->news_img)}}" alt=""></a>
                                </div>
                                <!-- Post Data -->
                                <div class="post-data">
                                    <a href="{{url('berita/kategori/'. $news->category->news_categories_slug)}}" class="post-catagory">{{$news->category->news_categories_name}}</a>
                                <a href="{{url('/berita/'.$news->news_slug)}}" class="post-title">
                                        <h6>{{ Str::limit($news->news_title, 40, '...') }}</h6>
                                    </a>
                                    <div class="post-meta">
                                        <p class="post-author">Oleh <a href="#">{{$news->authors->name}}</a></p>
                                        <p class="post-date">{{$news->news_publish_datetime->diffForHumans()}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="viral-news-pagination">
                            <nav aria-label="Page navigation example">
                                {{ $all_news->links('pagination::bootstrap-4-front') }}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Area -->

            <div class="col-12 col-lg-4">
                @include('common.front.sidebar')

            </div>
        </div>
    </div>

</div>
@endsection
