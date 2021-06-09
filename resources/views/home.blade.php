@extends('layouts.app')

@section('content')
<div class="viral-story-blog-post section-padding-0-50">

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
