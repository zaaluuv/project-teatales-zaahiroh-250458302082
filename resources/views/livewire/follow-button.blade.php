<div>
    @if(auth()->id() !== $author->id)
        <button 
            wire:click="toggleFollow" 
            wire:loading.attr="disabled"
            class="transition-all duration-200 ease-in-out px-5 py-2 rounded-lg text-sm font-semibold shadow-sm flex items-center gap-2 border
            {{ $isFollowing ? 'bg-gray-100 text-gray-700 border-gray-200 hover:bg-red-50 hover:text-red-600 hover:border-red-200' : 'bg-teal-600 text-white border-transparent hover:bg-teal-700' }}
            opacity-100 disabled:opacity-70">
            
            @if ($isFollowing)
                <i class="fa-solid fa-check" wire:loading.remove></i>
                <span wire:loading.remove>Following</span>
                
            @else
                <i class="fa-solid fa-user-plus" wire:loading.remove></i>
                <span wire:loading.remove>Follow</span>
            @endif

            <div wire:loading>
                <i class="fa-solid fa-circle-notch fa-spin"></i>
                <span>Proses...</span>
            </div>
        </button>
    @endif
</div>