@extends('layouts.app')

@section('content')
<!-- News Feed Area Start Here -->
<section class="bg-accent add-top-margin">
    <div class="container">
        <div class="row no-gutters d-flex align-items-center">
            <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                <div class="topic-box mt-10 mb-10">Top Stories</div>
            </div>
            <div class="col-lg-10 col-md-9 col-sm-8 col-6">
                <div class="feeding-text-dark">
                    <ol id="sample" class="ticker">
                        @foreach ($top_stories as $top_story)
                        <li>
                            <a href="{{ route('news.detail', $top_story->news_title) }}">{{$top_story->news_title}}</a>
                        </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- News Feed Area End Here -->
<!-- News Slider Area Start Here -->
<section class="bg-accent section-space-bottom-less4">
    <div class="container">
        <div class="row tab-space2">
            <div class="col-md-8 col-sm-12 mb-4">
                <div class="img-overlay-70 img-scale-animate">
                    <img src="{{$headline_news[0]->news_img}}" alt="news" class="img-fluid width-100">
                    <div class="mask-content-lg">
                        <div class="topic-box-sm color-cinnabar mb-20">{{$headline_news[0]->news_categories_name}}</div>
                        <div class="post-date-light">
                            <ul>
                                <li>
                                    <span>Oleh</span>
                                    <a href="{{ route('news.detail',$headline_news[0]->news_slug ) }}">{{$headline_news[0]->name}}</a>
                                </li>
                                <li>
                                    <span>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                    </span>{{date("m-d-Y",strtotime($headline_news[0]->created_at))}}</li>
                            </ul>
                        </div>
                        <h1 class="title-medium-light d-none d-sm-block">
                            <a href="{{ route('news.detail', $headline_news[0]->news_slug) }}">{{$headline_news[0]->news_title}}</a>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="img-overlay-70 img-scale-animate mb-4">
                    <div class="mask-content-sm">
                        <div class="topic-box-sm color-razzmatazz mb-10">{{$headline_news[1]->news_categories_name}}</div>
                        <h3 class="title-medium-light">
                            <a href="{{ route('news.detail', $headline_news[1]->news_slug) }}">{{$headline_news[1]->news_title}}</a>
                        </h3>
                    </div>
                    <img src="{{$headline_news[1]->news_img}}" alt="news" class="img-fluid width-100">
                </div>
                <div class="img-overlay-70 img-scale-animate mb-4">
                    <div class="mask-content-sm">
                        <div class="topic-box-sm color-apple mb-10">{{$headline_news[2]->news_categories_name}}</div>
                        <h3 class="title-medium-light">
                            <a href="{{ route('news.detail', $headline_news[2]->news_slug) }}">{{$headline_news[2]->news_title}}</a>
                        </h3>
                    </div>
                    <img src="{{$headline_news[2]->news_img}}" alt="news" class="img-fluid width-100">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- News Slider Area End Here -->
