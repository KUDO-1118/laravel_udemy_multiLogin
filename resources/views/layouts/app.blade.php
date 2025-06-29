<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        {{-- defer：遅れて読み込む --}}
    </head>

    <body class="font-sans antialiased">
        {{-- まずURLから、現在URIのプレフィックスを取得 --}}
        @php
            $uriPrefix = substr(url()->current(), strlen(url('/'))+1 );
            $uriPrefix = explode('/', $uriPrefix)[0];
            dump($uriPrefix);
        @endphp
        <div class="min-h-screen bg-gray-100">

            {{-- @if (auth('admin')->user())
                @include('layouts.admin-navigation')
            @elseif (auth('owners')->user())
                @include('layouts.owner-navigation')
            @elseif (auth('users')->user())
                @include('layouts.user-navigation')
            @endif --}}

            {{-- 現在URLのプレフィックスで判別 --}}
            @if ($uriPrefix === 'admin')
                @include('layouts.admin-navigation')
            @elseif ($uriPrefix === 'owner')
                @include('layouts.owner-navigation')
            @else
                @include('layouts.user-navigation')
            @endif

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
