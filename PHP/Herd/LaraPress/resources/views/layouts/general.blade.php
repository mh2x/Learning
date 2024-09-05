<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ isRTL() ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title . ' - ' . config('app.name') : config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Cropper.js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css" />
</head>

<body class="min-h-screen font-sans antialiased bg-base-200/50 dark:bg-base-200">

    {{-- NAVBAR mobile only --}}
    <x-nav sticky full-width progress-indicator>
        <x-slot:brand>
            <x-app-brand />
            <div class="w-full flex flex-row justify-center">
                <livewire:header-menu />
            </div>
        </x-slot:brand>

        <x-slot:middle class="!justify-end">
            <x-slot:actions>
                @guest
                    <x-button label="Login" icon="o-paper-airplane" class="btn-outline btn-primary" link="/login" />
                    <x-button label="Register" icon="m-user-plus" type="submit" class="btn-outline btn-secondary" spinner="register" link="/register" />
                @endguest
            </x-slot:actions>
        </x-slot:middle>
    </x-nav>

    {{-- MAIN --}}
    <x-main full-width>
        {{-- The `$slot` goes here --}}
        <x-slot:content>
            {{ $slot }}
        </x-slot:content>
    </x-main>
    {{--  TOAST area --}}
    <x-toast />
    {{--  TOAST area --}}
    <x-spotlight />
    <x-layout.footer />
</body>

</html>
