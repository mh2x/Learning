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

<body class="flex flex-col items-center w-full h-full m-10 font-sans antialiased dark:bg-black dark:text-white/50">
    <div class="flex flex-col items-center bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <h1 class="text-3xl font-bold text-violet-600">
            ✨✨ TailWinder ✨✨
        </h1>
        <h2>v 1.0.0</h2>
        <div class="flex items-center max-w-sm p-6 mx-auto mt-4 space-x-4 bg-white shadow-lg rounded-xl">
            <div class="flex flex-col items-center p-5 m-5">
                <div class="mb-4 text-2xl font-bold text-black">❤❤ Laravel ❤❤</div>
                <p class="text-slate-500">Welcome to Tailwinder!</p>
            </div>
        </div>
        <footer class="py-16 text-sm text-center text-black dark:text-white/70">
            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </footer>
    </div>
</body>

</html>
