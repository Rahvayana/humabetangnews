  <!-- ##### Viral News Breadcumb Area Start ##### -->
  <div class="viral-news-breadcumb-area section-padding-50">
    <div class="container h-100">
        <div class="row h-100 align-items-center">

            <!-- Breadcumb Area -->
            <div class="col-12 col-md-4">
                <h3>Berita</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{url('berita/kategori/'.$news->category->news_categories_slug)}}">{{$news->category->news_categories_name}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Berita</li>
                    </ol>
                </nav>
            </div>

            @php($ads = Helper::getAds())
            <!-- Add Widget -->
            <div class="col-12 col-md-8">
                <div class="add-widget">
                    <a href="{{$ads->ads_link}}"><img class="lazyload" data-src="{{asset($ads->ads_img_landscape)}}" alt=""></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Viral News Breadcumb Area End ##### -->
