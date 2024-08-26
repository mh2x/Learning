<x-layout>
    <h1 class="mb-4 text-4xl font-bold text-white">DaisyUI Samples</h1>
    <button class="btn btn-link">
        <a href="https://daisyui.com/components/button/" target="_blank">GOTO Buttons</a>
    </button>
    <div>
        <p>Buttons with brand colors:</p>
        <button class="btn">Button</button>
        <button class="btn btn-neutral">Neutral</button>
        <button class="btn btn-primary">Primary</button>
        <button class="btn btn-secondary">Secondary</button>
        <button class="btn btn-accent">Accent</button>
        <button class="btn btn-ghost">Ghost</button>
        <button class="btn btn-link">Link</button>
    </div>
    <div>
        <p>Buttons with state colors:</p>
        <button class="btn btn-info">Info</button>
        <button class="btn btn-success">Success</button>
        <button class="btn btn-warning">Warning</button>
        <button class="btn btn-error">Error</button>
    </div>
    <div>
        <p>Outline:</p>
        <button class="btn btn-outline">Default</button>
        <button class="btn btn-outline btn-primary">Primary</button>
        <button class="btn btn-outline btn-secondary">Secondary</button>
        <button class="btn btn-outline btn-accent">Accent</button>
    </div>
    <div>
        <p>Button sizes:</p>
        <button class="btn btn-lg">Large</button>
        <button class="btn">Normal</button>
        <button class="btn btn-sm">Small</button>
        <button class="btn btn-xs">Tiny</button>
    </div>
    <div>
        <p>Responsive Button:</p>
        <button class="btn btn-xs sm:btn-sm md:btn-md lg:btn-lg">Responsive</button>
    </div>
    <div>
        <p>SVG Buttons:</p>
        <button class="btn btn-square">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <button class="btn btn-square btn-outline">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <button class="btn btn-circle">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <button class="btn btn-circle btn-outline">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <button class="btn">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
            Button
        </button>
        <button class="btn">
            Button
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
        </button>
    </div>
    <div>
        <button class="btn btn-link">
            <a href="https://daisyui.com/components/dropdown/" target="_blank">GOTO Dropdown</a>
        </button>
        <p>Dropdown:</p>
        <details class="dropdown">
            <summary class="m-1 btn">open or close</summary>
            <ul class="menu dropdown-content bg-base-100 rounded-box z-[1] w-52 p-2 shadow">
                <li><a>Item 1</a></li>
                <li><a>Item 2</a></li>
            </ul>
        </details>
        <p>Opens on hover</p>
        <div class="dropdown dropdown-hover">
            <div tabindex="0" role="button" class="m-1 btn">Hover</div>
            <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow">
                <li><a>Item 1</a></li>
                <li><a>Item 2</a></li>
            </ul>
        </div>
        <div>
            <button class="btn btn-link">
                <a href="https://daisyui.com/components/modal/" target="_blank">GOTO Modal</a>
            </button>
            <p>Modal:</p>
            <!-- Open the modal using ID.showModal() method -->
            <button class="btn" onclick="my_modal_1.showModal()">open modal</button>
            <dialog id="my_modal_1" class="modal">
                <div class="modal-box">
                    <h3 class="text-lg font-bold">Hello!</h3>
                    <p class="py-4">Press ESC key or click the button below to close</p>
                    <div class="modal-action">
                        <form method="dialog">
                            <!-- if there is a button in form, it will close the modal -->
                            <button class="btn">Close</button>
                        </form>
                    </div>
                </div>
            </dialog>
        </div>
        <div>
            <button class="btn btn-link">
                <a href="https://daisyui.com/components/swap/" target="_blank">GOTO Swap</a>
            </button>
            <p>Swap:</p>
            <label class="swap">
                <input type="checkbox" />
                <div class="swap-on">ON</div>
                <div class="swap-off">OFF</div>
            </label>
        </div>
        <label class="swap">
            <!-- this hidden checkbox controls the state -->
            <input type="checkbox" />

            <!-- volume on icon -->
            <svg class="fill-current swap-on" xmlns="http://www.w3.org/2000/svg" width="48" height="48"
                viewBox="0 0 24 24">
                <path
                    d="M14,3.23V5.29C16.89,6.15 19,8.83 19,12C19,15.17 16.89,17.84 14,18.7V20.77C18,19.86 21,16.28 21,12C21,7.72 18,4.14 14,3.23M16.5,12C16.5,10.23 15.5,8.71 14,7.97V16C15.5,15.29 16.5,13.76 16.5,12M3,9V15H7L12,20V4L7,9H3Z" />
            </svg>

            <!-- volume off icon -->
            <svg class="fill-current swap-off" xmlns="http://www.w3.org/2000/svg" width="48" height="48"
                viewBox="0 0 24 24">
                <path
                    d="M3,9H7L12,4V20L7,15H3V9M16.59,12L14,9.41L15.41,8L18,10.59L20.59,8L22,9.41L19.41,12L22,14.59L20.59,16L18,13.41L15.41,16L14,14.59L16.59,12Z" />
            </svg>
        </label>
        <label class="swap swap-rotate">
            <!-- this hidden checkbox controls the state -->
            <input type="checkbox" />

            <!-- sun icon -->
            <svg class="w-10 h-10 fill-current swap-on" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path
                    d="M5.64,17l-.71.71a1,1,0,0,0,0,1.41,1,1,0,0,0,1.41,0l.71-.71A1,1,0,0,0,5.64,17ZM5,12a1,1,0,0,0-1-1H3a1,1,0,0,0,0,2H4A1,1,0,0,0,5,12Zm7-7a1,1,0,0,0,1-1V3a1,1,0,0,0-2,0V4A1,1,0,0,0,12,5ZM5.64,7.05a1,1,0,0,0,.7.29,1,1,0,0,0,.71-.29,1,1,0,0,0,0-1.41l-.71-.71A1,1,0,0,0,4.93,6.34Zm12,.29a1,1,0,0,0,.7-.29l.71-.71a1,1,0,1,0-1.41-1.41L17,5.64a1,1,0,0,0,0,1.41A1,1,0,0,0,17.66,7.34ZM21,11H20a1,1,0,0,0,0,2h1a1,1,0,0,0,0-2Zm-9,8a1,1,0,0,0-1,1v1a1,1,0,0,0,2,0V20A1,1,0,0,0,12,19ZM18.36,17A1,1,0,0,0,17,18.36l.71.71a1,1,0,0,0,1.41,0,1,1,0,0,0,0-1.41ZM12,6.5A5.5,5.5,0,1,0,17.5,12,5.51,5.51,0,0,0,12,6.5Zm0,9A3.5,3.5,0,1,1,15.5,12,3.5,3.5,0,0,1,12,15.5Z" />
            </svg>

            <!-- moon icon -->
            <svg class="w-10 h-10 fill-current swap-off" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path
                    d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z" />
            </svg>
        </label>
        <label class="swap swap-flip text-9xl">
            <!-- this hidden checkbox controls the state -->
            <input type="checkbox" />

            <div class="swap-on">😈</div>
            <div class="swap-off">😇</div>
        </label>
    </div>
    <div>
        <button class="btn btn-link">
            <a href="https://daisyui.com/components/accordion/" target="_blank">GOTO Accordion</a>
        </button>
        <p>Accordion:</p>
        <div class="collapse collapse-arrow bg-base-200">
            <input type="radio" name="my-accordion-2" checked="checked" />
            <div class="text-xl font-medium collapse-title">Click to open this one and close others</div>
            <div class="collapse-content">
                <p>hello</p>
            </div>
        </div>
        <div class="collapse collapse-arrow bg-base-200">
            <input type="radio" name="my-accordion-2" />
            <div class="text-xl font-medium collapse-title">Click to open this one and close others</div>
            <div class="collapse-content">
                <p>hello</p>
            </div>
        </div>
        <div class="collapse collapse-arrow bg-base-200">
            <input type="radio" name="my-accordion-2" />
            <div class="text-xl font-medium collapse-title">Click to open this one and close others</div>
            <div class="collapse-content">
                <p>hello</p>
            </div>
        </div>
    </div>
    <div class="m-4 p-14">
        <button class="btn btn-link">
            <a href="https://daisyui.com/components/card/" target="_blank">GOTO Card</a>
        </button>
        <p>Card:</p>
        <div class="shadow-xl card bg-base-100 w-96">
            <figure>
                <img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp"
                    alt="Shoes" />
            </figure>
            <div class="card-body">
                <h2 class="card-title">Shoes!</h2>
                <p>If a dog chews shoes whose shoes does he choose?</p>
                <div class="justify-end card-actions">
                    <button class="btn btn-primary">Buy Now</button>
                </div>
            </div>
        </div>
        <div class="shadow-xl card bg-base-100 w-96">
            <figure>
                <img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp"
                    alt="Shoes" />
            </figure>
            <div class="card-body">
                <h2 class="card-title">
                    Shoes!
                    <div class="badge badge-secondary">NEW</div>
                </h2>
                <p>If a dog chews shoes whose shoes does he choose?</p>
                <div class="justify-end card-actions">
                    <div class="badge badge-outline">Fashion</div>
                    <div class="badge badge-outline">Products</div>
                </div>
            </div>
        </div>
        <div class="card bg-primary text-primary-content w-96">
            <div class="card-body">
                <h2 class="card-title">Card title!</h2>
                <p>If a dog chews shoes whose shoes does he choose?</p>
                <div class="justify-end card-actions">
                    <button class="btn">Buy Now</button>
                </div>
            </div>
        </div>
        <div class="card bg-neutral text-neutral-content w-96">
            <div class="items-center text-center card-body">
                <h2 class="card-title">Cookies!</h2>
                <p>We are using cookies for no reason.</p>
                <div class="justify-end card-actions">
                    <button class="btn btn-primary">Accept</button>
                    <button class="btn btn-ghost">Deny</button>
                </div>
            </div>
        </div>
        <div class="shadow-xl card card-side bg-base-100">
            <figure>
                <img src="https://img.daisyui.com/images/stock/photo-1635805737707-575885ab0820.webp"
                    alt="Movie" />
            </figure>
            <div class="card-body">
                <h2 class="card-title">New movie is released!</h2>
                <p>Click the button to watch on Jetflix app.</p>
                <div class="justify-end card-actions">
                    <button class="btn btn-primary">Watch</button>
                </div>
            </div>
        </div>
    </div>
    <div>
        <button class="btn btn-link">
            <a href="https://daisyui.com/components/carousel/" target="_blank">GOTO Carousel</a>
        </button>
        <p>Carousel:</p>
        <div class="max-w-md p-4 space-x-4 carousel carousel-center bg-neutral rounded-box">
            <div class="carousel-item">
                <img src="https://img.daisyui.com/images/stock/photo-1559703248-dcaaec9fab78.webp"
                    class="rounded-box" />
            </div>
            <div class="carousel-item">
                <img src="https://img.daisyui.com/images/stock/photo-1565098772267-60af42b81ef2.webp"
                    class="rounded-box" />
            </div>
            <div class="carousel-item">
                <img src="https://img.daisyui.com/images/stock/photo-1572635148818-ef6fd45eb394.webp"
                    class="rounded-box" />
            </div>
            <div class="carousel-item">
                <img src="https://img.daisyui.com/images/stock/photo-1494253109108-2e30c049369b.webp"
                    class="rounded-box" />
            </div>
            <div class="carousel-item">
                <img src="https://img.daisyui.com/images/stock/photo-1550258987-190a2d41a8ba.webp"
                    class="rounded-box" />
            </div>
            <div class="carousel-item">
                <img src="https://img.daisyui.com/images/stock/photo-1559181567-c3190ca9959b.webp"
                    class="rounded-box" />
            </div>
            <div class="carousel-item">
                <img src="https://img.daisyui.com/images/stock/photo-1601004890684-d8cbf643f5f2.webp"
                    class="rounded-box" />
            </div>
        </div>
    </div>
    <div>
        <button class="btn btn-link">
            <a href="https://daisyui.com/components/chat/" target="_blank">GOTO Chat bubble</a>
        </button>
        <p>Chat bubble:</p>
        <div class="chat chat-start">
            <div class="chat-image avatar">
                <div class="w-10 rounded-full">
                    <img alt="Tailwind CSS chat bubble component"
                        src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                </div>
            </div>
            <div class="chat-bubble">It was said that you would, destroy the Sith, not join them.</div>
        </div>
        <div class="chat chat-start">
            <div class="chat-image avatar">
                <div class="w-10 rounded-full">
                    <img alt="Tailwind CSS chat bubble component"
                        src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                </div>
            </div>
            <div class="chat-bubble">It was you who would bring balance to the Force</div>
        </div>
        <div class="chat chat-start">
            <div class="chat-image avatar">
                <div class="w-10 rounded-full">
                    <img alt="Tailwind CSS chat bubble component"
                        src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                </div>
            </div>
            <div class="chat-bubble">Not leave it in Darkness</div>
        </div>
        <div class="chat chat-start">
            <div class="chat-bubble chat-bubble-primary">What kind of nonsense is this</div>
        </div>
        <div class="chat chat-start">
            <div class="chat-bubble chat-bubble-secondary">
                Put me on the Council and not make me a Master!??
            </div>
        </div>
        <div class="chat chat-start">
            <div class="chat-bubble chat-bubble-accent">
                That's never been done in the history of the Jedi. It's insulting!
            </div>
        </div>
        <div class="chat chat-end">
            <div class="chat-bubble chat-bubble-info">Calm down, Anakin.</div>
        </div>
        <div class="chat chat-end">
            <div class="chat-bubble chat-bubble-success">You have been given a great honor.</div>
        </div>
        <div class="chat chat-end">
            <div class="chat-bubble chat-bubble-warning">To be on the Council at your age.</div>
        </div>
        <div class="chat chat-end">
            <div class="chat-bubble chat-bubble-error">It's never happened before.</div>
        </div>
    </div>
    <div>
        <button class="btn btn-link">
            <a href="https://daisyui.com/components/countdown/" target="_blank">GOTO Countdowwn</a>
        </button>
        <p>Countdown:</p>
        <div class="grid grid-flow-col gap-5 text-center auto-cols-max">
            <div class="flex flex-col">
                <span class="font-mono text-5xl countdown">
                    <span style="--value:15;"></span>
                </span>
                days
            </div>
            <div class="flex flex-col">
                <span class="font-mono text-5xl countdown">
                    <span style="--value:10;"></span>
                </span>
                hours
            </div>
            <div class="flex flex-col">
                <span class="font-mono text-5xl countdown">
                    <span style="--value:24;"></span>
                </span>
                min
            </div>
            <div class="flex flex-col">
                <span class="font-mono text-5xl countdown">
                    <span style="--value:${counter};"></span>
                </span>
                sec
            </div>
        </div>
        <div class="grid grid-flow-col gap-5 text-center auto-cols-max">
            <div class="flex flex-col p-2 bg-neutral rounded-box text-neutral-content">
                <span class="font-mono text-5xl countdown">
                    <span style="--value:15;"></span>
                </span>
                days
            </div>
            <div class="flex flex-col p-2 bg-neutral rounded-box text-neutral-content">
                <span class="font-mono text-5xl countdown">
                    <span style="--value:10;"></span>
                </span>
                hours
            </div>
            <div class="flex flex-col p-2 bg-neutral rounded-box text-neutral-content">
                <span class="font-mono text-5xl countdown">
                    <span style="--value:24;"></span>
                </span>
                min
            </div>
            <div class="flex flex-col p-2 bg-neutral rounded-box text-neutral-content">
                <span class="font-mono text-5xl countdown">
                    <span style="--value:${counter};"></span>
                </span>
                sec
            </div>
        </div>
    </div>
    <div>
        <button class="btn btn-link">
            <a href="https://daisyui.com/components/stat/" target="_blank">GOTO Stat</a>
        </button>
        <p>Stat:</p>
        <div class="shadow stats">
            <div class="stat">
                <div class="stat-figure text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        class="inline-block w-8 h-8 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                        </path>
                    </svg>
                </div>
                <div class="stat-title">Total Likes</div>
                <div class="stat-value text-primary">25.6K</div>
                <div class="stat-desc">21% more than last month</div>
            </div>

            <div class="stat">
                <div class="stat-figure text-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        class="inline-block w-8 h-8 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <div class="stat-title">Page Views</div>
                <div class="stat-value text-secondary">2.6M</div>
                <div class="stat-desc">21% more than last month</div>
            </div>

            <div class="stat">
                <div class="stat-figure text-secondary">
                    <div class="avatar online">
                        <div class="w-16 rounded-full">
                            <img src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                        </div>
                    </div>
                </div>
                <div class="stat-value">86%</div>
                <div class="stat-title">Tasks done</div>
                <div class="stat-desc text-secondary">31 tasks remaining</div>
            </div>
        </div>
        <div>
            <div class="stats bg-primary text-primary-content">
                <div class="stat">
                    <div class="stat-title">Account balance</div>
                    <div class="stat-value">$89,400</div>
                    <div class="stat-actions">
                        <button class="btn btn-sm btn-success">Add funds</button>
                    </div>
                </div>

                <div class="stat">
                    <div class="stat-title">Current balance</div>
                    <div class="stat-value">$89,400</div>
                    <div class="stat-actions">
                        <button class="btn btn-sm">Withdrawal</button>
                        <button class="btn btn-sm">Deposit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout>
