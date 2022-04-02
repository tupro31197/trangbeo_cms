<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title-page')</title>
    <script>
        window.OneSignal = window.OneSignal || [];
        OneSignal.push(function() {
            OneSignal.init({
                appId: "5c9ef5c1-8046-462e-8f18-a0a2e0ca3016",
            });
            (async function() {
                var deviceID = await OneSignal.getUserId();
                document.getElementById("device_id").value = deviceID;

            })()
        });
    </script>

    @include('layouts.header-style')

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- main-header -->
        @include('layouts.main-header')
        <!-- main-sidebar -->

        @include('layouts.main-sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @include('layouts.content-header')
            <!-- content -->
            <div class="content">
                @include('layouts._alert')

            </div>
            @yield('content')

        </div>
        <!-- /.content-wrapper -->



        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    @include('layouts.scripts')
    @yield('after-scripts')

</body>

</html>
