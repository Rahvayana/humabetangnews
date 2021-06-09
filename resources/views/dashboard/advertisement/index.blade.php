@extends('layouts.theme')

@section('breadcrumb')

    <li class="breadcrumb-item">
        <a href="{{url('/dashboard')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Advertisement</li>
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
                <div class="card-header">Advertisement</div>
                <div class="card-body">

               

                    <div class="row mb-2">
                        <div class="col-6 col-sm-4 col-md-2 col-xl-2 mb-3 mb-xl-0 ">
                            <a type="button" href="{{url('/dashboard/ads/create/new')}}" class="btn btn-block btn-success" type="button"><i class="fa fa-plus">&nbsp; Tambah</i></a>
                        </div>
                    </div>


                    <div classs="row">
                      <div class="table-responsive">
                        <table class="table table-hover table-outline mb-0">
                          <thead class="thead-light">
                            <tr>
                              <th>No</th>
                              <th>Name</th>
                              <th>Img</th>
                              <th class="text-center">Status Active</th>
                              <th class="text-right">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                              @foreach($ads as $key => $item)
                              <tr>
                                  <td>
                                      {{ $ads->firstItem() + $key }}
                                  </td>
                                  <td>
                                      {{ $item->ads_name }}
                                      
                                  </td>
                                  <td>
                                    {{-- <a href="{{ URL::asset('').$item->ads_img }}" class="image-link"> --}}
                                      {{-- <img src="{{ asset($item->ads_img) }}" width="1000px"> --}}
                                    {{-- </a> --}}

                                    <a href="{{ URL::asset($item->ads_img) }}">
                                      <img src="{{ URL::to($item->ads_img) }}" width="70px">
                                    </a>
                                  </td>

                                  <td class="text-center">
                                    <label class="switch switch-label switch-pill switch-success">
                                      <input data-id="{{$item->id}}" class="switch-input toggle-class" type="checkbox" {{ $item->ads_status_active ? 'checked' : '' }}>
                                      <span class="switch-slider" data-checked="✓" data-unchecked="✕"></span>

                                      {{-- <input data-id="{{$user->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $user->status ? 'checked' : '' }}> --}}
                                    </label>
                                  </td>

                                  

                                  <td class="text-right">
                                      <div class="btn-group" role="group">
                                          <button class="btn btn-primary dropdown-toggle" id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                          <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="margin: 0px;">
                                              {{ Helper::baca('/dashboard/ads/'.$item->id) }}
                                              {{ Helper::edit('/dashboard/ads/edit/'.$item->id) }}
                                              {{ Helper::hapus('/dashboard/ads/delete/'.$item->id) }}
                                          </div>
                                      </div>
                                  </td>
                                </tr>
                              @endforeach

                          </tbody>
                        </table>

                        <div align="center">
                          {{ $ads->appends(Request::except('page'))->links() }}
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
            url: '{{url('/dashboard/ads/set/status')}}',
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