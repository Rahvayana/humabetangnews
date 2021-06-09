<!DOCTYPE html>
<html lang="en">

<head>
  @php($config = \App\ConfigApp::first())
  <!-- <base href="./admin"> -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">


  <title>{{$config->web_app_name}}</title>
  <meta name="description" content="{{$config->description_meta}}">
  <meta name="author" content="{{$config->authors_meta}}">
  <meta name="keyword" content="{{$config->keyword_meta}}">
  <meta property="og:title" content="{{$config->web_app_name}}">
  <meta property="og:description" content="{{$config->description_meta}}">
  <meta property="og:image" content="{{asset('').$config->logo}}">
  <meta property="og:url" content="Humabetang.com">
  <link rel="icon" type="image/png" href="{{asset('').$config->logo}}" sizes="any" />


  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">




  {{-- <link rel="icon" type="image/png" href="{{ Gamexyz::accountingBaseUrl().$config->icon_app_configurations}}" /> --}}

  <!-- Styles -->

  <link href="{{ URL::asset('public/css/app.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('public/css/custom.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('public/css/toastr.min.css') }}" rel="stylesheet">



  <link href="{{ URL::asset('public/template/back/css/responsive.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('public/template/vendors/magnific-popup/magnific-popup.css') }}" rel="stylesheet">


  <link href="{{ URL::asset('public/template/back/vendors/fontawesome/css/fontawesome.min.css') }}" rel="stylesheet">
  <!-- <link href="{{ URL::asset('public/template/back/vendors/fontawesome/css/solid.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('public/template/back/vendors/fontawesome/css/brands.css') }}" rel="stylesheet"> -->
  <link href="{{ URL::asset('public/template/back/vendors/fontawesome/css/all.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('public/template/back/vendors/flag-icon-css/css/flag-icon.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('public/template/back/vendors/simple-line-icons/simple-line-icons.css') }}" rel="stylesheet">
  <link href="{{URL::asset('node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
  <link href="{{URL::asset('public/template/back/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet">
  <link href="{{URL::asset('public/css/app.css')}}" rel="stylesheet">
  <link href="{{URL::asset('public/css/responsive.css')}}" rel="stylesheet">



</head>




<body id="sidebar" class="app header-fixed sidebar-fixed sidebar-lg-show">

  @include('common.header')

    <div class="app-body mt-0 mt-md-5 mt-sm-0">
        @include('common.sidebar')
            <main class="main">
                @yield('content')
            </main>
        @include('common.aside-menu')
    </div>

  @include('common.footer')

  <!-- Scripts -->
  <script src="{{ URL::asset('public/js/app.js')}}"></script>
  <!-- <script src="{{ URL::asset('public/template/back/js/charts.js')}}"></script> -->
  <!-- <script src="{{ URL::asset('public/template/back/js/main.js')}}"></script> -->
  <!-- <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->

  <script type="text/javascript" src="{{ URL::asset('public/template/vendors/templateEditor/ckeditor/ckeditor.js') }} "></script>


  <!-- CoreUI and necessary plugins-->
  <!-- <script src="{{ URL::asset('node_modules/jquery/dist/jquery.min.js')}}"></script> -->
  <script src="{{ URL::asset('public/js/toastr.js')}}"></script>
  <script src="{{ URL::asset('node_modules/popper.js/dist/umd/popper.min.js')}}"></script>
  <script src="{{ URL::asset('node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <!-- <script src="{{ URL::asset('node_modules/pace-progress/pace.min.js')}}"></script> -->
  <script src="{{ URL::asset('node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js')}}"></script>
  <script src="{{ URL::asset('node_modules/@coreui/coreui-pro/dist/js/coreui.min.js')}}"></script>
  <!-- Plugins and scripts required by this view-->
<script src="{{ URL::asset('public/template/back/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ URL::asset('public/template/back/vendors/fontawesome/js/fontawesome.min.js') }}"></script>
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
  <script src="{{ URL::asset('node_modules/datatables.net/js/jquery.dataTables.js')}}"></script>
  <script src="{{ URL::asset('node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js')}}"></script>
  <script src="{{ URL::asset('node_modules/moment/moment.js')}}"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
  <script src="{{ URL::asset('public/template/back/js/bootstrap-datetimepicker.min.js') }}"></script>
  {{-- <script src="{{ URL::asset('public/template/back/js/jquery.price.js')}}"></script> --}}
  <script src="{{ URL::asset('public/template/vendors/sweetalert2/dist/sweetalert2.min.js') }}"></script>
  <script src="{{ URL::asset('public/template/vendors/sweetalert2/sweet-alert.init.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.all.js"></script>

  <script src="{{ URL::asset('public/template/vendors/magnific-popup/jquery.magnific-popup.js') }}"></script>

  {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> --}}
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
  {{-- <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script> --}}




  <script type="text/javascript">

