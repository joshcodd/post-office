<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="{{ asset('js/global_functions.js') }}" defer></script>
    <script src="{{ asset('js/log_in_script.js') }}" defer></script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <title> PostOffice</title>
</head>

<body class="font-sans antialiased ">

    <div class="sm:flex h-screen flex-row-reverse min-w-full justify-center items-center flex-grow ">

        <div class=" fixed top-0 right-0 px-6 py-4 sm:block z-20">

            <a href="@yield('leave_button_href')"
                class="border md:ml-0 sm:inline rounded px-3 py-1.5 text-sm font-semibold text-black border-black  hover:bg-gray-700 hover:text-white z-20">
                @yield('leave_button_title')</a>
        </div>

        <div class="h-full flex justify-center items-center pt-6 sm:pt-0 bg-gray-50  sm:w-1/2 z-10">
            <div class=" w-3/4 md:w-1/2">

                <div class="text-5xl text-center">
                    🏣
                </div>
                <div class="text-3xl text-center mt-4">
                    @yield('right_title')
                </div>

                <div class="mt-6 px-6 pt-4 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg w-max-20">
                    @yield('right_content')
                </div>
            </div>
        </div>

        <div class="relative text-center h-full flex justify-center items-center  pt-0 bg-gray-100  sm:w-1/2 ">
            <img class="w-full h-full  object-cover " src={{ asset('images/home-bg.webp') }} alt="">
            <div class=" absolute text-center font-bold text-gray-100 ">
                <div id="home_text_1" class="text-6xl p-4">
                    POSTOFFICE
                </div>
                <div id="home_text_2" class="text-7xl p-4">
                    Yūbinkyoku
                </div>
                <div id="home_text_3" class="text-8xl p-4">
                    郵便局
                </div>
            </div>
        </div>
    </div>
</body>

</html>
