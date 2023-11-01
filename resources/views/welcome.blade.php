<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- favicon --}}
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"/>
        {{-- Title --}}
        <title>ToDo - FallEn</title>
        {{-- Tailwindcss CDN--}}
        <script src="https://cdn.tailwindcss.com"></script>
        {{-- Swal alert --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @vite('resources/js/app.js')
    </head>
    <body  class="bg-[#0d1117] min-h-screen">
        <div id="app">
            <app></app>
        </div>
    </body>


</html>
