<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" ng-app="MainApp">
    {{-- ng-controller="@yield('controller')" --}}
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Robotics Center Home Automation</title>
    <link rel="icon" href="@{{ app.icon }}" type="image/x-icon"> <!-- Favicon-->
    <meta name="description" content="@{{ page.description }}">
    
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/charts-c3/plugin.css') }}"/>

    <link rel="stylesheet" href="{{ asset('assets/plugins/morrisjs/morris.min.css') }}" />

    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">

    <link href="{{ asset('base-assets/lib/select.css') }}" rel="stylesheet">
    <link href="{{ asset('base-assets/lib/sweetalert/sweetalert.css') }}" rel="stylesheet">
    <link href="{{ asset('base-assets/lib/toast.css') }}" rel="stylesheet">
    <link href="{{ asset('base-assets/lib/coderty-loader.css') }}" rel="stylesheet">
    <link href="{{ asset('base-assets/lib/ADM-dateTimePicker.css') }}" rel="stylesheet">
    <link href="{{ asset('base-assets/lib/selectize.default.css') }}" rel="stylesheet">
    <link href="{{ asset('base-assets/lib/dropify/css/dropify.min.css') }}" rel="stylesheet">

    @yield('page-style')
</head>

<body class="theme-blush"  ng-controller="@yield('controller')">
    
    <!-- loader Start -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="m-t-30"><img class="zmdi-hc-spin" src="{{ asset('assets/images/loader.svg') }}" width="48" height="48" alt="Aero"></div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- loader END -->

        @auth
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>

    <!-- Wrapper Start -->
    <div class="wrapper">
        <!-- Left Sidebar Panel Start  -->
        @include('components.sidebar.left')
        <!-- Left Sidebar Panel End-->

        <!-- TOP Nav Bar -->
        @include('components.navbar.main-nav')
        <!-- TOP Nav Bar END -->

        <!-- Right Sidebar Panel Start-->
        @include('components.sidebar.right')
        <!-- Right Sidebar Panel End-->

        @yield('content')
    </div>
    <!-- Wrapper END -->
    @else
        @yield('content')
    @endauth

    <!-- Footer -->
    @include('components.footer.main-footer')
    <!-- Footer END -->

    @yield('modal')
    <!-- Scripts -->
    @stack('before-scripts')
    <!-- Jquery Core Js --> 
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script> <!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) --> 
    <script src="{{ asset('assets/bundles/vendorscripts.bundle.js') }}"></script> <!-- slimscroll, waves Scripts Plugin Js -->

    <script src="{{ asset('assets/bundles/jvectormap.bundle.js') }}"></script> <!-- JVectorMap Plugin Js -->
    <script src="{{ asset('assets/bundles/sparkline.bundle.js') }}"></script> <!-- Sparkline Plugin Js -->
    <script src="{{ asset('assets/bundles/c3.bundle.js') }}"></script>

    <script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/pages/index.js') }}"></script>

    <!-- Chart JS -->
    <script src="{{ asset('base-assets/js/default-assets/toastr.js') }}"></script>
    <script src="{{ asset('base-assets/lib/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('base-assets/lib/printThis.js') }}"></script>
    <script src="{{ asset('base-assets/lib/toast.min.js') }}"></script>
    <script src="{{ asset('base-assets/lib/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('base-assets/lib/chart/Chart.min.js') }}"></script>
    <script src="{{ asset('base-assets/lib/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('base-assets/lib/dataTables.bootstrap4.min.js') }}"></script>

    <!-- ======================== Angular Files : Not made compulsory in the system ========================= -->
    <script src="{{ asset('base-assets/lib/angular/angular.min.js') }}"></script>
    <script src="{{ asset('base-assets/lib/angular/angular-animate.min.js') }}"></script>
    <script src="{{ asset('base-assets/lib/angular/angular-sanitize.min.js') }}"></script>
    <script src="{{ asset('base-assets/lib/lodash/dist/lodash.min.js') }}"></script>
    <script src="{{ asset('base-assets/lib/chart/highChart.js') }}"></script>
    <script src="{{ asset('base-assets/lib/ADM-dateTimePicker.js') }}"></script>
    <script src="{{ asset('base-assets/lib/angular-button-spinner.min.js') }}"></script>
    <script src="{{ asset('base-assets/lib/moment.min.js') }}"></script>
    <script src="{{ asset('base-assets/lib/angular-tag.js') }}"></script>
    <script src="{{ asset('base-assets/lib/angular-moment.min.js') }}"></script>
    <script src="{{ asset('base-assets/lib/angular-datatables.min.js') }}"></script>
    <script src="{{ asset('base-assets/lib/lodash/dist/lodash.core.min.js') }}"></script>
    <script src="{{ asset('base-assets/lib/angular-bootstrap-toggle.js') }}"></script>
    <script src="{{ asset('base-assets/lib/ng-lodash/build/ng-lodash.min.js') }}"></script>
    <script src="{{ asset('base-assets/lib/coderty-loader.js') }}"></script>
    <script src="{{ asset('base-assets/lib/select.min.js') }}"></script>
    <script src="{{ asset('base-assets/lib/selectize.js') }}"></script>
    <script src="{{ asset('base-assets/lib/ng-ckeditor.min.js') }}"></script>
    <script src="{{ asset('base-assets/lib/sweetalert.min.js') }}"></script>
    <script src="{{ asset('base-assets/lib/dropify/js/dropify.min.js') }}"></script>


    <!-- global AngularJS App to tap to -->
    <script src="{{ asset('core-assets/main.js') }}"></script>
    <script src="{{ asset('core-assets/services/appService.js') }}"></script>

    @yield('page-script')


</body>

</html>
