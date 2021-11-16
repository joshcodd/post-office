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
    <div id="app">
        @include('layouts.navigation')

        @if (session('message'))
            <div class="border-b border-gray-400 p-2 block text-center bg-gray-100 z-50">
                <p class="inline text-center"> {{ session('message') }}</p>
                <button class=" relative right-5 float-right inline" onclick="hideParent(this)">x</button>
            </div>
        @endif

        @foreach ($errors->all() as $error)
            <div class="border-b border-gray-400 p-2 block text-center bg-gray-100 z-50">
                <p class="inline text-center text-spotify"> {{ $error }}</p>
                <button class="relative right-5 float-right inline" onclick="hideParent(this)">x</button>
            </div>
        @endforeach

        <div class="min-h-screen" id="root">
            <div>
                @yield('content')
            </div>

        </div>

        <div class="font-nunito text-gray-500 bg-gray-100 pt-5 pb-8 font-light " id="root">
            <div class="text-center text-xl">
                🏣
            </div>
            <div class="text-sm text-center">
                POSTOFFICE
            </div>

            <div class="text-xs text-center">
                Created by Josh Codd | {{ date('Y') }}
            </div>

        </div>
    </div>
</body>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    // Routes for client side js.
    var config = {
        token: "",
        routes: {
            comments_index: "{{ route('api.comments.index') }}",
            comments_store: "{{ route('api.comments.store') }}",
            comments_update: "{{ route('api.comments.update', ['']) }}",
            comments_delete: "{{ route('api.comments.destroy', ['']) }}",
            create_token: "{{ route('users.create.token') }}"
        }
    };

    // Create accces token for API.
    axios.post(config.routes.create_token).then((response) => {
        config.token = response.data.token.substring(3);
    }).catch(response => {
        console.log(response);
    });;
</script>
<script src="{{ asset('js/global_functions.js') }}"></script>
<script src="{{ asset('js/app_script.js') }}"></script>
<script src="{{ mix('/js/app.js') }}"></script>

</html>
