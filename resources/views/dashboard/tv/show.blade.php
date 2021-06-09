@extends('layouts.theme')

@section('breadcrumb')

    <li class="breadcrumb-item">
        <a href="{{url('/dashboard')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{url('/dashboard/news')}}">Tv Streaming</a>
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
                <div class="card-header">Detail tv
                  @if($tv->tv_status_active)
                  <span class="badge badge-success font-l float-right">Active</span>
                  @else
                  <span class="badge badge-danger font-l float-right">Inactive</span>

                  @endif
                </div>

                <div class="card-body">

                    <div classs="row text-center">
                      <div class="col-12 text-center">

                        <h5>{{$tv->tv_name}}</h5>
                        @php($url = $tv->tv_url_stream)
                        <video width="500" height="280" controls>
                            <source src="{{$url}}" type="application/x-mpegURL" controls autoplay>
                        </video>

                        <div class="divider"></div>
                        <p>{!! $tv->tv_description !!}
                      </div>

                    </div>
                        
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