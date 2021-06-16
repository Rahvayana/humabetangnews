@extends('layouts.app')
@section('content')
     <!-- News Details Page Area Start Here -->
 <section class="bg-body section-space-less30 mt-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 mb-30">
                <div class="news-details-layout1">
                    <div class="position-relative mb-30">
                        <img src="{{asset($news->news_img)}}" class="img-fluid">
                        <div class="topic-box-top-sm">
                            <div class="topic-box-sm color-cinnabar mb-20">Business</div>
                        </div>
                    </div>
                    <h2 class="title-semibold-dark size-c30">{{$news->news_title}}</h2>
                    <ul class="post-info-dark mb-30">
                        <li>
                            <a href="#">
                                <span>By</span> {{$news->name}}</a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-calendar" aria-hidden="true"></i>{{date('m-d-Y',strtotime($news->created_at))}}</a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-eye" aria-hidden="true"></i>202</a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-comments" aria-hidden="true"></i>20</a>
                        </li>
                    </ul>
                    {!! $news->news_content !!}
                    
                    <div class="post-share-area mb-40 item-shadow-1">
                        <p>You can share this post!</p>
                        <ul class="social-default item-inline">
                            <li>
                                <a href="#" class="facebook">
                                    <i class="fa fa-facebook" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="twitter">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="google">
                                    <i class="fa fa-google-plus" aria-hidden="true"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="row no-gutters divider blog-post-slider">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                            <a href="{{$prev_news->news_slug}}" class="prev-article">
                                <i class="fa fa-angle-left" aria-hidden="true"></i>Previous article</a>
                            <h3 class="title-medium-dark pr-50">{{$prev_news->news_title}}</h3>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-right">
                            <a href="{{$next_news->news_slug}}" class="next-article">Next article
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                            </a>
                            <h3 class="title-medium-dark pl-50">{{$next_news->news_title}}</h3>
                        </div>
                    </div>
                    
                    <div class="comments-area">
                        <h2 class="title-semibold-dark size-xl border-bottom mb-40 pb-20">{{$comments->count()}} Comments</h2>
                        <ul>
                            @foreach ($comments as $comment)
                            <li>
                                <div class="media media-none-xs">
                                    {{-- <img src="img/blog1.jpg" class="img-fluid rounded-circle" alt="comments"> --}}
                                    <div class="media-body comments-content media-margin30">
                                        <h3 class="title-semibold-dark">
                                            <a href="#">User ,
                                                <span> {{$comment->created_at}}</span>
                                            </a>
                                        </h3>
                                        <p>{{$comment->text_coment}}</p>
                                    </div>
                                </div>
                            </li> 
                            @endforeach
                        </ul>
                    </div>
                    <div class="leave-comments">
                        <h2 class="title-semibold-dark size-xl mb-40">Leave Comments</h2>
                        <form id="leave-comments">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <input placeholder="Name*" class="form-control" type="text">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <input placeholder="Email*" class="form-control" type="email">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea placeholder="Message*" class="textarea form-control" id="form-message" rows="8" cols="20"></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-none">
                                        <button type="submit" class="btn-ftg-ptp-45">Post Comment</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="ne-sidebar sidebar-break-md col-lg-4 col-md-12">
                <div class="sidebar-box">
                    <div class="ne-banner-layout1 text-center">
                        <a href="#">
                            <img src="{{asset("public/template/front/img/banner/banner3.jpg")}}" alt="ad" class="img-fluid">
                        </a>
                    </div>
                </div>
                <div class="sidebar-box">
                    <div class="topic-border color-cod-gray mb-5">
                        <div class="topic-box-lg color-cod-gray">News Related</div>
                    </div>
                    <div class="row">
                        @foreach ($news_relateds as $news)
                        <div class="col-lg-6 col-md-4 col-sm-6 col-6">
                            <div class="mt-25 position-relative">
                                <div class="topic-box-top-xs">
                                    <div class="topic-box-sm color-cod-gray mb-20">Nature</div>
                                </div>
                                <a href="single-news-1.html" class="mb-10 display-block img-opacity-hover">
                                    <img src="{{asset($news->news_img)}}" alt="ad" class="img-fluid m-auto width-100">
                                </a>
                                <h3 class="title-medium-dark size-md mb-none">
                                    <a href="{{$news->news_slug}}">{{$news->news_title}}</a>
                                </h3>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="sidebar-box">
                    <div class="topic-border color-cod-gray mb-30">
                        <div class="topic-box-lg color-cod-gray">Newsletter</div>
                    </div>
                    <div class="newsletter-area bg-primary">
                        <h2 class="title-medium-light size-xl pl-30 pr-30">Subscribe to our mailing list to get the new updates!</h2>
                        <p>Subscribe our newsletter to stay updated</p>
                        <div class="input-group stylish-input-group">
                            <input type="text" placeholder="Enter your mail" class="form-control">
                            <span class="input-group-addon">
                                <button type="submit">
                                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- News Details Page Area End Here -->
@endsection