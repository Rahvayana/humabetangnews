@extends('layouts.theme')

@section('breadcrumb')

    <li class="breadcrumb-item">
        <a href="{{url('/dashboard')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Tv</li>
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

          <!-- /.row-->
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">Tv Streaming</div>
                <div class="card-body">

                    <div class="row mb-2">
                      <div class="col-6 col-sm-4 col-md-2 col-xl-2 mb-3 mb-xl-0 ">
                          <a type="button" href="{{url('/dashboard/tv/create')}}" class="btn btn-block btn-success" type="button"><i class="fa fa-plus">&nbsp; Tambah</i></a>
                      </div>
                    </div>



                    <div classs="row">
                      <div class="table-responsive">
                        <table class="table table-hover table-outline mb-0">
                          <thead class="thead-light">
                            <tr>
                              <th>No</th>
                              <th>Title</th>
                              <th>Tv Url</th>
                              <th class="text-center">Status Active</th>
                              <th class="text-right">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                              @foreach($tv as $key => $item)
                              <tr>
                                  <td>
                                      {{ $tv->firstItem() + $key }}
                                  </td>
                                  <td>
                                      {{ $item->tv_name }}
                                  </td>
                                  <td>
                                      {{ $item->tv_url_stream }}
                                  </td>

                                  <td class="text-center">
                                    <label class="switch switch-label switch-pill switch-success">
                                      <input data-id="{{$item->id}}" class="switch-input toggle-class" type="checkbox" {{ $item->tv_status_active ? 'checked' : '' }}>
                                      <span class="switch-slider" data-checked="✓" data-unchecked="✕"></span>

                                    </label>
                                  </td>


                                  <td class="text-right">
                                      <div class="btn-group" role="group">
                                          <button class="btn btn-primary dropdown-toggle" id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                          <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="margin: 0px;">
                                              {{ Helper::baca('/dashboard/tv/'.$item->id) }}
                                              {{ Helper::edit('/dashboard/tv/edit/'.$item->id) }}
                                              {{ Helper::hapus('/dashboard/tv/delete/'.$item->id) }}
                                          </div>
                                      </div>
                                  </td>
                                </tr>
                              @endforeach

                          </tbody>
                        </table>
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
            url: '{{url('/dashboard/tv/set/status')}}',
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
