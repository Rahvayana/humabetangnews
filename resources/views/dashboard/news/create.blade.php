@extends('layouts.theme')

@section('breadcrumb')
    <li class="breadcrumb-item">
    <a href="{{url('/dashbaord')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{url('/dashboard/news')}}">News</a>
        </li>
    <li class="breadcrumb-item active">Add</li>
@endsection

@section('content')
    @include('common.breadcrum_menu')
      <div class="container-fluid">
        <div class="animated fadeIn">

          <!-- /.row-->
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">Add News</div>

                <form id="form-create" class="form-horizontal" action="{{ URL('dashboard/news/store') }}" method="post" enctype="multipart/form-data">
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
                                <input class="form-control" id="name" name="title" type="text" placeholder="Title news">
                                </div>
                            </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="select1">News Category</label>

                                        <select class="form-control" id="select1" name="category_id">
                                          <option value="" disabled selected>Select</option>
                                          @foreach($categories as $cat)
                                            <option value="{{$cat->id}}">{{$cat->news_categories_name}}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>    

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label for="name">Youtube Video URL</label>
                                    <input class="form-control" id="name" name="video_url" type="text" placeholder="ex: https://www.youtube.com/watch?v=LmvQgMlRMwc">
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                              <div class="col-sm-12">
                                <div class="form-group">
                                  <label for="name">Thumbnail</label>
                                  <input id="file-input" type="file" name="img">
                                </div>
                              </div>

                            </div>

                            <div class="form-group row">
                              <div class="col-md-9 col-form-label">
                                <div class="form-check checkbox">
                                <input class="form-check-input" id="check1" type="checkbox" name="is_slideshow" value="">
                                <label class="form-check-label" for="check1">Make as Slideshow</label>
                                </div>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="form-label" for="textarea-input">Date Time Published</label> 
                                  <div class='input-group date'>

                                      <input required id='datetimepicker1' type='text' placeholder="Input date time" name="datetime_published" class="form-control datetimepicker" readOnly/>
                                      <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-calendar"></span>
                                      </span>
                                      <input id="input-content" type="hidden" name="content">

                                  </div>
                              </div>



                            <div class="card">
                                <div class="card-header">Content
                                </div>
                                <div class="card-body">
                                  <!-- Create toolbar & editor container -->
                                  {{-- <div id="editor">
                                  </div> --}}
                                  <textarea class="form-control" name="content" id="editor1" style="width:100%" rows="10"></textarea>
                                </div>
                              </div>


                        
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-primary" type="submit">
                        <i class="fa fa-dot-circle-o"></i> Submit</button>
                        <a type="button" href="{{url('/dashboard/news')}}" class="btn btn-sm btn-danger">
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
{{-- 
    <script src="{{asset('node_modules/quill/dist/quill.min.js')}}"></script>
    <script src="{{asset('public/js/text-editor.js')}}"></script> --}}

    <script>
           $('#form-create').submit( function(e) {
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