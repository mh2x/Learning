<footer class="mt-1 p-2">
    <div class="w-full flex flex-row justify-center items-center mt-3 mb-3">
        <x-footer-menu />
    </div>
    <div class="text-center text-sm">
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        <p class="text-secondary mt-2">environment: {{ app()['env'] }}</p>
    </div>
</footer>
