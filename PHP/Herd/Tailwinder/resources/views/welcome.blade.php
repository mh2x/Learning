<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Tailwinder</title>



    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
</head>

<body class="m-10  w-full h-full flex flex-col items-center font-sans antialiased dark:bg-black dark:text-white/50">
    <div class="flex flex-col items-center bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <h1 class="text-violet-600 text-3xl font-bold m-10">
            TailWinder v 1.0.0
        </h1>
        <div class="p-6 max-w-sm mx-auto bg-white rounded-xl shadow-lg flex items-center space-x-4">
            <div class="shrink-0">
                <img class="size-12" src="/img/logo.svg" alt="ChitChat Logo">
            </div>
            <div>
                <div class="text-xl font-medium text-black">ChitChat</div>
                <p class="text-slate-500">You have a new message!</p>
            </div>
        </div>
        <footer class="py-16 text-center text-sm text-black dark:text-white/70">
            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </footer>
    </div>
</body>

</html>
