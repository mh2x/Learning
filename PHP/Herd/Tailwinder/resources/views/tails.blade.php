<x-layout>
    <section class="w-full px-6 pb-12 mt-5 antialiased bg-white">
        <div class="mx-auto max-w-7xl">

            <nav class="relative z-50 h-24 select-none" x-data="{ showMenu: false }">
                <div
                    class="container relative flex flex-wrap items-center justify-between h-24 mx-auto overflow-hidden font-medium border-b border-gray-200 md:overflow-visible lg:justify-center sm:px-4 md:px-2 lg:px-0">
                    <div class="flex items-center justify-start w-1/4 h-full pr-4">
                        <a href="#_" class="inline-block py-4 md:py-0">
                            <span class="p-1 text-xl font-black leading-none text-gray-900">tails.</span>
                        </a>
                        <a class="p-1 text-2xl font-bold leading-none text-blue-900 underline"
                            href="https://devdojo.com/tails/app" target="blank">GOTO Tails app</a>
                    </div>
                    <div class="top-0 left-0 items-start hidden w-full h-full p-4 text-sm bg-gray-900 bg-opacity-50 md:items-center md:w-3/4 md:absolute lg:text-base md:bg-transparent md:p-0 md:relative md:flex"
                        :class="{ 'flex fixed': showMenu, 'hidden': !showMenu }">
                        <div
                            class="flex-col w-full h-auto overflow-hidden bg-white rounded-lg md:bg-transparent md:overflow-visible md:rounded-none md:relative md:flex md:flex-row">
                            <a href="#_"
                                class="inline-flex items-center block w-auto h-16 px-6 text-xl font-black leading-none text-gray-900 md:hidden">tails<span
                                    class="text-indigo-600">.</span></a>
                            <div
                                class="flex flex-col items-start justify-center w-full space-x-6 text-center lg:space-x-8 md:w-2/3 md:mt-0 md:flex-row md:items-center">
                                <a href="#_"
                                    class="inline-block w-full py-2 mx-0 ml-6 font-medium text-left text-indigo-600 md:ml-0 md:w-auto md:px-0 md:mx-2 lg:mx-3 md:text-center">Home</a>
                                <a href="#_"
                                    class="inline-block w-full py-2 mx-0 font-medium text-left text-gray-700 md:w-auto md:px-0 md:mx-2 hover:text-indigo-600 lg:mx-3 md:text-center">Features</a>
                                <a href="#_"
                                    class="inline-block w-full py-2 mx-0 font-medium text-left text-gray-700 md:w-auto md:px-0 md:mx-2 hover:text-indigo-600 lg:mx-3 md:text-center">Blog</a>
                                <a href="#_"
                                    class="inline-block w-full py-2 mx-0 font-medium text-left text-gray-700 md:w-auto md:px-0 md:mx-2 hover:text-indigo-600 lg:mx-3 md:text-center">Contact</a>
                                <a href="#_"
                                    class="absolute top-0 left-0 hidden py-2 mt-6 ml-10 mr-2 text-gray-600 lg:inline-block md:mt-0 md:ml-2 lg:mx-3 md:relative">
                                    <svg class="inline w-5 h-5" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" class=""></path>
                                    </svg>
                                </a>
                            </div>
                            <div
                                class="flex flex-col items-start justify-end w-full pt-4 md:items-center md:w-1/3 md:flex-row md:py-0">
                                <a href="#"
                                    class="w-full px-3 py-2 mr-0 text-gray-700 md:mr-2 lg:mr-3 md:w-auto">Sign In</a>
                                <a href="#_"
                                    class="inline-flex items-center w-full px-6 py-3 text-sm font-medium leading-4 text-white bg-indigo-600 md:px-3 md:w-auto md:rounded-full lg:px-5 hover:bg-indigo-500 focus:outline-none md:focus:ring-2 focus:ring-0 focus:ring-offset-2 focus:ring-indigo-600">Sign
                                    Up</a>
                            </div>
                        </div>
                    </div>
                    <div @click="showMenu = !showMenu"
                        class="absolute right-0 flex flex-col items-center items-end justify-center w-10 h-10 bg-white rounded-full cursor-pointer md:hidden hover:bg-gray-100">
                        <svg class="w-6 h-6 text-gray-700" x-show="!showMenu" fill="none" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg class="w-6 h-6 text-gray-700" x-show="showMenu" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                </div>
            </nav>

            <!-- Main Hero Content -->
            <div class="container max-w-lg px-4 py-32 mx-auto mt-px text-left md:max-w-none md:text-center">
                <h1
                    class="text-5xl font-extrabold leading-10 tracking-tight text-left text-gray-900 md:text-center sm:leading-none md:text-6xl lg:text-7xl">
                    <span class="inline md:block">Start Crafting Your</span> <span
                        class="relative mt-2 text-transparent bg-clip-text bg-gradient-to-br from-indigo-600 to-indigo-500 md:inline-block">Next
                        Great Idea</span>
                </h1>
                <div class="mx-auto mt-5 text-gray-500 md:mt-12 md:max-w-lg md:text-center lg:text-lg">Simplifying the
                    creation of landing pages, blog pages, application pages and so much more!</div>
                <div class="flex flex-col items-center mt-12 text-center">
                    <span class="relative inline-flex w-full md:w-auto">
                        <a href="#_" type="button"
                            class="inline-flex items-center justify-center w-full px-8 py-4 text-base font-bold leading-6 text-white bg-indigo-600 border border-transparent rounded-full md:w-auto hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600">
                            Purchase Now
                        </a>
                        <span
                            class="absolute top-0 right-0 px-2 py-1 -mt-3 -mr-6 text-xs font-medium leading-tight text-white bg-green-400 rounded-full">only
                            $15/mo</span>
                    </span>
                    <a href="#_" class="mt-3 text-sm text-indigo-500">Learn More</a>
                </div>
            </div>
            <!-- End Main Hero Content -->

        </div>
    </section>
    <section class="h-auto bg-white">
        <div class="px-10 py-24 mx-auto max-w-7xl">
            <div class="w-full mx-auto text-left md:text-center">
                <h1
                    class="max-w-5xl mx-auto mb-6 text-5xl font-extrabold leading-none tracking-normal text-gray-900 sm:text-6xl md:text-6xl lg:text-7xl md:tracking-tight">
                    The <span
                        class="w-full text-transparent bg-clip-text bg-gradient-to-r from-green-400 via-blue-500 to-purple-500 lg:inline">Number
                        One Source</span> for<br class="hidden lg:block"> all your design needs. </h1>
                <p class="px-0 mb-6 text-lg text-gray-600 md:text-xl lg:px-24"> Say hello to the number one source for
                    all your design needs. Drag and drop designs, edit designs, and modify the components to help tell
                    your story. </p>
            </div>
        </div>
    </section>
    <section class="mb-5 bg-white pt-7 pb-14">
        <div class="container px-8 mx-auto sm:px-12 lg:px-20">
            <h1 class="text-sm font-bold tracking-wide text-center text-gray-800 uppercase mb-7">Trusted by top-leading
                companies.</h1>
            <div class="flex grid items-center justify-center grid-cols-4 grid-cols-12 gap-y-8">
                <div class="flex items-center justify-center col-span-6 sm:col-span-4 md:col-span-3 xl:col-span-2">
                    <img src="https://cdn.devdojo.com/tails/images/disney-plus.svg" alt="Disney Plus"
                        class="block object-contain h-12" />
                </div>
                <div class="flex items-center justify-center col-span-6 sm:col-span-4 md:col-span-3 xl:col-span-2">
                    <img src="https://cdn.devdojo.com/tails/images/google.svg" alt="Google"
                        class="block object-contain h-9" />
                </div>
                <div class="flex items-center justify-center col-span-6 sm:col-span-4 md:col-span-3 xl:col-span-2">
                    <img src="https://cdn.devdojo.com/tails/images/hubspot.svg" alt="Hubspot"
                        class="block object-contain h-9" />
                </div>
                <div class="flex items-center justify-center col-span-6 sm:col-span-4 md:col-span-3 xl:col-span-2">
                    <img src="https://cdn.devdojo.com/tails/images/youtube.svg" alt="Youtube"
                        class="block object-contain h-7 lg:h-8" />
                </div>
                <div class="flex items-center justify-center col-span-6 sm:col-span-4 md:col-span-6 xl:col-span-2">
                    <img src="https://cdn.devdojo.com/tails/images/slack.svg" alt="Slack"
                        class="block object-contain h-9" />
                </div>
                <div class="flex items-center justify-center col-span-6 sm:col-span-4 md:col-span-6 xl:col-span-2">
                    <img src="https://cdn.devdojo.com/tails/images/shopify.svg" alt="Shopify"
                        class="block object-contain h-9" />
                </div>
            </div>
        </div>
    </section>
</x-layout>
