<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Re-education</title>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet"
          href="{{asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/jqvmap/jqvmap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/summernote/summernote-bs4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/bs-stepper/css/bs-stepper.min.css')}}">
    @stack('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @include('layouts.header')
    @include('layouts.sidebar')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
    </div>
    @include('layouts.footer')
    <aside class="control-sidebar control-sidebar-dark">
    </aside>
</div>

<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/plugins/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('assets/plugins/sparklines/sparkline.js')}}"></script>
<script src="{{asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<script src="{{asset('assets/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<script src="{{asset('assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
<script src="{{asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<script src="{{asset('assets/plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>
<script src="{{asset('assets/js/adminlte.js')}}"></script>
<script src="{{asset('assets/js/demo.js')}}"></script>
<script src="{{asset('assets/js/pages/dashboard.js')}}"></script>
@stack('scripts')

</body>
</html>
