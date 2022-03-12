<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    @foreach($site_settings as $value)
    <title> @yield('title') | {{ $value->title }}</title>
    @endforeach
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="মামাজ গ্রুপ ইন্ডাট্রিজ" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    @foreach($site_settings as $value)
    <link rel="shortcut icon" href="{{ URL::asset ('/assets/images/settings/' .$value->websitefavicondark) }}">
    @endforeach
    @include('Backend.Agent.includes.head-css')
</head>

@section('body')
    <body data-sidebar="dark">
@show
    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('Backend.Agent.includes.topbar')
        @include('Backend.Agent.includes.sidebar')
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            @include('Backend.Agent.includes.footer')
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    <!-- JAVASCRIPT -->
    @include('Backend.Agent.includes.vendor-scripts')
</body>

</html>
