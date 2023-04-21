<div>
    {{-- if the post has not been liked display like button --}}
    @if (!self::hasLiked($guitar->id, $currentUser->id))
        <button wire:click="likeDislike({{ $guitar->id }}, {{ $currentUser->id }})" class="mt-3 rounded border px-4">Like
            </button>

        {{-- else display dislike button --}}
    @else
        <button wire:click="likeDislike({{ $guitar->id }}, {{ $currentUser->id }})"
            class="mt-3 rounded bg-gray-700 border px-4 text-white bg-slate-950">Dislike</button>
    @endif
</div>
