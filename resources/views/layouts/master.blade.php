<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <title>@yield('title') | Laravel</title>
        {{
            app('Illuminate\Foundation\Vite')
            (['resources/css/app.scss', 'resources/js/app.js']);
        }}
    </head>
    <body>
        @yield('content')
    </body>
</html>