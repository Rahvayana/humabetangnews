@extends('layouts.theme')

@section('breadcrumb')
    <li class="breadcrumb-item">
    <a href="{{url('/dashbaord')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{url('/dashboard/tv')}}">Tv</a>
        </li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    @include('common.breadcrum_menu')
      <div class="container-fluid">
        <div class="animated fadeIn">

          <!-- /.row-->
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">Edit Tv</div>

                <form id="form-update" class="form-horizontal" action="{{ URL('dashboard/tv/update/'.$tv->id) }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card-body">

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



                        <div class="row">
                          <div class="col-sm-12">
                              <div class="form-group">
                              <label for="name">Title</label>
                              <input class="form-control" id="name" name="tv_name" value="{{$tv->tv_name}}" type="text" placeholder="Tv name">
                              </div>
                          </div>
                          </div>

                          <div class="row">
                              <div class="col-sm-12">
                                  <div class="form-group">
                                  <label for="name">Streaming Url</label>
                                  <input class="form-control" id="name" value="{{$tv->tv_url_stream}}" name="tv_url_stream" type="text" placeholder="">
                                  </div>
                              </div>
                          </div>

                          <div class="row">
                            <div class="col-sm-12">

                                <div class="form-group">
                                    <label class="col-form-label" for="file-input">Tv Logo</label>
                                    <div class="col-md-9">
                                    <input id="file-inputapp" type="file" name="tv_img" value="{{url('public/uploads/mobile/icons/'.$tv->tv_img)}}">
                                    </div>
                                </div>
                            </div>
                            </div>



                          <div class="card">
                              <div class="card-header">Tv Description
                              </div>
                              <div class="card-body">
                                <!-- Create toolbar & editor container -->

                              <textarea name="tv_description"  style="width:100%" rows="10">{{$tv->tv_description}}</textarea>
                              </div>
                            </div>


                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-primary" type="submit">
                        <i class="fa fa-dot-circle-o"></i> Submit</button>
                        <a type="button" href="{{url('/dashboard/news/category')}}" class="btn btn-sm btn-danger">
                        <i class="fa fa-ban"></i> cancel</a>
                    </div>
                    </div>
                </form>
            </div>
            <!-- /.col-->
          </div>
          <!-- /.row-->
        </div>
      </div>

@endsection



@section('page-js-script')

    <script src="{{asset('node_modules/quill/dist/quill.min.js')}}"></script>
    {{-- <script src="{{asset('public/js/text-editor.js')}}"></script> --}}

    <script>

            $('#form-update').submit( function(e) {
                form = this;
                $('#input-content').val(quill.container.firstChild.innerHTML);
                console.log("GGGGG "+quill.container.firstChild.innerHTML);
                e.preventDefault();

                setTimeout( function () {
                    form.submit();
                }, 300);
            });
    </script>


@endsection
