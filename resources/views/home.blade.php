{{-- @include('layouts.master') --}}


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/homepage.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Bootstrap CSS -->
    {{--
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"
        type="text/css"> --}}
    <link rel="stylesheet" href="{{ asset('vendor/materialize/css/materialize.min.css') }}">
</head>

<body>

    <div class="top container-fluid">
        {{-- @include('header.header') --}}
        @section('header')
        @show

        <div class="container body">
            @include('search_doctor.sec_search')
            @section('search')
            @show
        </div>
    </div>

    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"> </script>
    <script src="{{ asset('vendor/materialize/js/materialize.min.js') }}"></script>
</body>

</html>

<script>
    jQuery(document).ready(function($) {
        navbar = $('.header');
        navbar.removeClass('alt-color');
        $(window).scroll(function() {
            var scrollPos = $(window).scrollTop(),
                navbar = $('.header');

            if (scrollPos > 10) {
                navbar.addClass('alt-color');
            } else {
                navbar.removeClass('alt-color');
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.sidenav');
            var instances = M.Sidenav.init(elems, options);
        });

        // Or with jQuery

        $(document).ready(function() {
            $('.sidenav').sidenav();
        });
    });

</script>
