@extends('layouts.app')

@section('breadcrumb')
  <!-- ##### Viral News Breadcumb Area Start ##### -->
  <div class="viral-news-breadcumb-area section-padding-50">
    <div class="container h-100">
        <div class="row h-100 align-items-center">

            <!-- Breadcumb Area -->
            <div class="col-lg-4 col-md-4 col-8">
                <h3>Berita</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{url('berita/kategori/'.$news->category->news_categories_slug)}}">{{$news->category->news_categories_name}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
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
            <div class="col-12 col-lg-8">
                <div class="blog-posts-area">

                    <!-- Single Featured Post -->
                    <div class="single-blog-post-details">
                        <div class="post-thumb">
                        <img data-src="{{asset($news->news_img)}}" class="lazyload" alt="">
                        </div>
                        <div class="post-data">
                            <a href="{{url('berita/kategori/'. $news->category->news_categories_slug)}}" class="post-catagory">{{$news->category->news_categories_name}}</a>
                            <h2 class="post-title">{{$news->news_title}}</h2>
                            <div class="post-meta">

                                <!-- Post Details Meta Data -->
                                <div class="post-details-meta-data mb-50 d-flex align-items-center justify-content-between">
                                    <!-- Post Author & Date -->
                                    <div class="post-authors-date">
                                        <p class="post-author">Oleh <a href="#">{{$news->authors->name}}</a></p>
                                        <p class="post-date">{{$news->news_publish_datetime->format('d F Y')}}</p>
                                    </div>
                                    <!-- View Comments -->
                                    <div class="view-comments">
                                        <p class="likes d-inline-block">3 Likes</p>&nbsp; &nbsp;
                                        <p class="views d-inline-block">{{$news->views->count()}} Views</p> &nbsp; &nbsp;
                                        <a href="#comments" class="comments d-inline-block">{{$news->comments->count()}} Komentar</a>
                                    </div>
                                </div>
                                                        {!! $news->news_content !!}

                            </div>
                        </div>
                        @if(!Auth::check())
                            <!-- Login with google to post comments -->
                            <div class="login-with-google my-5 login">
                                <a href="#">Login with Google to post comments</a>
                            </div>
                        @endif


                    </div>

                    <!-- Related Articles Area -->
                    <div class="related-articles-">
                        <h4 class="mb-70">Berita serupa</h4>

                        <div class="row">

                            @foreach($news_related as $relatednews)
                                <!-- Single Post -->
                                <div class="col-12">
                                    <div class="single-blog-post style-3 style-5 d-flex align-items-center mb-50">
                                        <!-- Post Thumb -->
                                        <div class="post-thumb">
                                            <a href="{{asset($relatednews->news_img)}}"><img data-src="{{asset($relatednews->news_img)}}" class="lazyload" alt=""></a>
                                        </div>
                                        <!-- Post Data -->
                                        <div class="post-data">
                                            <a href="{{url('/berita/kategori/'.$relatednews->category->news_categories_slug)}}" class="post-catagory">{{$relatednews->category->news_categories_name}}</a>
                                            <a href="{{url('/berita/'.$relatednews->news_slug)}}" class="post-title">
                                                <h6>{{ Str::limit($relatednews->news_title, 40, '...') }}</h6>
                                            </a>
                                            <div class="post-meta">
                                                <p class="post-author">Oleh <a href="#">{{$relatednews->authors->name}}</a></p>
                                                <p class="post-date">{{$relatednews->news_publish_datetime->diffForHumans()}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>



                    <!-- Comment Area Start -->
                    <div class="comment_area clearfix" id="comments">
                        <h4 class="title mb-70">{{$news->comments->count()}} Komenter</h4>

                        <ol>
                            <!-- Single Comment Area -->
                            {{-- <li class="single_comment_area">
                                <!-- Comment Content -->
                                <div class="comment-content d-flex">
                                    <!-- Comment Author -->
                                    <div class="comment-author">
                                        <img src="img/bg-img/t1.jpg" alt="author">
                                    </div>
                                    <!-- Comment Meta -->
                                    <div class="comment-meta">
                                        <a href="#" class="post-author">Christian Williams</a>
                                        <a href="#" class="post-date">April 15, 2018</a>
                                        <p>Donec turpis erat, scelerisque id euismod sit amet, fermentum vel dolor. Nulla facilisi. Sed pellen tesque lectus et accu msan aliquam. Fusce lobortis cursus quam, id mattis sapien.</p>
                                    </div>
                                </div>
                                <ol class="children">
                                    <li class="single_comment_area">
                                        <!-- Comment Content -->
                                        <div class="comment-content d-flex">
                                            <!-- Comment Author -->
                                            <div class="comment-author">
                                                <img src="img/bg-img/t2.jpg" alt="author">
                                            </div>
                                            <!-- Comment Meta -->
                                            <div class="comment-meta">
                                                <a href="#" class="post-author">Sandy Doe</a>
                                                <a href="#" class="post-date">April 15, 2018</a>
                                                <p>Donec turpis erat, scelerisque id euismod sit amet, fermentum vel dolor. Nulla facilisi. Sed pellen tesque lectus et accu msan aliquam. Fusce lobortis cursus quam, id mattis sapien.</p>
                                            </div>
                                        </div>
                                    </li>
                                </ol>
                            </li> --}}

                            @php($comments = $news->comments()->paginate(5))


                            @foreach( $comments as $comment)
                                <li class="single_comment_area mb-0">
                                    <!-- Comment Content -->
                                    <div class="comment-content d-flex">
                                        <!-- Comment Author -->
                                        <div class="comment-author mr-3">
                                            <img src="{{$comment->users->picture}}" alt="author">
                                        </div>
                                        <!-- Comment Meta -->
                                        <div class="comment-meta mb-0">
                                            <a href="#" class="post-author">{{$comment->users->username}}</a>
                                        <a href="#" class="post-date">{{$comment->created_at->diffForHumans()}}</a>
                                            <p>{{$comment->text_coment}}</p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach

                        </ol>
                        {{ $comments->links('pagination::bootstrap-4') }}

                    </div>

                    <div class="post-a-comment-area">

                            <div class="row">
                              @if(session()->has('success'))
                              <div class="col-12">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                  {{ session()->get('success') }}
                                  <button class=" close" type="button" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                  </button>
                                </div>
                              </div>
                              @endif

                              <div class="return-login-container-message col-12">

                              </div>

                              @if (count($errors) > 0)

                                  <div class="col-12">
                                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                          @foreach ($errors->all() as $error)
                                          - {!! $error !!}</br>
                                          @endforeach

                                          <button class=" close" type="button" data-dismiss="alert" aria-label="Close">
                                              <span aria-hidden="true">×</span>
                                          </button>
                                      </div>
                                  </div>

                              @endif


                              @if(session()->has('currency'))
                              <div class="col-12">
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                  You currencies doesnt match with game currencies, please
                                  <a class=" alert-link" href="{{ url('/dashboard/cashier#info') }}">add bank</a>
                                  account with currencies same as game currencies
                                  <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                  </button>
                                </div>
                              </div>
                              @endif

                            </div>





                        @if($news->comments->count() == 0)
                            <h6 class="mb-20">Belum ada komentar</h6>
                            <h6 class="mb-20">Jadilah yang pertama berkomentar di sini</h6>
                        @else
                        <h4 class="mb-20">Berikan komentar anda</h4>
                        @endif



                        <!-- Reply Form -->
                        <div class="contact-form-area">
                            <form action="{{ url('/berita/addcomment') }}" method="POST">
                                {{ csrf_field() }}

                                <div class="row">
                                    {{-- <div class="col-12 col-lg-6">
                                        <input type="text" class="form-control" id="name" placeholder="Name*">
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <input type="email" class="form-control" id="email" placeholder="Email*">
                                    </div>
                                    <div class="col-12">
                                        <input type="text" class="form-control" id="subject" placeholder="Website">
                                    </div> --}}
                                    <div class="col-12">
                                        <textarea name="message" class="form-control" id="message" name="message" cols="30" rows="10" placeholder="komentar"></textarea>
                                        <input type="hidden" value="{{$news->id}}" name="news_id">
                                    </div>
                                    <div class="col-12">
                                        <button class="btn viral-btn mt-30" type="submit">Kirim</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">


                @include('common.front.sidebar')

            </div>
        </div>
    </div>
</div>
@endsection
