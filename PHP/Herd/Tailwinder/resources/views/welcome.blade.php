<x-layout>
    <div class="flex flex-col items-center text-black/5 dark:text-white/50">
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
</x-layout>
