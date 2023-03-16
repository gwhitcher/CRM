<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <style>
        .container {
            margin: 0 auto;
            display: block;
            width: 100%;
            font-family: Verdana, sans-serif;
        }
        .row {
            width: 100%;
            clear: both;
            display: block;
        }
        .col {
            width: 50%;
            float: left;
            margin-bottom: 20px;
        }
        .text-end {
            text-align: right;
        }
        .fw-bold {
            font-weight: bold;
        }
        .table {width: 100%;}
        .table th {text-align: left;}
        .table td, .table th {
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>

<main>
    @yield('content')
</main>

</body>
</html>
