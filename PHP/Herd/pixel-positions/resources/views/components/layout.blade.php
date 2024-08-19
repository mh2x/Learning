<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pixel Positions by Codenzia</title>
    <!-- https://fonts.google.com/specimen/Hanken+Grotesk -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@400;500;600&display=swap"
        rel="stylesheet">

    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body class="bg-black text-white font-hanken-grotesk pb-20">
    <div class="bg-header">
        <nav class="flex px-10 justify-between items-center py-4 border-b border-white/20">
            <div>
                <a href="">
                    <img src="{{ Vite::asset('resources/images/codenzia_logo.png') }}" alt="" />
                </a>
            </div>
            <div class="space-x-6 font-bold">
                <a href="#">Jobs</a>
                <a href="#">Careers</a>
                <a href="#">Salaries</a>
                <a href="#">Companies</a>
            </div>
            @auth
                <div>
                    <a href="/jobs/create">Post a Job</a>
                </div>
            @endauth
            @guest
                <div class="space-x-6 font-bold">
                    <a href="/register">Register</a>
                    <a href="/login">Login</a>
                </div>
            @endguest

        </nav>
    </div>
    <div class="px-10">
        <main class="mt-10 max-w-[986px] mx-auto">
            {{ $slot }}
        </main>
    </div>
</body>

</html>
