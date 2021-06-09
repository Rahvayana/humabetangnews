@extends('layouts.theme')

@section('breadcrumb')

    <li class="breadcrumb-item">
        <a href="{{url('/dashboard')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{url('/dashboard/slideshow')}}">All Slideshow</a>
    </li>
    <li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
    @include('common.breadcrum_menu')
      <div class="container-fluid">
        <div class="animated fadeIn">

          <!-- /.row-->
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">Detail Slideshow
                  <div class="small text-muted  mt-2">{{Helper::ubahDBKeTanggalwaktu($news->news_publish_datetime)}}</div>

                </div>

                <div class="card-body">

                    <div classs="row text-center">
                      <div class="col-12 text-center">


                        <a href="{{ URL::asset($news->news_img) }}" class="image-link">
                          <img src="{{ URL::to($news->news_img) }}" width="300px">
                        </a>
                    </div>
                    
                    <div class="divider"></div>


                    <h5>{{$news->news_title}}</h5>

                    <div class="divider"></div>

                    {!! $news->news_content !!}
                        
                </div>
              </div>
            </div>
            <!-- /.col-->
          </div>
          <!-- /.row-->
        </div>
      </div>

@endsection



@section('page-js-script')
<script>


</script>
@endsection