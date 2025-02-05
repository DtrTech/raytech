<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head')
    @include('layouts.css')
    @if(!env('APP_LOCAL', false))
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
    @endif
</head>

<body class="layout-boxed">
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>

    <!--  BEGIN NAVBAR  -->
    @include('layouts.navtop')

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

            @include('layouts.sidebar')
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                @include('layouts.flash-message')
                @yield('content')
                

            </div>
            @include('layouts.footer')
        </div>
    </div>

    @include('layouts.script')


</body>
</html>
