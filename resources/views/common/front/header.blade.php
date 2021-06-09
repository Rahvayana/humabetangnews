<header class="header-area">

    <!-- Top Header Area -->
    <div class="top-header-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="top-header-content d-flex align-items-center justify-content-between">
                        <!-- Breaking News Area -->
                        <div class="top-breaking-news-area">
                            <div id="breakingNewsTicker" class="ticker">
                            @php($marque = \App\MasterTextMarque::all())

                                <ul>
                                    @foreach($marque as $marq)
                                    <li><a href="#">{{$marq->text}}</a></li>

                                    @endforeach

                                </ul>
                            </div>
                        </div>

                        <!-- Social Info Area-->
                        <div class="top-social-info-area">
                            @php($socialmedia = \App\MasterSocialMedia::all())

                            @foreach($socialmedia as $soc)
                                 <a href="#" onclick="window.open('{{$soc->link}}', '_blank')"><i class="{{$soc->logo}}" aria-hidden="true"></i></a>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar Area -->
    <div class="viral-news-main-menu" id="stickyMenu">
        <div class="classy-nav-container breakpoint-off">
            <div class="container">
                <!-- Menu -->
                <nav class="classy-navbar justify-content-between" id="viralnewsNav">

                    <!-- Logo -->
                    <a class="nav-brand" href="{{url('/')}}"><img data-src="{{asset($config->logo)}}" class="lazyload" alt="Logo"></a>

                    <!-- Navbar Toggler -->
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>

                    <!-- Menu -->
                    <div class="classy-menu">

                        <!-- close btn -->
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>


                        @php($category = \App\NewsCategory::where('news_categories_status_delete', 0)->orderBy('news_categories_order', 'asc')->get())

                        <!-- Nav Start -->
                        <div class="classynav">



                                @php($kategori="")
                                @php($top="")
                                @php($tv="")
                                @php($video="")

                            @if(Request::is('top-10'))
                                @php($top="active")
                            @elseif(Request::is('berita/kategori/*'))
                                @php($kategori="active")
                            @elseif(Request::is('tv-online'))
                                @php($tv="active")
                            @elseif(Request::is('video'))
                                @php($video="active")
                            @endif
                            <ul>
                                <li class="{{$top}}"><a href="{{url('/top-10')}}">Top 10</a></li>
                                <li class="{{$kategori}}"><a href="#">Kategori</a>
                                    <ul class="dropdown">
                                        @foreach($category as $cat)
                                            <li><a href="{{url('berita/kategori/'. $cat->news_categories_slug)}}">{{$cat->news_categories_name}}</a></li>
                                        @endforeach

                                        {{-- <li><a href="#">Dropdown</a>
                                            <ul class="dropdown">
                                                <li><a href="index.html">Home</a></li>
                                                <li><a href="catagory.html">Catagories</a></li>
                                                <li><a href="single-post.html">Single Article</a></li>
                                                <li><a href="quize-article.html">Quize Article</a></li>
                                                <li><a href="contact.html">Contact</a></li>
                                            </ul>
                                        </li> --}}
                                    </ul>
                                </li>
                                <li class="{{$tv}}"><a href="{{url('/tv-online')}}">TV Online</a></li>
                                <li class="{{$video}}"><a href="{{url('/video')}}">Video</a></li>
                                {{-- <li><a href="index.html">Don’t Miss</a></li> --}}

                            </ul>

                            <!-- Search Button -->
                            <div class="search-btn">
                                <i id="searchbtn" class="fa fa-search" aria-hidden="true"></i>
                            </div>

                            @php($user = Auth::user())

                            {{-- @if(session()->has('success'))
                            <div class="col-md-12 alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                            @endif

                            @if(session()->has('error'))
                            <div class="col-md-12 alert alert-danger">
                                {{ session()->get('error') }}
                            </div>
                            @endif --}}

                            {{-- {{Auth::user()}} --}}
                            {{-- Auth::guard('api')->check(); --}}

                            @if(Auth::guard('web')->check())
                                {{-- <img class="avatar avatar-32 img-circle" src="{{$user->picture}}"/> --}}


                                <div class="avatar-wrapper sn-ad-avatar-wrapper px-2 py-2 text-center">
                                    <a href="#">
                                        <img src="{{asset(Auth::user()->picture)}}" class="avatar-header-img">
                                    </a>
                                </div>

                            @else
                                <div class="login-btn login">
                                    <i id="loginbtn" class="fa fa-user"></i>
                                </div>
                            @endif

                            <!-- Search Button -->


                            <!-- Search Form -->
                            <div class="viral-search-form">
                                <form id="search" action="#" method="get">
                                    <input type="text" name="search-terms" placeholder="Masukkan kata kunci ...">
                                    <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </form>
                            </div>

                            <!-- Video Post Button -->
<!--                                 <div class="add-post-button">
                                <a href="#" class="btn add-post-btn">Add Post</a>
                            </div> -->

                        </div>
                        <!-- Nav End -->
                    </div>
                </nav>
            </div>
        </div>
    </div>


    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title" id="myModalLabel">More About Joe</h4>
                    </div>
                <div class="modal-body">
                    <center>
                    <img src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcRbezqZpEuwGSvitKy3wrwnth5kysKdRqBW54cAszm_wiutku3R" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>
                    <h3 class="media-heading">Joe Sixpack <small>USA</small></h3>
                    <span><strong>Skills: </strong></span>
                        <span class="label label-warning">HTML5/CSS</span>
                        <span class="label label-info">Adobe CS 5.5</span>
                        <span class="label label-info">Microsoft Office</span>
                        <span class="label label-success">Windows XP, Vista, 7</span>
                    </center>
                    <hr>
                    <center>
                    <p class="text-left"><strong>Bio: </strong><br>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut sem dui, tempor sit amet commodo a, vulputate vel tellus.</p>
                    <br>
                    </center>
                </div>
                <div class="modal-footer">
                    <center>
                    <button type="button" class="btn btn-default" data-dismiss="modal">I've heard enough about Joe</button>
                    </center>
                </div>
            </div>
        </div>
    </div>
</header>
