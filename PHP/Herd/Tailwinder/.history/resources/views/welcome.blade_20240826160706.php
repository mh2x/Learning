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

<body class="w-full h-full flex flex-col items-center font-sans antialiased dark:bg-black dark:text-white/50">
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <h1 class="text-green-600 text-3xl font-bold underline">
            Hello world!
        </h1>
        <div class="relative flex min-h-screen flex-col justify-center overflow-hidden bg-gray-50 py-6 sm:py-12">
            <img src="/img/beams.jpg" alt=""
                class="absolute top-1/2 left-1/2 max-w-none -translate-x-1/2 -translate-y-1/2" width="1308" />
            <div
                class="absolute inset-0 bg-[url(/img/grid.svg)] bg-center [mask-image:linear-gradient(180deg,white,rgba(255,255,255,0))]">
            </div>
            <div
                class="relative bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:mx-auto sm:max-w-lg sm:rounded-lg sm:px-10">
                <div class="mx-auto max-w-md">
                    <img src="/img/logo.svg" class="h-6" alt="Tailwind Play" />
                    <div class="divide-y divide-gray-300/50">
                        <div class="space-y-6 py-8 text-base leading-7 text-gray-600">
                            <p>An advanced online playground for Tailwind CSS, including support for things like:</p>
                            <ul class="space-y-4">
                                <li class="flex items-center">
                                    <svg class="h-6 w-6 flex-none fill-sky-100 stroke-sky-500 stroke-2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="11" />
                                        <path d="m8 13 2.165 2.165a1 1 0 0 0 1.521-.126L16 9" fill="none" />
                                    </svg>
                                    <p class="ml-4">
                                        Customizing your
                                        <code class="text-sm font-bold text-gray-900">tailwind.config.js</code> file
                                    </p>
                                </li>
                                <li class="flex items-center">
                                    <svg class="h-6 w-6 flex-none fill-sky-100 stroke-sky-500 stroke-2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="11" />
                                        <path d="m8 13 2.165 2.165a1 1 0 0 0 1.521-.126L16 9" fill="none" />
                                    </svg>
                                    <p class="ml-4">
                                        Extracting classes with
                                        <code class="text-sm font-bold text-gray-900">@apply</code>
                                    </p>
                                </li>
                                <li class="flex items-center">
                                    <svg class="h-6 w-6 flex-none fill-sky-100 stroke-sky-500 stroke-2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="11" />
                                        <path d="m8 13 2.165 2.165a1 1 0 0 0 1.521-.126L16 9" fill="none" />
                                    </svg>
                                    <p class="ml-4">Code completion with instant preview</p>
                                </li>
                            </ul>
                            <p>Perfect for learning how the framework works, prototyping a new idea, or creating a demo
                                to share online.</p>
                        </div>
                        <div class="pt-8 text-base font-semibold leading-7">
                            <p class="text-gray-900">Want to dig deeper into Tailwind?</p>
                            <p>
                                <a href="https://tailwindcss.com/docs" class="text-sky-500 hover:text-sky-600">Read the
                                    docs &rarr;</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="py-16 text-center text-sm text-black dark:text-white/70">
            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </footer>
    </div>
</body>

</html>
