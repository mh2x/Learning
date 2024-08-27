<div>
    <h1>Count: {{ $count }}</h1> <button wire:click='increment'>Increment</button>
    <button wire:click='increment(10)'>Increment by 10</button>

    <h2 wire:click.window='$refresh'>Refresh page: click anywhere inside the window with click.window!</h2>
    <!-- You can do throttling like this -->
    <button wire:click.throttle.1000ms='increment'>Increment 2</button>
</div>
