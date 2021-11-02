<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>SPLIT - @yield('title')</title>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen">
        <h1> SPLIT - @yield('title') </h1>

        <div>
            @yield('content')
        </div>

    </div>
</body>

</html>