<!-- Top Story Area Start Here -->
<section class="bg-accent section-space-bottom">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="ne-isotope">
                    <div class="topic-border color-cinnabar mb-30">
                        <div class="topic-box-lg color-cinnabar">Top Stories</div>
                        <div class="more-info-link">
                            <a href="post-style-1.html">More
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                    <div class="featuredContainer">
                        <div class="row">
                            <div class="col-xl-4 col-lg-5 col-md-12 mb-30">
                                <div class="row">
                                  <div class="col-sm-12 col-12">
                                      @for ($i = 7; $i < 9; $i++)
                                      <div class="media bg-body item-shadow-gray mb-30">
                                        <a class="img-opacity-hover" href="{{ route('news.detail', $top_tens[$i]->news_slug) }}">
                                            <img src="{{$top_tens[$i]->news_img}}" width="110" height="113" alt="news" class="img-fluid">
                                        </a>
                                        <div class="media-body media-padding10">
                                            <div class="post-date-dark">
                                                <ul>
                                                    <li>
                                                        <span>
                                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                                        </span>{{date("m-d-Y",strtotime($top_tens[$i]->created_at))}}</li>
                                                </ul>
                                            </div>
                                            <h3 class="title-medium-dark mb-none">
                                                <a href="{{ route('news.detail', $top_tens[$i]->news_slug) }}" class="top_stories">{{$top_tens[$i]->news_title}}</a>
                                            </h3>
                                        </div>
                                      </div>
                                      @endfor
                                  </div>
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-7 col-md-12">
                                <div class="row">
                                    <div class="col-sm-6 col-12">
                                        @for ($i = 1; $i < 3; $i++)
                                        <div class="media bg-body item-shadow-gray mb-30">
                                          <a class="img-opacity-hover" href="{{ route('news.detail', $top_tens[$i]->news_slug) }}">
                                              <img src="{{$top_tens[$i]->news_img}}" width="110" height="113" alt="news" class="img-fluid">
                                          </a>
                                          <div class="media-body media-padding10">
                                              <div class="post-date-dark">
                                                  <ul>
                                                      <li>
                                                          <span>
                                                              <i class="fa fa-calendar" aria-hidden="true"></i>
                                                          </span>{{date("m-d-Y",strtotime($top_tens[$i]->created_at))}}</li>
                                                  </ul>
                                              </div>
                                              <h3 class="title-medium-dark mb-none">
                                                  <a href="{{ route('news.detail', $top_tens[$i]->news_slug) }}" class="top_stories">{{$top_tens[$i]->news_slug}}</a>
                                              </h3>
                                          </div>
                                        </div>
                                        @endfor
                                    </div>
                                    <div class="col-sm-6 col-12">
                                      @for ($i = 4; $i < 6; $i++)
                                      <div class="media bg-body item-shadow-gray mb-30">
                                        <a class="img-opacity-hover" href="{{ route('news.detail', $top_tens[$i]->news_slug) }}">
                                            <img src="{{$top_tens[$i]->news_img}}" width="110" height="113" alt="news" class="img-fluid">
                                        </a>
                                        <div class="media-body media-padding10">
                                            <div class="post-date-dark">
                                                <ul>
                                                    <li>
                                                        <span>
                                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                                        </span>{{date("m-d-Y",strtotime($top_tens[$i]->created_at))}}</li>
                                                </ul>
                                            </div>
                                            <h3 class="title-medium-dark mb-none">
                                                <a href="{{ route('news.detail', $top_tens[$i]->news_slug) }}" class="top_stories">{{$top_tens[$i]->news_title}}</a>
                                            </h3>
                                        </div>
                                      </div>
                                      @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="ne-banner-layout1 mt-20-r text-center">
                    <a href="#">
                        <img src="public/template/front/img/banner/banner2.jpg" alt="ad" class="img-fluid">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Top Story Area End Here -->

<!-- Latest News Area Start Here -->
<section class="bg-secondary-accent section-space-less30">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="topic-border color-scampi mb-30 width-100">
                    <div class="topic-box-lg color-scampi">Sering Dilihat</div>
                </div>
            </div>
        </div>
        <div class="ne-carousel nav-control-top2 color-scampi" data-loop="true" data-items="4" data-margin="20" data-autoplay="true"
            data-autoplay-timeout="5000" data-smart-speed="2000" data-dots="false" data-nav="true" data-nav-speed="false"
            data-r-x-small="1" data-r-x-small-nav="true" data-r-x-small-dots="false" data-r-x-medium="2" data-r-x-medium-nav="true"
            data-r-x-medium-dots="false" data-r-small="2" data-r-small-nav="true" data-r-small-dots="false" data-r-medium="3"
            data-r-medium-nav="true" data-r-medium-dots="false" data-r-Large="4" data-r-Large-nav="true" data-r-Large-dots="false">

            @foreach ($most_views as $news)
              <div class="hover-show-play-btn item-shadow-gray mb-30">
                  <div class="img-overlay-70">
                      <img src="{{$news->news_img}}" alt="news" class="img-fluid width-100" height="122">
                  </div>
                  <div class="box-padding30 bg-body item-shadow-gray">
                      <div class="post-date-dark">
                          <ul>
                              <li>
                                  <span>
                                      <i class="fa fa-calendar" aria-hidden="true"></i>
                                  </span>{{date("m-d-Y",strtotime($news->created_at))}}</li>
                          </ul>
                      </div>
                      <h3 class="title-medium-dark">
                          <a href="{{ route('news.detail', $news->news_slug) }}" class="top_stories">{{$news->news_title}}</a>
                      </h3>
                  </div>
              </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Latest News Area End Here -->      
