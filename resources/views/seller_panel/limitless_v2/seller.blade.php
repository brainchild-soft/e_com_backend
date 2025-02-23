<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ url('/') }}">
    <title>@yield('PageTitle') | {{ env('APP_NAME') }}</title>

    <script src="{{ asset('js/limitless_v2.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <meta name="lang" content="en">

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ asset('/assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/assets/css/core.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/assets/css/components.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/assets/css/colors.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/assets/css/custom.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/assets/css/extras/animate.min.css') }}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <style>
        .navbar-brand{
            padding: 3px 20px;
        }
    </style>
    @yield('PageCss')

    <!-- Core JS files -->
    <script type="text/javascript" src="{{ asset('assets/js/plugins/loaders/pace.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/core/libraries/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/core/libraries/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/loaders/blockui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/ui/nicescroll.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/ui/drilldown.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/notifications/pnotify.min.js') }}"></script>
    <!-- /core JS files -->



    @yield('ThemeJs')
    <script type="text/javascript" src="{{ asset('assets/js/pages/components_notifications_pnotify.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/js/pages/animations_css3.js') }}"></script>
</head>
<body class="navbar-top-md-md">

<div id="limitless_v2">

    @include('seller_panel.limitless_v2.includes.nav_bar')
    <!-- Page container -->
    <div class="page-container " >

        <!-- Page content -->
        <div class="page-content" >

            <!-- Main content -->
            <div class="content-wrapper">

                @yield('content')

            </div>
            <!-- /main content -->
                <div id="loading" style="top: 20%; left: 40%; position: absolute; z-index: 1000000;">
                    <img src="{{ asset('assets/loader.gif') }}" />
                </div>
        </div>
        <!-- /page content -->
        <!-- Footer -->

        <!-- /footer -->
    </div>
    <!-- /page container -->

</div>
<script>
    var $loading = $('#loading').hide();
    //Attach the event handler to any element
    $(document)
        .ajaxStart(function () {
            //ajax request went so show the loading image
            $loading.show();
        })
        .ajaxStop(function () {
            //got response so hide the loading image
            $loading.hide();
        });
</script>
@yield('PageJs')

</body>
</html>
