<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
    <body>
    <div class="container">
        <nav class="nav">
            <a class="nav-link active" href="{{ route('cars.index') }}">Список автомобілів</a>
            <a class="nav-link" href="{{ route('cars.create') }}">Занести в базу</a>
        </nav>
        @yield('content')
    </div>
    @yield('footer-scripts')
    </body>
</html>