<!-- More News Area Start Here -->
<section class="bg-accent section-space-less30">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="ne-isotope">
                    <div class="topic-border color-azure-radiance mb-30">
                        <div class="topic-box-lg color-azure-radiance">More News</div>
                        <div class="more-info-link">
                            <a href="post-style-1.html">More
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                    <div class="featuredContainer">
                          <div class="row">
                              @foreach ($suggestions as $suggestion)
                              <div class="col-md-12 col-sm-6 col-12 mb-30">
                                  <div class="media item-shadow-gray bg-body media-none--sm">
                                      <div class="position-relative width-36 width43-lg">
                                          <a href="{{ route('news.detail',$suggestion->news_slug ) }}" class="img-opacity-hover img-overlay-70">
                                              <img src="{{$suggestion->news_img}}" alt="news" class="img-fluid">
                                          </a>
                                          <div class="topic-box-top-xs">
                                              <div class="topic-box-sm color-cod-gray mb-20">{{$suggestion->news_categories_name}}</div>
                                          </div>
                                      </div>
                                      <div class="media-body media-padding30 p-mb-none-child">
                                          <div class="post-date-dark">
                                              <ul>
                                                  <li>
                                                      <span>by</span>
                                                      <a href="{{ route('news.detail',$suggestion->news_slug ) }}">{{$suggestion->name}}</a>
                                                  </li>
                                                  <li>
                                                      <span>
                                                          <i class="fa fa-calendar" aria-hidden="true"></i>
                                                      </span>{{date("m-d-Y",strtotime($suggestion->created_at))}}</li>
                                              </ul>
                                          </div>
                                          <h3 class="title-semibold-dark size-lg mb-15">
                                              <a href="{{ route('news.detail', $suggestion->news_slug) }}">{{$suggestion->news_title}}</a>
                                          </h3>
                                          <div class="top_stories">{!!$suggestion->news_content!!}</div>
                                      </div>
                                  </div>
                              </div> 
                              @endforeach
                          </div>
                    </div>
                </div>
            </div>
            <div class="ne-sidebar sidebar-break-md col-lg-4 col-md-12">
                <div class="sidebar-box">
                    <div class="topic-border color-cod-gray mb-30">
                        <div class="topic-box-lg color-cod-gray">Latest News</div>
                    </div>

                    @foreach ($latest_news as $news)
                      <div class="d-inline-block">
                          <div class="media mb30-list bg-body">
                              <a class="img-opacity-hover" href="{{ route('news.detail', $news->news_slug) }}">
                                  <img src="{{$news->news_img}}" width="100" height="108" alt="news" class="img-fluid">
                              </a>
                              <div class="media-body media-padding15">
                                  <div class="post-date-dark">
                                      <ul>
                                          <li>
                                              <span>
                                                  <i class="fa fa-calendar" aria-hidden="true"></i>
                                              </span>{{date("m-d-Y",strtotime($news->created_at))}}</li>
                                      </ul>
                                  </div>
                                  <h3 class="title-medium-dark mb-none">
                                      <a href="{{ route('news.detail', $news->news_slug) }}">{{$news->news_title}}</a>
                                  </h3>
                              </div>
                          </div>
                      </div>
                    @endforeach
                </div>
                <div class="sidebar-box">
                    <div class="topic-border color-cod-gray mb-30">
                        <div class="topic-box-lg color-cod-gray">Video Stream</div>
                    </div>
                    <div class="newsletter-area bg-primary">
                        <h2 class="title-medium-light size-xl line-height-custom">Subscribe to our mailing list to get the new updates!</h2>
                        <img src="public/template/front/img/banner/newsletter.png" alt="newsletter" class="img-fluid mb-10">
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
<!-- More News Area End Here -->
@endsection
