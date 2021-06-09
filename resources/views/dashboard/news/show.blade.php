@extends('layouts.theme')

@section('breadcrumb')

    <li class="breadcrumb-item">
        <a href="{{url('/dashboard')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{url('/dashboard/news')}}">All News</a>
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
                <div class="card-header">Detail News
                  @if($news->news_status)
                  <span class="badge badge-success font-l float-right">Active</span>
                  @else
                  <span class="badge badge-danger font-l float-right">Inactive</span>

                  @endif
                </div>
              <div class="small text-muted ml-4 mt-2">{{$news->news_publish_datetime->format('d-m-Y H:i:s')}}</div>

                <div class="card-body">

                    {{-- <div classs="row text-center">
                      <div class="col-12 text-center">

                        <h5>{{$news->news_title}}</h5>
                        @php($url = Helper::getYoutubeVideoID("https://www.youtube.com/watch?v=ecAZLlyzo7E"))
                        <iframe width="420" height="315" src="//www.youtube.com/embed/{{$url}}" frameborder="0" allowfullscreen></iframe>
                        <div class="divider"></div>
                        <p>{!! $news->news_content !!}
                      </div>

                    </div> --}}

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