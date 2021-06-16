<!DOCTYPE html>
<html lang="en">

<head>
    @php($config = \App\ConfigApp::first())
  <!-- <base href="./admin"> -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

  @if(Request::is('berita/*'))

  <title>Huma Betang</title>


  <meta name="description" content="{{ Str::limit(strip_tags($news->news_content), 150, '...') }}">
  <meta name="author" content="{{$config->authors_meta}}">


  <meta property="og:title" content="{{$news->news_title}}">
  <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
 <link rel="canonical" href="{{url('').\Request::getRequestUri()}}" />
  <meta property="og:description" content="{{ Str::limit(strip_tags($news->news_content), 150, '...') }}">
  <meta property="og:url" content="{{url('').\Request::getRequestUri()}}" />
  <meta property="og:image" itemprop="image" content="{{asset($news->news_img)}}">
  <meta property="og:image:secure_url" content="{{asset($news->news_img)}}">
  <meta property="og:image:url"content="{{asset($news->news_img)}}" />
  <meta name='keywords' content='{{$news->category->new_categories_name}}, palangkaraya, berita, kalimantan, jurnal tv' />
  <meta property='article:published_time' content='{{$news->created_at}}' />
<meta property='article:section' content='news' />
  <meta property="og:image:size"content="300" />
  <meta property="og:type" content="website" />
  <meta property='og:locale' content='id_ID' />
  <meta property="og:site_name"content="humabetang.com" />
  <link rel="icon" type="image/png" href="{{asset('').$config->logo}}" sizes="any" />


  <meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:description" content="{{ Str::limit(strip_tags($news->news_content), 150, '...') }}" />
<meta name="twitter:title" content="{{$news->news_title}}" />
<meta name="twitter:image" content="{{asset($news->news_img)}}" />
  @else

  <title>{{$news->web_app_name}}</title>


  <meta name="description" content="{{$config->description_meta}}">
  <meta name="author" content="{{$config->authors_meta}}">
  <meta name="keyword" content="{{$config->keyword_meta}}">

  <meta property="og:title" content="{{$config->web_app_name}}">
  <meta property="og:description" content="{{$config->description_meta}}">
  <meta property="og:image" itemprop="image" content="{{asset('').$config->logo}}">
  <meta property="og:image:width" content="300">
  <meta property="og:image:height" content="300">
  <meta property="og:image:secure_url" content="Humabetang.com">
  <meta property='og:locale' content='id_ID' />
  <meta property="og:type" content="website" />
  <link rel="icon" type="image/png" href="{{asset('').$config->logo}}" sizes="any" />
  @endif




  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Core Stylesheet -->
  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="/public/template/front/img/favicon.png">
  <!-- Normalize CSS -->
  <link rel="stylesheet" href={{asset("public/template/front/css/normalize.css")}}>
  <!-- Main CSS -->
  <link rel="stylesheet" href={{asset("public/template/front/css/main.css")}}>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href={{asset("public/template/front/css/bootstrap.min.css")}}>
  <!-- Animate CSS -->
  <link rel="stylesheet" href={{asset("public/template/front/css/animate.min.css")}}>
  <!-- Font-awesome CSS-->
  <link rel="stylesheet" href={{asset("public/template/front/css/font-awesome.min.css")}}>
  <!-- Owl Caousel CSS -->
  <link rel="stylesheet" href={{asset("public/template/front/vendor/OwlCarousel/owl.carousel.min.css")}}>
  <link rel="stylesheet" href={{asset("public/template/front/vendor/OwlCarousel/owl.theme.default.min.css")}}>
  <!-- Main Menu CSS -->
  <link rel="stylesheet" href={{asset("public/template/front/css/meanmenu.min.css")}}>
  <!-- Magnific CSS -->
  <link rel="stylesheet" href={{asset("public/template/front/css/magnific-popup.css")}}>
  <!-- Switch Style CSS -->
  <link rel="stylesheet" href={{asset("public/template/front/css/hover-min.css")}}>
  <!-- Custom CSS -->
  <link rel="stylesheet" href={{asset("public/template/front/style.css")}}>
  <!-- For IE -->
  <link rel="stylesheet" href={{asset("public/template/front/css/ie-only.css")}} />
  @yield('css')
  <style>
      .top_stories{
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2; /* number of lines to show */
        -webkit-box-orient: vertical;
    }.media.bg-body.item-shadow-gray.mb-30 {
        align-items: center;
    }.media.mb30-list.bg-body {
        align-items: center;
    }.media.item-shadow-gray.bg-body.media-none--sm {
        align-items: center;
    }
  </style>
  <!-- Modernizr Js -->
  <script src="js/modernizr-2.8.3.min.js"></script>

  @if(Request::is('tv-online'))
    {{-- <link href="https://vjs.zencdn.net/7.2.3/video-js.css" rel="stylesheet"> --}}
  @endif
  {{-- <link href="https://unpkg.com/video.js/dist/video-js.css" rel="stylesheet">
  <script src="https://unpkg.com/video.js/dist/video.js"></script>
  <script src="https://unpkg.com/videojs-contrib-hls/dist/videojs-contrib-hls.js"></script> --}}

