<div class="flex items-center justify-between p-3 border-t hover:bg-gray-200/5">
    <div class="flex items-center">
        <div class="flex flex-col ml-2 space-y-3">
            <div class="text-xl font-bold leading-snug text-white">TODO Name</div>
            <div class="leading-snug text-gray-400 text-md hover:text-gray-600">{{ now() }}</div>
            <div class="leading-snug text-blue-400 text-md hover:text-gray-600">status</div>
        </div>
    </div>
    <div class="flex flex-row space-x-1">
        <button
            class="h-8 px-3 font-bold text-blue-400 border border-blue-400 rounded-full cursor-pointer text-md hover:bg-blue-100">Edit</button>
        <button
            class="h-8 px-3 font-bold text-red-400 border border-red-400 rounded-full cursor-pointer text-md hover:bg-red-100">Delete</button>
    </div>
</div>
