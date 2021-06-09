<!DOCTYPE html>
<html lang="en">

<head>
    @php($config = \App\ConfigApp::first())
  <!-- <base href="./admin"> -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">




  @if(Request::is('berita/*'))

  <title>{{$news->news_title}}</title>


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

  <title>{{$config->web_app_name}}</title>


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
  <link rel="stylesheet" href="{{asset('public/template/front/style.css')}}">
  <link rel="stylesheet" href="{{asset('public/css/responsive.css')}}">

  <link rel="stylesheet" href="{{asset('public/template/front/css/custom.css')}}">

  @if(Request::is('tv-online'))
    {{-- <link href="https://vjs.zencdn.net/7.2.3/video-js.css" rel="stylesheet"> --}}
  @endif
  {{-- <link href="https://unpkg.com/video.js/dist/video-js.css" rel="stylesheet">
  <script src="https://unpkg.com/video.js/dist/video.js"></script>
  <script src="https://unpkg.com/videojs-contrib-hls/dist/videojs-contrib-hls.js"></script> --}}

</head>

<body>
{{-- <!-- modal login -->
<div class="text-center">
	<!-- Button HTML (to Trigger Modal) -->
	<a href="#myModal" class="trigger-btn" data-toggle="modal">Click to Open Login Modal</a>
</div>

<!-- Modal HTML -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog modal-login">
		<div class="modal-content">
			<div class="modal-header">
				<div class="avatar">
                    <img class="py-3" data-src="{{asset($config->logo)}}" class="lazyload" alt="Logo">
				</div>
				<h4 class="modal-title">Member Login</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<form action="/examples/actions/confirmation.php" method="post">
					<div class="form-group">
                        <a href="#" class="btn btn-danger btn-block pt-2"><i class="fa fa-google"></i> Sign in with <b>Google</b></a>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<a href="#">Forgot Password?</a>
			</div>
		</div>
	</div>
</div> --}}

    <form id="login-auth" action="{{url('/login-auth')}}" method="post">
        @csrf

        <div class="form-group">
            <input id="authtoken" type="hidden" value="" name="token" >
            <input id="uid" type="hidden" value="" name="uid" >
            <input id="providerId" type="hidden" value="" name="providerId" >
            <input id="email" type="hidden" value="" name="email" >
            <input id="picture" type="hidden" value="" name="picture" >
            <input id="username" type="hidden" value="" name="username" >
            {{-- <input id="exp" type="hidden" value="" name="exp" > --}}

        </div>
    </form>

    <!-- ##### Header Area Start ##### -->

    @include('common.front.header')


    <!-- ##### Header Area End ##### -->

    <!-- ##### Hero Area Start ##### -->



    @if(Request::url() === url('/'))
        @include('common.front.hero')
    @else
        @yield('breadcrumb')
        {{-- @include('common.front.breadcrumb') --}}

    @endif



    <!-- ##### Hero Area End ##### -->

    <!-- ##### Welcome Slide Area Start ##### -->

    @if(Request::url() === url('/'))
        @include('common.front.slider')
    @endif
    <!-- ##### Welcome Slide Area End ##### -->

    <!-- ##### Blog Post Area Start ##### -->
        @yield('content')

    <!-- ##### Blog Post Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    @include('common.front.footer')

    <!-- ##### Footer Area Start ##### -->

    <!-- ##### All Javascript Files ##### -->
    <!-- jQuery-2.2.4 js -->
    <script src="{{asset('public/template/front/js/jquery/jquery-2.2.4.min.js')}}"></script>
    <!-- Popper js -->
    <script src="{{asset('public/template/front/js/bootstrap/popper.min.js')}}"></script>
    <!-- Bootstrap js -->
    <script src="{{asset('public/template/front/js/bootstrap/bootstrap.min.js')}}"></script>
    <!-- All Plugins js -->
    <script src="{{asset('public/template/front/js/plugins/plugins.js')}}"></script>
    <!-- Active js -->
    <script src="{{asset('public/template/front/js/active.js')}}"></script>

    <script src="{{URL::asset('public/template/front/js/lazysizes.min.js')}}"></script>

    <!-- The core Firebase JS SDK is always required and must be listed first -->
<script defer src="https://www.gstatic.com/firebasejs/7.16.0/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
    <script defer src="https://www.gstatic.com/firebasejs/7.16.0/firebase-auth.js"></script>
<script defer src="https://www.gstatic.com/firebasejs/7.16.0/firebase-analytics.js"></script>

<script defer src="{{asset('public/template/front/js/init-firebase.js')}}"></script>

@if(Request::is('tv-online'))
    {{-- <script src="https://vjs.zencdn.net/ie8/ie8-version/videojs-ie8.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-contrib-hls/5.14.1/videojs-contrib-hls.js"></script>
    <script src="https://vjs.zencdn.net/7.2.3/video.js"></script> --}}

    <script src="{{asset('js/hls.min.js')}}"></script>

@endif

@yield('js')



</body>

</html>
