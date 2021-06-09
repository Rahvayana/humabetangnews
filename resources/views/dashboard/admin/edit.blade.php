@extends('layouts.theme')

@section('breadcrumb')
    <li class="breadcrumb-item">
    <a href="{{url('/dashbaord')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{url('/dashboard/admin')}}">Admin</a>
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
                <div class="card-header">Edit Admin</div>

                <form id="form-update" class="form-horizontal" action="{{ URL('dashboard/admin/update/'.$admin->id) }}" method="post" enctype="multipart/form-data">
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
                                <label for="name">Name</label>
                                <input class="form-control" id="name" name="name" value="{{$admin->name}}" type="text" placeholder="Name">
                                </div>
                            </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label for="name">Email</label>
                                    <input class="form-control" id="email" name="email" value="{{$admin->email}}" type="email" placeholder="Email">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label for="name">Password</label>
                                    <input class="form-control" id="password" name="password" value="{{Crypt::decrypt($admin->password)}}" type="text" placeholder="Password">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label for="name">Password Confirmation</label>
                                    <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" value="{{Crypt::decrypt($admin->password)}}" placeholder="password_confirmation">
                                    </div>
                                </div>
                            </div>


                            <div class="row">

                              <div class="col-sm-12">
                                <div class="form-group">
                                <img src="{{asset($admin->img)}}" style="width: 50px; height:50px;">

                                  <label for="name">Avatar</label>
                                  <input id="file-input" type="file" name="img">
                                </div>
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
