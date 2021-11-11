<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800&family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <title>PostOffice - @yield('title')</title>
</head>

<body class="font-sans antialiased">
    @include('layouts.navigation')

    <div class="min-h-screen" id="root">
        <div>
            @yield('content')
        </div>

    </div>

    <div class="bg-gray-100 pt-5 pb-8" id="root">
        <div class="text-center text-xl">
            🏣
        </div>
        <div class="font-nunito  text-sm text-gray-500 font-light text-center">
            POSTOFFICE
        </div>

        <div class="font-nunito  text-xs text-gray-500 font-light text-center">
            Created by Josh Codd | {{ date('Y') }}
        </div>

    </div>
</body>

<script>
    // Routes for client side js.
    var config = {
        routes: {
            comments_index: "{{ route('api.comments.index') }}",
            comments_store: "{{ route('api.comments.store') }}"
        }
    };
</script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="{{ asset('js/global_functions.js') }}"></script>
<script src="{{ asset('js/app_script.js') }}"></script>
<script src="{{ asset('js/vue.js') }}"></script>

</html>
