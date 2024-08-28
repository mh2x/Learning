<div class="flex items-center justify-between p-3 border-t hover:bg-white/10">
    <div class="flex items-center">
        <div class="flex flex-col ml-2 space-y-3">
            <div class="text-xl font-bold leading-snug text-white">TODO Name</div>
            <div class="leading-snug text-gray-400 text-md">{{ now() }}</div>
            <div class="leading-snug text-green-400 text-md">status</div>
        </div>
    </div>
    <div class="flex flex-row space-x-1">
        <button
            class="h-8 px-3 font-bold text-blue-400 border border-blue-400 rounded-full cursor-pointer text-md hover:bg-blue-400/25">Edit</button>
        <button
            class="h-8 px-3 font-bold text-red-400 border border-red-400 rounded-full cursor-pointer text-md hover:bg-red-400/25">Delete</button>
    </div>
</div>
