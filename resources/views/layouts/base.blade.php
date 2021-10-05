<html lang="en">
    <head>
        <title>Jumia task - @yield('title')</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="/assets/scss/main.css">

        <link rel="icon" title="image/ico" href="{{ url('/assets/favicon.ico') }}" />
    </head>
    <body>

        <div class="container">
            @yield('content')
        </div>
    </body>

    @yield('scripts')
</html>
