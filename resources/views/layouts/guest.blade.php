<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'FranchiseKu') }}</title>



    <!-- Bootstrap Css -->
    {{-- <link href="{{asset('backend/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" /> --}}

    {{-- AOS --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/auth.css', 'resources/sass/app.scss'])

    <!-- Other Fonts (if any) -->

</head>

<body class="font-sans border-0 text-gray-900 antialiased ">
    <div class="w-full sm:max-w-md  bg-white text-start shadow-md overflow-hidden sm:rounded-lg">
        @yield('content') <!-- Injects the content from the view file here -->
    </div>
    </div>
</body>

</html>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
