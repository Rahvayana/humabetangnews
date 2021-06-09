@extends('layouts.theme')

@section('breadcrumb')

    <li class="breadcrumb-item">
        <a href="{{url('/dashboard')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{url('/dashboard/ads')}}">Advertisement</a>
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
                <div class="card-header">Detail Ads
                  @if($ads->ads_status_active)
                  <span class="badge badge-success font-l float-right">Active</span>
                  @else
                  <span class="badge badge-danger font-l float-right">Inactive</span>
                  @endif
                </div>
              <div class="small text-muted ml-4 mt-2">{{ Helper::ubahDBKeTanggalwaktu($ads->created_at)}}</div>

                <div class="card-body">

                    <div classs="row text-center">
                      <div class="col-12 text-center">


                        <a href="{{ URL::asset($ads->ads_img) }}" class="image-link">
                          <img src="{{ URL::to($ads->ads_img) }}" width="300px">
                        </a>
                    </div>
                    

                    </div>

                    <h5>{{$ads->news_name}}</h5>

                    <div class="divider"></div>

                    {{ $ads->ads_description }}
                        
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