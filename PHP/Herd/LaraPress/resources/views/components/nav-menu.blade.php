@props(['type' => 'top', 'id'])

<div class='hover:cursor-pointer'>

    @if ($type === 'top')
        <ul class="menu menu-vertical lg:menu-horizontal rounded-box">
            <p>Top Menu</p>
        </ul>
    @else
    @endif
</div>
