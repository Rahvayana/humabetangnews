@extends('layouts.theme')

@section('breadcrumb')
    <li class="breadcrumb-item">
    <a href="{{url('/')}}">Home</a>
    </li>
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    @include('common.breadcrum_menu')
    
      <div class="container-fluid">
        <div class="animated fadeIn">

          <div class="row">
            @if(session()->has('success'))
            <div class="col-12">
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success') }}
                <button class=" close" type="button" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
            </div>
            @endif

            @if(session()->has('error'))
            <div class="col-12">
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session()->get('error') }}
                <button class=" close" type="button" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
            </div>
            @endif


            @if (count($errors) > 0)

                <div class="col-12">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        @foreach ($errors->all() as $error)
                        - {!! $error !!}</br>
                        @endforeach

                        <button class=" close" type="button" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </div>

            @endif
        </div>
          <div class="row">

                <!-- /.col-->
            <div class="col-sm-6 col-lg-3">
              <div class="card text-white bg-danger">
                <div class="card-body pb-0">
                  <div class="btn-group float-right">
                    <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-settings"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                  <div class="text-value">{{$users_count}}</div>
                  <div>Total User</div>
                </div>
                <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
                  <canvas class="chart" id="card-chart4" height="70"></canvas>
                </div>
              </div>
            </div>
            <!-- /.col-->


            <div class="col-sm-6 col-lg-3">
              <div class="card text-white bg-primary">
                <div class="card-body pb-0">
                  <div class="btn-group float-right">
                    <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-settings"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item" href="#">Action</a>
                      {{ Helper::tambah('/dashboard/news/create') }}
                    </div>
                  </div>
                  <div class="text-value">{{$news_count}}</div>
                  <div>Total News</div>
                </div>
                <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
                  <canvas class="chart" id="card-chart1" height="70"></canvas>
                </div>
              </div>
            </div>


            <div class="col-sm-6 col-lg-3">
              <div class="card text-white bg-warning">
                <div class="card-body pb-0">
                  <div class="btn-group float-right">
                    <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-settings"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item" href="#">Action</a>
                      {{ Helper::tambah('/dashboard/news-category/create') }}

                    </div>
                  </div>
                  <div class="text-value">{{$categories_count}}</div>
                  <div>Total News Category</div>
                </div>
                <div class="chart-wrapper mt-3" style="height:70px;">
                  <canvas class="chart" id="card-chart3" height="70"></canvas>
                </div>
              </div>
            </div>

            <!-- /.col-->
            <div class="col-sm-6 col-lg-3">
              <div class="card text-white bg-info">
                <div class="card-body pb-0">
                  <button class="btn btn-transparent p-0 float-right" type="button">
                    <i class="icon-location-pin"></i>
                  </button>
                  <div class="text-value">{{$view_today_count}}</div>
                  <div>Total Views Today</div>
                </div>
                <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
                  <canvas class="chart" id="card-chart2" height="70"></canvas>
                </div>
              </div>
            </div>
            <!-- /.col-->
          </div>
          <!-- /.row-->
          {{-- <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-5">
                  <h4 class="card-title mb-0">Traffic</h4>
                  <div class="small text-muted">November 2017</div>
                </div>
                <!-- /.col-->
                <div class="col-sm-7 d-none d-md-block">
                  <button class="btn btn-primary float-right" type="button">
                    <i class="icon-cloud-download"></i>
                  </button>
                  <div class="btn-group btn-group-toggle float-right mr-3" data-toggle="buttons">
                    <label class="btn btn-outline-secondary">
                      <input id="option1" type="radio" name="options" autocomplete="off"> Day
                    </label>
                    <label class="btn btn-outline-secondary active">
                      <input id="option2" type="radio" name="options" autocomplete="off" checked=""> Month
                    </label>
                    <label class="btn btn-outline-secondary">
                      <input id="option3" type="radio" name="options" autocomplete="off"> Year
                    </label>
                  </div>
                </div>
                <!-- /.col-->
              </div>
              <!-- /.row-->
              <div class="chart-wrapper" style="height:300px;margin-top:40px;">
                <canvas class="chart" id="main-chart" height="300"></canvas>
              </div>
            </div>
            <div class="card-footer">
              <div class="row text-center">
                <div class="col-sm-12 col-md mb-sm-2 mb-0">
                  <div class="text-muted">Visits</div>
                  <strong>29.703 Users (40%)</strong>
                  <div class="progress progress-xs mt-2">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
                <div class="col-sm-12 col-md mb-sm-2 mb-0">
                  <div class="text-muted">Unique</div>
                  <strong>24.093 Users (20%)</strong>
                  <div class="progress progress-xs mt-2">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
                <div class="col-sm-12 col-md mb-sm-2 mb-0">
                  <div class="text-muted">Pageviews</div>
                  <strong>78.706 Views (60%)</strong>
                  <div class="progress progress-xs mt-2">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
                <div class="col-sm-12 col-md mb-sm-2 mb-0">
                  <div class="text-muted">New Users</div>
                  <strong>22.123 Users (80%)</strong>
                  <div class="progress progress-xs mt-2">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
                <div class="col-sm-12 col-md mb-sm-2 mb-0">
                  <div class="text-muted">Bounce Rate</div>
                  <strong>40.15%</strong>
                  <div class="progress progress-xs mt-2">
                    <div class="progress-bar" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
          </div> --}}

          <div class="card">
            <div class="card-body">
              <div classs="row">
                <div class="col-sm-5">
                  <h4 class="card-title mb-0">News Information</h4>
                  <div class="small text-muted">{{ date('d M Y') }}</div>
                </div>
                <div class="table-responsive">
                  <table class="table table-hover table-outline mb-0">
                    <thead class="thead-light">
                      <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th class="text-center">Date Published</th>
                        <th class="text-center">Status Active</th>
                        <th class="text-right">Total Views</th>
                        <th class="text-right">Total Likes</th>
                        <th class="text-right">Total Comment</th>
    
    
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($news as $key => $item)
                        <tr>
                            <td>
                                {{ $news->firstItem() + $key }}
                            </td>
                            <td>
                                {{ $item->news_title }}
                            </td>
                            <td>
                                {{ $item->category->news_categories_name }}
                            </td>
    
                            <td class="text-center">
                              {{ Helper::ubahDBKeTanggalwaktu($item->news_publish_datetime) }}
                            </td>
    
                            <td class="text-center">
                              <label class="switch switch-label switch-pill switch-success">
                                <input data-id="{{$item->id}}" class="switch-input toggle-class" type="checkbox" {{ $item->news_status ? 'checked' : '' }}>
                                <span class="switch-slider" data-checked="✓" data-unchecked="✕"></span>
    
                                {{-- <input data-id="{{$user->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $user->status ? 'checked' : '' }}> --}}
                              </label>
                            </td>
    
                            <td class="text-center">
                                {{$item->views->count()}}
                            </td>
    
                            <td class="text-center">
                              {{$item->likes->count()}}
                            </td>
    
                            <td class="text-center">
                              {{$item->comments->count()}}
                            </td>
    
                          </tr>
                        @endforeach
    
                    </tbody>
                  </table>
    
                  <div align="center">
                    {{ $news->appends(Request::except('page'))->links() }}
                  </div>
                </div>
    
                  
              </div>
            </div>
          </div>

        
              




        </div>
      </div>

@endsection



@section('page-js-script')
<script>

$('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0; 
        var id = $(this).data('id'); 
         
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{url('/dashboard/news/set/status')}}',
            data: {'status': status, 'id': id},
            success: function(data){
              console.log(data.success)
              toastr.success(data.success, 'success')
              // toastr.error("{{ session()->get('error') }}")

              // toastr["success"]("My name is Inigo Montoya. You killed my father. Prepare to die!")
            }
        });
    })
</script>
@endsection