</head>

<body>
  <div id="preloader"></div>
  <!-- Preloader End Here -->
  <div id="wrapper">
      <!-- Header Area Start Here -->
      <header>
          <div id="header-layout2" class="header-style2">
              <div class="header-top-bar">
                  <div class="top-bar-top bg-accent border-bottom">
                      <div class="container">
                          <div class="row">
                              <div class="col-lg-8 col-md-12">
                                  
                              </div>
                              <div class="col-lg-4 d-none d-lg-block">
                                  <ul class="header-social">
                                      <li>
                                          <a href="#" title="facebook">
                                              <i class="fa fa-facebook" aria-hidden="true"></i>
                                          </a>
                                      </li>
                                      <li>
                                          <a href="#" title="twitter">
                                              <i class="fa fa-twitter" aria-hidden="true"></i>
                                          </a>
                                      </li>
                                      <li>
                                          <a href="#" title="google-plus">
                                              <i class="fa fa-google-plus" aria-hidden="true"></i>
                                          </a>
                                      </li>
                                      <li>
                                          <a href="#" title="linkedin">
                                              <i class="fa fa-linkedin" aria-hidden="true"></i>
                                          </a>
                                      </li>
                                      <li>
                                          <a href="#" title="pinterest">
                                              <i class="fa fa-pinterest" aria-hidden="true"></i>
                                          </a>
                                      </li>
                                      <li>
                                          <a href="#" title="rss">
                                              <i class="fa fa-rss" aria-hidden="true"></i>
                                          </a>
                                      </li>
                                      <li>
                                          <a href="#" title="vimeo">
                                              <i class="fa fa-vimeo" aria-hidden="true"></i>
                                          </a>
                                      </li>
                                  </ul>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="top-bar-bottom bg-body pt-20 d-none d-lg-block">
                      <div class="container">
                          <div class="row d-flex align-items-center">
                              <div class="col-lg-4 col-md-4 col-sm-4">
                                  <div class="logo-area">
                                      <a href="index.html" class="img-fluid">
                                          <img src="/public/template/front/img/logo_news.png" width="180" alt="logo">
                                      </a>
                                  </div>
                              </div>
                              <div class="col-lg-8 col-md-8 col-sm-8">
                                  <div class="ne-banner-layout1 pull-right">
                                      <a href="#">
                                          <img src="/public/template/front/img/banner/banner2.jpg" alt="ad" class="img-fluid">
                                      </a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="main-menu-area bg-body" id="sticker">
                  <div class="container">
                      <div class="row no-gutters d-flex align-items-center">
                          <div class="col-lg-10 position-static d-none d-lg-block">
                              <div class="ne-main-menu">
                                  <nav id="dropdown">
                                      <ul>
                                          <li class="active">
                                              <a href="{{ route('home') }}">Home</a>
                                          </li>
                                          <li>
                                              <a href="#">Post</a>
                                          </li>
                                          <li>
                                              <a href="#">Top 10</a>
                                          </li>
                                          @foreach ($categories as $category)
                                          <li>
                                              <a href="{{ route('news.category.list', $category['news_categories_slug']) }}">{{$category['news_categories_name']}}</a>
                                          </li>
                                          @endforeach
                                          <li class=""><a href="{{url('/tv-online')}}">TV Online</a></li>
                                          <li class=""><a href="{{url('/video')}}">Video</a></li>
                                      </ul>
                                  </nav>
                              </div>
                          </div>
                          <div class="col-lg-2 col-md-12 text-right position-static">
                              <div class="header-action-item on-mobile-fixed">
                                  <ul>
                                      <li>
                                          <form id="top-search-form" class="header-search-light">
                                              <input type="text" class="search-input" placeholder="Search...." required="" style="display: none;">
                                              <button class="search-button">
                                                  <i class="fa fa-search" aria-hidden="true"></i>
                                              </button>
                                          </form>
                                      </li>
                                      <li class="d-none d-sm-block d-md-block d-lg-none">
                                          <button type="button" class="login-btn" data-toggle="modal" data-target="#myModal">
                                              <i class="fa fa-user" aria-hidden="true"></i>Sign in
                                          </button>
                                      </li>
                                      <li>
                                          <div id="side-menu-trigger" class="offcanvas-menu-btn offcanvas-btn-repoint">
                                              <a href="#" class="menu-bar">
                                                  <span></span>
                                                  <span></span>
                                                  <span></span>
                                              </a>
                                              <a href="#" class="menu-times close">
                                                  <span></span>
                                                  <span></span>
                                              </a>
                                          </div>
                                      </li>
                                  </ul>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </header>
      <!-- Header Area End Here -->
      @yield('content')
      <!-- Footer Area Start Here -->
      <footer>
          <div class="footer-area-top">
              <div class="container">
                  <div class="row">
                      <div class="col-lg-4 col-md-6 col-sm-12">
                          <div class="footer-box">
                              <h2 class="title-bold-light title-bar-left text-uppercase">Most Viewed Posts</h2>
                              <ul class="most-view-post">
                                  <li>
                                      <div class="media">
                                          <a href="post-style-1.html">
                                              <img src="/public/template/front/img/footer/post1.jpg" alt="post" class="img-fluid">
                                          </a>
                                          <div class="media-body">
                                              <h3 class="title-medium-light size-md mb-10">
                                                  <a href="#">Basketball Stars Face Off itim ate Playoff Beard Battle</a>
                                              </h3>
                                              <div class="post-date-light">
                                                  <ul>
                                                      <li>
                                                          <span>
                                                              <i class="fa fa-calendar" aria-hidden="true"></i>
                                                          </span>November 11, 2017</li>
                                                  </ul>
                                              </div>
                                          </div>
                                      </div>
                                  </li>
                                  <li>
                                      <div class="media">
                                          <a href="post-style-2.html">
                                              <img src="/public/template/front/img/footer/post2.jpg" alt="post" class="img-fluid">
                                          </a>
                                          <div class="media-body">
                                              <h3 class="title-medium-light size-md mb-10">
                                                  <a href="#">Basketball Stars Face Off in ate Playoff Beard Battle</a>
                                              </h3>
                                              <div class="post-date-light">
                                                  <ul>
                                                      <li>
                                                          <span>
                                                              <i class="fa fa-calendar" aria-hidden="true"></i>
                                                          </span>August 22, 2017</li>
                                                  </ul>
                                              </div>
                                          </div>
                                      </div>
                                  </li>
                                  <li>
                                      <div class="media">
                                          <a href="post-style-3.html">
                                              <img src="/public/template/front/img/footer/post3.jpg" alt="post" class="img-fluid">
                                          </a>
                                          <div class="media-body">
                                              <h3 class="title-medium-light size-md mb-10">
                                                  <a href="#">Basketball Stars Face tim ate Playoff Battle</a>
                                              </h3>
                                              <div class="post-date-light">
                                                  <ul>
                                                      <li>
                                                          <span>
                                                              <i class="fa fa-calendar" aria-hidden="true"></i>
                                                          </span>March 31, 2017</li>
                                                  </ul>
                                              </div>
                                          </div>
                                      </div>
                                  </li>
                              </ul>
                          </div>
                      </div>
                      <div class="col-xl-4 col-lg-3 col-md-6 col-sm-12">
                          <div class="footer-box">
                              <h2 class="title-bold-light title-bar-left text-uppercase">Popular Categories</h2>
                              <ul class="popular-categories">
                                  <li>
                                      <a href="#">Gadgets
                                          <span>15</span>
                                      </a>
                                  </li>
                                  <li>
                                      <a href="#">Architecture
                                          <span>10</span>
                                      </a>
                                  </li>
                                  <li>
                                      <a href="#">New look 2017
                                          <span>14</span>
                                      </a>
                                  </li>
                                  <li>
                                      <a href="#">Reviews
                                          <span>13</span>
                                      </a>
                                  </li>
                                  <li>
                                      <a href="#">Mobile and Phones
                                          <span>19</span>
                                      </a>
                                  </li>
                                  <li>
                                      <a href="#">Recipes
                                          <span>26</span>
                                      </a>
                                  </li>
                                  <li>
                                      <a href="#">Decorating
                                          <span>21</span>
                                      </a>
                                  </li>
                                  <li>
                                      <a href="#">IStreet fashion
                                          <span>09</span>
                                      </a>
                                  </li>
                              </ul>
                          </div>
                      </div>
                      <div class="col-xl-4 col-lg-5 col-md-12 col-sm-12">
                          <div class="footer-box">
                              <h2 class="title-bold-light title-bar-left text-uppercase">Post Gallery</h2>
                              <div class="newsletter-area bg-primary">
                                <h2 class="title-medium-light size-xl line-height-custom">Subscribe to our mailing list to get the new updates!</h2>
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
          </div>
          <div class="footer-area-bottom">
              <div class="container">
                  <div class="row">
                      <div class="col-12 text-center">
                          <a href="index.html" class="footer-logo img-fluid">
                              <img src="/public/template/front/img/google-play-badge.png" alt="logo" class="img-fluid" width="15%">
                          </a>
                          <a href="index.html" class="footer-logo img-fluid">
                              <img src="/public/template/front/img/appstore.png" alt="logo" class="img-fluid" width="15%">
                          </a>
                          
                          <p>© {{date('Y')}} Designed by HumaBetang. All Rights Reserved</p>
                      </div>
                  </div>
              </div>
          </div>
      </footer>
      <!-- Footer Area End Here -->
      <!-- Modal Start-->
      <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <div class="title-login-form">Login</div>
                  </div>
                  <div class="modal-body">
                      <div class="login-form">
                          <form>
                              <label>Username or email address *</label>
                              <input type="text" placeholder="Name or E-mail" />
                              <label>Password *</label>
                              <input type="password" placeholder="Password" />
                              <div class="checkbox checkbox-primary">
                                  <input id="checkbox" type="checkbox" checked>
                                  <label for="checkbox">Remember Me</label>
                              </div>
                              <button type="submit" value="Login">Login</button>
                              <button class="form-cancel" type="submit" value="">Cancel</button>
                              <label class="lost-password">
                                  <a href="#">Lost your password?</a>
                              </label>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- Modal End-->
      <!-- Offcanvas Menu Start -->
      <div id="offcanvas-body-wrapper" class="offcanvas-body-wrapper">
          <div id="offcanvas-nav-close" class="offcanvas-nav-close offcanvas-menu-btn">
              <a href="#" class="menu-times re-point">
                  <span></span>
                  <span></span>
              </a>
          </div>
          <div class="offcanvas-main-body">
              <ul id="accordion" class="offcanvas-nav panel-group">
                  <li class="panel panel-default">
                      <div class="panel-heading">
                          <a aria-expanded="false" class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                              <i class="fa fa-home" aria-hidden="true"></i>Home Pages</a>
                      </div>
                      <div aria-expanded="false" id="collapseOne" role="tabpanel" class="panel-collapse collapse">
                          <div class="panel-body">
                              <ul class="offcanvas-sub-nav">
                                  <li>
                                      <a href="index.html">Home 1</a>
                                  </li>
                                  <li>
                                      <a href="index2.html">Home 2</a>
                                  </li>
                                  <li>
                                      <a href="index3.html">Home 3</a>
                                  </li>
                                  <li>
                                      <a href="index4.html">Home 4</a>
                                  </li>
                                  <li>
                                      <a href="index5.html">Home 5</a>
                                  </li>
                                  <li>
                                      <a href="index6.html">Home 6</a>
                                  </li>
                                  <li>
                                      <a href="index7.html">Home 7</a>
                                  </li>
                                  <li>
                                      <a href="index8.html">Home 8</a>
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </li>
                  <li>
                      <a href="author-post.html">
                          <i class="fa fa-user" aria-hidden="true"></i>Author Post Page</a>
                  </li>
                  <li class="panel panel-default">
                      <div class="panel-heading">
                          <a aria-expanded="false" class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                              <i class="fa fa-file-text" aria-hidden="true"></i>Post Pages</a>
                      </div>
                      <div aria-expanded="false" id="collapseTwo" role="tabpanel" class="panel-collapse collapse">
                          <div class="panel-body">
                              <ul class="offcanvas-sub-nav">
                                  <li>
                                      <a href="post-style-1.html">Post Style 1</a>
                                  </li>
                                  <li>
                                      <a href="post-style-2.html">Post Style 2</a>
                                  </li>
                                  <li>
                                      <a href="post-style-3.html">Post Style 3</a>
                                  </li>
                                  <li>
                                      <a href="post-style-4.html">Post Style 4</a>
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </li>
                  <li class="panel panel-default">
                      <div class="panel-heading">
                          <a aria-expanded="false" class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                              <i class="fa fa-info-circle" aria-hidden="true"></i>News Details Pages</a>
                      </div>
                      <div aria-expanded="false" id="collapseThree" role="tabpanel" class="panel-collapse collapse">
                          <div class="panel-body">
                              <ul class="offcanvas-sub-nav">
                                  <li>
                                      <a href="single-news-1.html">News Details 1</a>
                                  </li>
                                  <li>
                                      <a href="single-news-2.html">News Details 2</a>
                                  </li>
                                  <li>
                                      <a href="single-news-3.html">News Details 3</a>
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </li>
                  <li>
                      <a href="archive.html">
                          <i class="fa fa-archive" aria-hidden="true"></i>Archive Page</a>
                  </li>
                  <li class="panel panel-default">
                      <div class="panel-heading">
                          <a aria-expanded="false" class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                              <i class="fa fa-picture-o" aria-hidden="true"></i>Gallery Pages</a>
                      </div>
                      <div aria-expanded="false" id="collapseFour" role="tabpanel" class="panel-collapse collapse">
                          <div class="panel-body">
                              <ul class="offcanvas-sub-nav">
                                  <li>
                                      <a href="gallery-style-1.html">Gallery Style 1</a>
                                  </li>
                                  <li>
                                      <a href="gallery-style-2.html">Gallery Style 2</a>
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </li>
                  <li>
                      <a href="404.html">
                          <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>404 Error Page</a>
                  </li>
                  <li>
                      <a href="contact.html">
                          <i class="fa fa-phone" aria-hidden="true"></i>Contact Page</a>
                  </li>
              </ul>
          </div>
      </div>
      <!-- Offcanvas Menu End -->
  </div>
