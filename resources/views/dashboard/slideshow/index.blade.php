@extends('layouts.theme')

@section('breadcrumb')

    <li class="breadcrumb-item">
        <a href="{{url('/dashboard')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Slideshow</li>
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
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        @foreach ($errors->all() as $error)
                        - {!! $error !!}</br>
                        @endforeach

                        <button class=" close" type="button" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </div>
            </div>
            @endif
          </div>

          <!-- /.row-->
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">Slideshow</div>
                <div class="card-body">

        

                    {{-- <div class="row mb-2">
                        <div class="col-6 col-sm-4 col-md-2 col-xl-2 mb-3 mb-xl-0 ">
                            <a type="button" href="{{url('/dashboard/news/create')}}" class="btn btn-block btn-success" type="button"><i class="fa fa-plus">&nbsp; Tambah</i></a>
                        </div>
                    </div>

                    --}}



                    <div classs="row">
                      <div class="table-responsive">
                        <table class="table table-hover table-outline mb-0">
                          <thead class="thead-light">
                            <tr>
                              <th>No</th>
                              <th>Title</th>
                              <th>Image</th>
                              <th class="text-right">Action</th>
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
                                    {{-- <img style="width: 100px; height:50px" src="{{ URL::asset($item->news_img  ) }}"></img> --}}

                                    <a href="{{ URL::asset($item->news_img) }}" class="image-link">
                                      <img src="{{ URL::to($item->news_img) }}" width="70px">
                                    </a>

                                  </td>


                                  <td class="text-right">
                                      <div class="btn-group" role="group">
                                          <button class="btn btn-primary dropdown-toggle" id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                          <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="margin: 0px;">
                                              {{ Helper::baca('/dashboard/slideshow/'.$item->id) }}
                                              {{ Helper::hapus('/dashboard/slideshow/delete/'.$item->id) }}
                                          </div>
                                      </div>
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
            <!-- /.col-->
          </div>
          <!-- /.row-->
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