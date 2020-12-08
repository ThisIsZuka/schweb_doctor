{{-- @include('layouts.master') --}}


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{ asset('assets/logo/icon.jpg')}}" type="image/icon type" sizes="32x32">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200&display=swap" rel="stylesheet">
    
    {{-- Header --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/header.css') }}">

    {{-- Header For search Doctor CSS --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/doctor_search.css') }}">

    {{-- Footer --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css') }}">

    {{-- Swiper --}}
    <link rel="stylesheet" href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}">

    {{-- Icon Material --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/materialize/css/materialize.min.css') }}">

    <link rel="stylesheet" href="{{ asset('vendor/Skeleton/src/avnSkeleton/avnSkeleton.css') }}">

    <link rel="stylesheet" href="{{ asset('vendor/loading/dist/jquery-spinner.min.css') }}" />
    {{-- <link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui.css') }}"> --}}

    {{-- Search Select --}}
    <link href="{{ asset('vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet" />


</head>

<body>

    <div class="container-fluid">
        <div class="top">
            @include('header.header')
            @section('header')
            @show

            <div class="container body_form">
                @include('search_doctor.sec_search')
                @section('search')
                @show
            </div>
        </div>

        <div id="wait_load">
            @section('Show_data_search')
            @show
        </div>



        @include('footer.footer')
        @section('footer')
        @show
    </div>

    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"> </script>
    <script src="{{ asset('vendor/materialize/js/materialize.min.js') }}"></script>
    <script src="{{ asset('js/doctor_search/doctor_search.js') }}"> </script>
    <script src="{{ asset('js/header/header.js') }}"> </script>
    <script src="{{ asset('vendor/Skeleton/src/avnPlugin.js') }}"></script>
    <script src="{{ asset('vendor/Skeleton/src/avnSkeleton/avnSkeleton.js') }}"></script>

    <!-- Swiper JS -->
    <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>

    <script src="{{ asset('vendor/loading/dist/jquery-spinner.min.js') }}"></script>
    {{-- <script src="{{ asset('vendor/jquery-ui/jquery-ui.js') }}"></script> --}}

    {{-- Search Select js --}}
    <script src="{{ asset('vendor/select2/dist/js/select2.min.js') }}"></script>

</body>

</html>
