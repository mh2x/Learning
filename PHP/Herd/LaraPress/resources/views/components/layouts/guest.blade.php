<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ isRTL() ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title . ' - ' . config('app.name') : config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="min-h-screen font-sans antialiased">
    <x-nav sticky full-width progress-indicator>
        <x-slot:brand class="!justify-center">
            <x-app-brand />
        </x-slot:brand>
    </x-nav>
    <div class="max-w-xl mx-auto mt-20">
        {{-- MAIN --}}
        <x-main full-width>
            {{-- The `$slot` goes here --}}
            <x-slot:content>
                {{ $slot }}
            </x-slot:content>
        </x-main>
        {{--  TOAST area --}}
        <x-toast />
    </div>
</body>

</html>