</body>
    <!-- jquery-->
        <script src={{asset("public/template/front/js/jquery-2.2.4.min.js ")}} type="text/javascript"></script>
        <!-- Plugins js -->
        <script src={{asset("public/template/front/js/plugins.js ")}} type="text/javascript"></script>
        <!-- Popper js -->
        <script src={{asset("public/template/front/js/popper.js ")}} type="text/javascript"></script>
        <!-- Bootstrap js -->
        <script src={{asset("public/template/front/js/bootstrap.min.js ")}} type="text/javascript"></script>
        <!-- WOW JS -->
        <script src={{asset("public/template/front/js/wow.min.js")}}></script>
        <!-- Owl Cauosel JS -->
        <script src={{asset("public/template/front/vendor/OwlCarousel/owl.carousel.min.js ")}} type="text/javascript"></script>
        <!-- Meanmenu Js -->
        <script src={{asset("public/template/front/js/jquery.meanmenu.min.js")}} type="text/javascript"></script>
        <!-- Srollup js -->
        <script src={{asset("public/template/front/js/jquery.scrollUp.min.js ")}} type="text/javascript"></script>
        <!-- jquery.counterup js -->
        <script src={{asset("public/template/front/js/jquery.counterup.min.js")}}></script>
        <script src={{asset("public/template/front/js/waypoints.min.js")}}></script>
        <!-- Isotope js -->
        <script src={{asset("public/template/front/js/isotope.pkgd.min.js ")}} type="text/javascript"></script>
        <!-- Magnific Popup -->
        <script src={{asset("public/template/front/js/jquery.magnific-popup.min.js")}}></script>
        <!-- Ticker Js -->
        <script src={{asset("public/template/front/js/ticker.js ")}} type="text/javascript"></script>
        <!-- Custom Js -->
        <script src={{asset("public/template/front/js/main.js ")}} type="text/javascript"></script>

    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script defer src="https://www.gstatic.com/firebasejs/7.16.0/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
    <script defer src="https://www.gstatic.com/firebasejs/7.16.0/firebase-auth.js"></script>
    <script defer src="https://www.gstatic.com/firebasejs/7.16.0/firebase-analytics.js"></script>

    <script defer src="{{asset('/public/template/front/js/init-firebase.js')}}"></script>

@if(Request::is('tv-online'))
    {{-- <script src="https://vjs.zencdn.net/ie8/ie8-version/videojs-ie8.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-contrib-hls/5.14.1/videojs-contrib-hls.js"></script>
    <script src="https://vjs.zencdn.net/7.2.3/video.js"></script> --}}

    <script src="{{asset('js/hls.min.js')}}"></script>

@endif

@yield('js')

</html>
