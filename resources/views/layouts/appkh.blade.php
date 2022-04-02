<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title-page')</title>

    @include('layouts.header-style')

</head>

<body >
    {{-- <div class="preloader">
        <div class="loader_34">
            <div class="ytp-spinner">
                <div class="ytp-spinner-container">
                    <div class="ytp-spinner-rotator">
                        <div class="ytp-spinner-left">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                        <div class="ytp-spinner-right">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     --}}
    
      
        <div class="container">
{{--           
            <div class="content mt-5">
                @include('layouts._alert')

            </div> --}}
            @yield('content')

        </div>
     
 
        @include('layouts.scripts')
    @yield('after-scripts')

</body>

</html>
