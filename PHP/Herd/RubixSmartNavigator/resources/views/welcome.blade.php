<x-app-layout>
    <div class="relative h-screen w-full flex items-center justify-center bg-cover bg-center text-center px-5"
        style="background-image:url(https://images.pexels.com/photos/5203420/pexels-photo-5203420.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1);">
        <div>
            <div class="mx-auto px-6 lg:px-8 flex flex-col items-center justify-center text-center">
                <header class="items-center gap-2 py-10">
                    @if (Route::has('login'))
                        <nav class="-mx-3 flex flex-1 justify-center mb-10">
                            @auth

                                <a href="{{ route('dashboard') }}"
                                    class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-md">{{ __('Dashboard') }}</a>
                            @else
                                <div class="p-4 m-4">
                                    <a href="{{ route('login') }}"
                                        class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-md">{{ __('Login') }}</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}"
                                            class="bg-violet-500 hover:bg-violet-600 text-white px-4 py-2 rounded-md">{{ __('Register') }}</a>
                                    @endif
                                </div>
                            @endauth
                        </nav>
                    @endif
                    <div>
                        <img src="{{ asset('/images/app_logo.png') }}" alt="app logo" />
                    </div>
                </header>

                <section class="py-20 justify-center h-full w-full">
                    <div class="mx-auto px-6 lg:px-8 flex flex-col items-center justify-center text-center">
                        <h2 class="text-4xl lg:text-5xl font-bold mb-8">Our Product is Coming Soon!!</h2>
                        <p class="text-violet-800 text-lg lg:text-l leading-relaxed mb-12 font-bold">
                            Stay tuned for updates and get ready for an extraordinary experience coming to you on or
                            around March 30th, 2025!
                        </p>
                        <div class="flex flex-wrap items-center justify-center gap-4 p-2">
                            <div class="bg-indigo-400 rounded-full px-6 py-2 min-w-[120px]">
                                <div id="days" class="font-bold text-xl text-gray-800"></div>
                                <div class="text-xs uppercase text-gray-500">days</div>
                            </div>
                            <div class="bg-violet-300 rounded-full px-6 py-2 min-w-[120px]">
                                <div id="hours" class="font-bold text-xl text-gray-800"></div>
                                <div class="text-xs uppercase text-gray-500">hours</div>
                            </div>
                            <div class="bg-green-300 rounded-full px-6 py-2 min-w-[120px]">
                                <div id="minutes" class="font-bold text-xl text-gray-800"></div>
                                <div class="text-xs uppercase text-gray-500">minutes</div>
                            </div>
                            <div class="bg-yellow-300 rounded-full px-6 py-2 min-w-[120px]">
                                <div id="seconds" class="font-bold text-xl text-gray-800"></div>
                                <div class="text-xs uppercase text-gray-500">seconds</div>
                            </div>
                        </div>
                    </div>
                </section>

                <script>
                    // Set the date we're counting down to
                    var countDownDate = new Date("March 30, 2025 00:00:00").getTime();

                    // Update the countdown every 1 second
                    var x = setInterval(function() {

                        // Get today's date and time
                        var now = new Date().getTime();

                        // Find the distance between now and the count down date
                        var distance = countDownDate - now;

                        // Time calculations for days, hours, minutes and seconds
                        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                        // Display the result in the corresponding elements
                        document.getElementById("days").textContent = days + "d";
                        document.getElementById("hours").textContent = hours + "h";
                        document.getElementById("minutes").textContent = minutes + "m";
                        document.getElementById("seconds").textContent = seconds + "s";


                        // If the count down is over, write some text 
                        if (distance < 0) {
                            clearInterval(x);
                            document.getElementById("countdown").innerHTML = "EXPIRED";
                        }
                    }, 1000);
                </script>
            </div>
            <footer class="py-16 text-center text-lg font-bold">
                Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
            </footer>
        </div>
    </div>
</x-app-layout>
