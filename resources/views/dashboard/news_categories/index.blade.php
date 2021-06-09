@extends('layouts.theme')

@section('breadcrumb')
    <li class="breadcrumb-item">
    <a href="{{url('/dashboard')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">News Category</li>
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
                <div class="card-header">News Category</div>
                <div class="card-body">



                    <div class="row mb-2">
                      <div class="col-6 col-sm-4 col-md-2 col-xl-2 mb-3 mb-xl-0 ">
                          <a type="button" href="{{url('/dashboard/news-category/create')}}" class="btn btn-block btn-success" type="button"><i class="fa fa-plus">&nbsp; Tambah</i></a>
                      </div>
                  </div>



                    <div classs="row">
                      <div class="table-responsive">
                        <table id="table" class="table table-hover table-outline mb-0">
                          <thead class="thead-light">
                            <tr>
                              <th>#</th>
                              <th>Title</th>
                              {{-- <th class="text-center">Mobile icon</th>
                              <th class="text-center">Web icon</th> --}}
                              <th class="text-right">Action</th>
                            </tr>
                          </thead>
                          <tbody id="table-category">
                              @foreach($categories as $key => $item)
                              <tr class="row1" data-id="{{ $item->id }}">
                                <td class="pl-3">
                                    <i class="fa fa-sort"></i>
                                </td>
                                  <td>
                                      {{ $item->news_categories_name }}
                                  </td>
                                  {{-- <td class="text-center">
                                      <img style="width: 50px; height:50px"  src="{{ URL::asset($item->news_categories_app_img) }}"></img>
                                  </td>
                                  <td class="text-center">

                                      <img style="width: 50px; height:50px" src="{{ URL::asset($item->news_categories_web_img  ) }}"></img>

                                  </td> --}}
                                  <td class="text-right">
                                      <div class="btn-group" role="group">
                                          <button class="btn btn-primary dropdown-toggle" id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                          <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="margin: 0px;">
                                              {{ Helper::edit('/dashboard/news-category/edit/'.$item->id) }}
                                              {{ Helper::hapus('/dashboard/news-category/delete/'.$item->id) }}
                                          </div>
                                      </div>
                                  </td>
                                </tr>
                              @endforeach

                          </tbody>
                          <tfoot>
                            <tr>
                                <td colspan="3">
                                    Drag and drop to order categories
                                </td>
                            </tr>
                          </tfoot>
                        </table>

                        <div align="center">
                          {{-- {{ $categories->appends(Request::except('page'))->links() }} --}}
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
<script type="text/javascript">
    $(function () {
      $("#table").DataTable(
        {
        "bSort" : false,
        "paging": false,
        "searching": false
        }
      );

      $( "#table-category" ).sortable({
        items: "tr",
        cursor: 'move',
        opacity: 0.6,
        update: function() {
            sendOrderToServer();
        }
      });

      function sendOrderToServer() {
        var order = [];
        var token = $('meta[name="csrf-token"]').attr('content');
        $('tr.row1').each(function(index,element) {
          order.push({
            id: $(this).attr('data-id'),
            position: index+1
          });
        });

        $.ajax({
          type: "POST",
          dataType: "json",
          url: "{{ url('/dashboard/news-category/reorder') }}",
              data: {
            order: order,
            _token: token
          },
          success: function(response) {
              if (response.status == "success") {
                console.log(response);
                toastr.success(response.message)

              } else {
                console.log(response);
                toastr.error(response.message)

              }
          }
        });
      }
    });
  </script>
@endsection
