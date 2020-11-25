{{-- @include('layouts.master') --}}


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/doctor_search.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Bootstrap CSS -->
    {{--
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"
        type="text/css"> --}}
    <link rel="stylesheet" href="{{ asset('vendor/materialize/css/materialize.min.css') }}">

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

        @section('Show_data_search')
        @show
    </div>

    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"> </script>
    <script src="{{ asset('vendor/materialize/js/materialize.min.js') }}"></script>
    <script src="{{ asset('js/search_doctor/form_search.js') }}"> </script>
</body>

</html>
