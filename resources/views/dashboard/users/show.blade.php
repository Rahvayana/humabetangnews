@extends('layouts.theme')

@section('breadcrumb')

    <li class="breadcrumb-item">
        <a href="{{url('/dashboard')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{url('/dashboard/users')}}">Users</a>
    </li>
    <li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
    @include('common.breadcrum_menu')
      <div class="container-fluid">
        <div class="animated fadeIn">

          <!-- /.row-->
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">Detail User
                </div>

                <div class="card-body">

                  <div class="table-responsive">
                    <table class="table table-bordered table-condensed">
                      <tr>
                        <th width="15%">Name</th>
                        <th width="1%">:</th>
                        <td>{{ $user->username}}</td>
                      </tr>
                      <tr>
                        <th>Email</th>
                        <th>:</th>
                        <td>{{ $user->email}}</td>
                      </tr>
                      <tr>
                        <th>Status</th>
                        <th>:</th>
                        @if($user->news_status)
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
