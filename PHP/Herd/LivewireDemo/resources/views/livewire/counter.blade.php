<div>
    <h1>Count: {{ $count }}</h1> <button wire:click='increment'>Increment</button>
    <button class="p-1 m-1 border border-red-600" wire:click='increment(10)'>Increment by 10</button>

    <h1 class="p-1 m-1 text-red-600">Refresh: {{ now() }}</h1>
    <h2 wire:click.window='$refresh'>Refresh page: click anywhere inside the window with click.window!</h2>
    <!-- You can do throttling like this -->
    <button class="p-1 m-1 border border-red-600" wire:click.throttle.1000ms='increment'>Slow Increment</button>
</div>
