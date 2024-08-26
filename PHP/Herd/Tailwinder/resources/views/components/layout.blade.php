<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tailwinder by Codenzia</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Apline.js -->
    <!-- https://alpinejs.dev/start-here -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="w-full h-full text-white">
    <header>
        <div class="min-h-full">
            <nav class="bg-white">
                <div class="px-4 mx-auto sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-16">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <a href="/" class="-m-1.5 p-1.5">
                                    <img src="{{ Vite::asset('resources/images/codenzia_logo.png') }}" alt="" />
                                </a>
                            </div>
                            <div class="hidden md:block">
                                <div class="flex items-baseline ml-10 space-x-4">
                                    <x-menu />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile menu, show/hide based on menu state. -->
                    <div class="md:hidden" id="mobile-menu">
                        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                            <x-menu />
                        </div>
                    </div>
            </nav>
        </div>
    </header>

    <main class="flex flex-col items-center w-full h-full bg-gray-900">
        <div class="justify-between px-4 mx-auto my-auto">
            {{ $slot }}
        </div>
    </main>
    <footer class="block text-sm text-center text-white bg-slate-700">
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    </footer>
</body>

</html>
