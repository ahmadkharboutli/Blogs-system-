<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            input {
                color: #000; /* Set to black or any other visible color */
            }
        </style>
        
    </head>
    <body class="font-sans text-gray-900 antialiased ">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 red-100 text-bg-primary">
            <div>
                <a href="/">
                    <img src="/photos/blogging-line-icon-free-vector-removebg-preview.png" class="w-20 h-20 mx-auto" />
                    <p class="text-center">hyber blog system</p>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 text-white shadow-md overflow-hidden sm:rounded-lg" style="background-color: rgb(134, 180, 237) ">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
