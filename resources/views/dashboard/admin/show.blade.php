@extends('layouts.theme')

@section('breadcrumb')

    <li class="breadcrumb-item">
        <a href="{{url('/dashboard')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{url('/dashboard/admin')}}">All Admin</a>
    </li>
    <li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
    @include('common.breadcrum_menu')
    @include('common.breadcrum_menu')
    <div class="container-fluid">
      <div class="animated fadeIn">

        <!-- /.row-->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">Detail Admin
              </div>

              <div class="card-body">

                <div class="table-responsive">
                  <table class="table table-bordered table-condensed">
                    <tr>
                        <th width="15%">Avatar</th>
                        <th width="1%">:</th>
                        <td>
                            <a href="{{ URL::asset($admin->img) }}" class="image-link">
                                <img src="{{ URL::to($admin->img) }}" width="300px">
                              </a>
                        </td>
                      </tr>
                    <tr>
                      <th width="15%">Name</th>
                      <th width="1%">:</th>
                      <td>{{ $admin->name}}</td>
                    </tr>
                    <tr>
                      <th>Email</th>
                      <th>:</th>
                      <td>{{ $admin->email}}</td>
                    </tr>
                    <tr>
                      <th>Status</th>
                      <th>:</th>
                      @if($admin->status_active)
                      <td><span class="badge badge-success font-2l">Active</span></td>
                      @else
                      <td><span class="badge badge-danger font-2l">Inactive</span></td>
                      @endif

                    </tr>

                  </table>
                </div>
            </div>
          </div>
          <!-- /.col-->
        </div>
        <!-- /.row-->
      </div>
    </div>
  </div>

@endsection



@section('page-js-script')
<script>


</script>
@endsection
