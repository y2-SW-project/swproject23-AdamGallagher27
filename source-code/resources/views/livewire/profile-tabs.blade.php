<div>
    <button wire:click="$set('show', true)">All</button>
    <button wire:click="$set('show', false)">Likes</button>
    @if ($show)
    all products
    {{ $products }}
    @else
        liked products
        {{ $likes }}
    @endif
</div>
