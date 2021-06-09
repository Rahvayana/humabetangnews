@extends('layouts.theme')

@section('breadcrumb')
    <li class="breadcrumb-item">
    <a href="{{url('/dashbaord')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{url('/dashboard/news-category')}}">News Category</a>
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
                <div class="card-header">Edit News Category</div>

                <form id="needs-validation" class="form-horizontal" action="{{ URL('dashboard/news-category/update/'.$categories->id) }}" method="post" enctype="multipart/form-data">
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
                                <input class="form-control" id="name" name="name" type="text" value="{{$categories->news_categories_name}}" placeholder="Category Name">
                                </div>
                            </div>
                            </div>

                            {{-- <div class="row">
                            <div class="col-sm-12">

                                <div class="form-group">

                                <img src="{{asset($categories->news_categories_app_img)}}" style="width: 50px; height:50px;">
                                    <label class="col-form-label" for="file-input">Mobile icon</label>
                                    <div class="col-md-9 mt-2">
                                    <input id="file-inputapp" type="file" name="mobile_icon">
                                    </div>
                                </div>
                            </div>
                            </div> --}}

                            {{-- <div class="row">
                                <div class="col-sm-12">

                                <div class="form-group">
                                <img src="{{asset($categories->news_categories_web_img)}}" style="width: 50px; height:50px;">

                                    <label class="col-form-label" for="file-input">Web icon</label>
                                    <div class="col-md-9 mt-2">
                                        <input id="file-inputweb" type="file" name="web_icon">
                                    </div>
                                    </div>
                                </div>
                            </div> --}}
                            <!-- /.row-->




                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-primary" type="submit">
                        <i class="fa fa-dot-circle-o"></i> Submit</button>
                        <a type="button" href="{{url('/dashboard/news-category')}}" class="btn btn-sm btn-danger">
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
<script>


</script>
@endsection
