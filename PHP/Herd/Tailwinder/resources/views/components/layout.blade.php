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

</head>

<body class="h-full pb-20 text-white bg-gray-900">
    <div class="bg-header">
        <nav class="flex items-center justify-between px-10 py-4 border-b border-white/20">
            <div>
                <a href="/">
                    <img src="{{ Vite::asset('resources/images/codenzia_logo.png') }}" alt="" />
                </a>
            </div>
            <div class="space-x-6 font-bold">
                <a href="/">Jobs</a>
                <a href="#">Careers</a>
                <a href="#">Salaries</a>
                <a href="#">Companies</a>
            </div>
        </nav>
    </div>
    <div class="px-10">
        <main class="mt-10 max-w-[986px] mx-auto">
            {{ $slot }}
        </main>
    </div>
</body>

</html>
