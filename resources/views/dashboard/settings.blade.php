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
            	<div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Edit App Config</strong>
                        </div>

                        <form id="form-update" class="form-horizontal" action="{{ URL('dashboard/settings/update') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}

                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-col-form-label" for="userfile_logo">Logo text <b style="color:red">*</b></label>
                                <br/>
                                <div class="form-group center-align">
                                    <a class="image-link" href="{{URL::asset($config->logo_text)}}">
                                        <img src="{{URL::asset($config->logo_text)}}" width="100">
                                    </a>
                                </div>
                                <input id="userfile_logo" type="file" name="logo_text">

                            </div>
                            <div class="form-group">
                                <label class="form-col-form-label" for="userfile_icon">Logo <b style="color:red">*</b></label>
                                <br/>
                                <div class="form-group center-align">
                                    <a class="image-link" href="{{URL::asset($config->logo)}}">
                                        <img src="{{URL::asset($config->logo)}}" width="100">
                                    </a>
                                </div>
                                <input id="userfile_icon" type="file" name="logo">

                            </div>
              
                            <div class="form-group">
                                <label class="form-col-form-label" for="name">Name <b style="color:red">*</b></label>
                                <input class="form-control id="web_app_name" type="text" name="web_app_name" value="{{Request::old('web_app_name') == '' ? $config->web_app_name : Request::old('web_app_name')}}">

                            </div>
                            <div class="form-group">
                                <label class="form-col-form-label" for="description_meta">Description Meta <b style="color:red">*</b></label>
                                <input class="form-control id="description_meta" type="text" name="description_meta" value="{{Request::old('description_meta') == '' ? $config->description_meta : Request::old('description_meta')}}">

                            </div>
                            <div class="form-group">
                                <label class="form-col-form-label" for="keyword_meta">Keyword Meta <b style="color:red">*</b></label>
                                <input class="form-control id="keyword_meta" type="text" name="keyword_meta" value="{{Request::old('keyword_meta') == '' ? $config->keyword_meta : Request::old('keyword_meta')}}">

                            </div>
                            <div class="form-group">
                                <label class="form-col-form-label" for="authors_meta">Author Meta <b style="color:red">*</b></label>
                                <input class="form-control  id="authors_meta" type="text" name="authors_meta" value="{{Request::old('authors_meta') == '' ? $config->authors_meta : Request::old('authors_meta')}}">

                            </div>
                            <div class="form-group">
                                <label class="form-col-form-label" for="footer">Footer <b style="color:red">*</b></label>
                                <input class="form-control  id="footer" type="text" name="footer" value="{{Request::old('footer') == '' ? $config->footer : Request::old('footer')}}">

                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-sm btn-primary" type="submit">
                            <i class="fa fa-dot-circle-o"></i> Submit</button>
                            <a type="button" href="{{url('/dashboard')}}" class="btn btn-sm btn-danger">
                            <i class="fa fa-ban"></i> cancel</a>
                        </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
      </div>

@endsection



@section('page-js-script')
<script>


</script>
@endsection