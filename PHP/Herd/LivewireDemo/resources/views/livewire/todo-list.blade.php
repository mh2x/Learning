<div>
    <div class="dark:bg-gray-800">
        <div class="dark:bg-transparent">
            <div class="flex flex-col items-center py-12 mx-auto sm:py-24">
                <div class="flex-col items-center justify-center w-11/12 mb-5 sm:w-2/3 lg:flex sm:mb-10">
                    <h1
                        class="text-3xl font-black leading-10 text-center text-gray-800 sm:text-4xl md:text-4xl lg:text-4xl xl:text-5xl dark:text-white">
                        What do you want to do
                        <span class="text-violet-800 dark:text-green-500">Today?</span>
                    </h1>
                    <p
                        class="mt-5 mb-8 text-xl font-normal text-center text-gray-600 sm:mt-10 lg:w-10/12 dark:text-gray-300">
                        A Livewire TODO List by Mohammad Elhaj.
                    </p>
                    <div class="flex flex-col items-end justify-between w-11/12 md:w-8/12 xl:w-6/12">
                        <div class="flex w-full rounded-md">
                            <input type="text" name="todo"
                                class="w-full p-3 placeholder-current border border-2 border-gray-300 rounded-md rounded-r-none dark:bg-gray-500 dark:text-gray-300 dark:border-none"
                                placeholder="Add new todo...">
                        </div>
                        <div class="mt-2">
                            <button
                                class="h-12 px-6 text-xl font-bold text-green-400 border border-green-400 rounded-full cursor-pointer text-md hover:bg-green-100/15">Create</button>
                        </div>
                    </div>
                </div>
                <!-- Search control -->
                <div class="flex w-11/12 md:w-8/12 xl:w-6/12">
                    <div class="flex w-full rounded-md">
                        <input type="text" name="q"
                            class="w-full p-3 placeholder-current border border-2 border-gray-300 rounded-md rounded-r-none dark:bg-gray-500 dark:text-gray-300 dark:border-none "
                            placeholder="search todos..." />
                        <button
                            class="inline-flex items-center gap-2 px-6 py-3 text-lg font-semibold text-white bg-green-700 rounded-r-md">
                            <span>Find</span>
                            <svg class="w-5 h-5 p-0 text-gray-200 fill-current" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px"
                                viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;"
                                xml:space="preserve">
                                <path
                                    d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <!-- END SEARCH -->
            </div>
        </div>
    </div>
    <div class="max-w-xl mx-auto">
        <livewire:todo-item />
        <livewire:todo-item />
        <livewire:todo-item />
        <livewire:todo-item />
    </div>
</div>