//    TODO: Replace the following with your app's Firebase project configuration
//  Your web app's Firebase configuration

      $(document).ready(function() {

  $('.image-link').magnificPopup({type:'image'});


      $('#transactionTab li a').click(function(e){
        $('html, body').stop();
      });

      $("#datetimepicker1").datetimepicker({
        format: "dd/mm/yyyy hh:ii",
        autoclose: true,
        todayBtn: true,
        startDate: "2020-01-01 10:00",
        minuteStep: 1,
        icons: {
          time: 'fas fa-clock-o',
          date: 'fas fa-calendar',
          up: 'fas fa-plus',
          down: 'fas fa-minus',
          next: 'fas fa-chevron-left',
          previous: 'fas fa-chevron-right'
          }
    });

    $("#datetimepicker2").datetimepicker({
        format: "dd/mm/yyyy hh:ii",
        autoclose: true,
        todayBtn: true,
        startDate: "2020-01-01 10:00",
        minuteStep: 1,
        icons: {
          time: 'fas fa-clock-o',
          date: 'fas fa-calendar',
          up: 'fas fa-plus',
          down: 'fas fa-minus',
          next: 'fas fa-chevron-left',
          previous: 'fas fa-chevron-right'
          }
    });

      // myValue = null;
      if (localStorage.getItem('sidebar_class')) {
          myValue = localStorage.getItem('sidebar_class');

          // console.log('savedClass '+myValue);

          $("#sidebar").attr('class', myValue);
      }


      $('#sidebar-toggle').on('click', function(e) {
        // localStorage.setItem('menu-closed', !$('#sidebar-wrapper').hasClass('collapsed'));
        // $('#sidebar').removeClass('app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show pace-done');
        var item = $('#sidebar').attr('class');

        if(item == 'app header-fixed sidebar-fixed sidebar-lg-show pace-done pace-done pace-done'){
          console.log("1");
          var savedClass = 'app header-fixed sidebar-fixed sidebar-lg-show pace-done pace-done pace-done brand-minimized sidebar-minimized'

        }else{
          console.log("2");
          var savedClass = 'app header-fixed sidebar-fixed sidebar-lg-show pace-done pace-done pace-done';

        }
        console.log('class '+item);
        localStorage.setItem('sidebar_class', savedClass);
      });


        //CKeditor
        for (no = 1; no <= 10; no++) {
          if ($('#editor' + no).attr('class') != undefined) {
              CKEDITOR.replace('editor' + no,
              {
                  extraPlugins: 'divarea',
                  on: {
                      instanceReady: function() {
                          this.editable().setStyle( 'background-color', '#ffffff' );
                      }
                  },
                  filebrowserBrowseUrl        : '{{ URL("/") }}/public/template/vendors/templateEditor/kcfinder/browse.php?opener=ckeditor&type=files',
                  filebrowserImageBrowseUrl   : '{{ URL("/") }}/public/template/vendors/templateEditor/kcfinder/browse.php?opener=ckeditor&type=images',
                  filebrowserFlashBrowseUrl   : '{{ URL("/") }}/public/template/vendors/templateEditor/kcfinder/browse.php?opener=ckeditor&type=flash',

                  filebrowserUploadUrl        : '{{ URL("/") }}/public/template/vendors/templateEditor/kcfinder/upload.php?opener=ckeditor&type=files',
                  filebrowserImageUploadUrl   : '{{ URL("/") }}/public/template/vendors/templateEditor/kcfinder/upload.php?opener=ckeditor&type=images',
                  filebrowserFlashUploadUrl   : '{{ URL("/") }}/public/template/vendors/templateEditor/kcfinder/upload.php?opener=ckeditor&type=flash',
                  font_names : 'Arial/Arial, Helvetica, sans-serif;' +
                                  'Comic Sans MS/Comic Sans MS, cursive;' +
                                  'Courier New/Courier New, Courier, monospace;' +
                                  'Georgia/Georgia, serif;' +
                                  'Lucida Sans Unicode/Lucida Sans Unicode, Lucida Grande, sans-serif;' +
                                  'Tahoma/Tahoma, Geneva, sans-serif;' +
                                  'Times New Roman/Times New Roman, Times, serif;' +
                                  'Trebuchet MS/Trebuchet MS, Helvetica, sans-serif;' +
                                  'Verdana/Verdana, Geneva, sans-serif',
              });
          }
          CKEDITOR.on('dialogDefinition', function(ev) {
              var dialogName = ev.data.name,
                  dialogDefinition = ev.data.definition;
              if (dialogName === 'image') {
                  dialogDefinition.removeContents('Upload');
              }
          });
        }

        $('.showModalHapus').click(function(){
				var that 		= this;
			    var myLabel 	= $(that).data('name');
			    var myLink 		= $(that).data('link');
			    swal({
			        title: "Are you sure delete this " + myLabel + "?",
			        text: "Deleted data cannot be restore",
			        type: "info",
			        showCancelButton: true,
			        confirmButtonColor: "#dc3545",
			        confirmButtonText: "Submit",
			        cancelButtonText: "Cancel"
			    }).then((result) => {
			    	if (result.value)
			    	{
					    swal({
					    	title: "Delete",
					    	text:"Item Deleted",
					    	type: "info"
					    }).then(function(){
					    	$.ajax({
				                type: "GET",
				                url: myLink,
				                success: function (data) {
									console.log(data);
					    			location.reload();
				                }
				            });
					    });
					}
					else if (result.dismiss === swal.DismissReason.cancel)
					{
					    swal(
					      'Cancel',
					      'Your item is safe :)',
					      'error'
					    )
					}
			    });
			});

      toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": false,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    };

    });

    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
    };

    function isMobileDevice() {
          return (typeof window.orientation !== "undefined") || (navigator.userAgent.indexOf('IEMobile') !== -1);
      };

      $(".datetimepicker").datetimepicker({
        format: "yyyy-mm-dd hh:ii:ss",
        autoclose: true,
        todayBtn: true,
        startDate: "2020-01-01 10:00",
        minuteStep: 1,
        icons: {
          time: 'fas fa-clock-o',
          date: 'fas fa-calendar',
          up: 'fas fa-plus',
          down: 'fas fa-minus',
          next: 'fas fa-chevron-left',
          previous: 'fas fa-chevron-right'
          }
    });

    $('.image-popup-no-margins').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		closeBtnInside: false,
		fixedContentPos: true,
		mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
		image: {
			verticalFit: true
		},
		zoom: {
			enabled: true,
			duration: 300 // don't foget to change the duration also in CSS
		}
	});







  </script>
  @yield('page-js-script')





</body>

</html>
