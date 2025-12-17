<div>
<div class="flex items-center bg-white p-2 rounded-full shadow-md max-w-2xl mx-auto mb-10 border border-gray-100">
        
        <input type="text" placeholder="Cari cerita..." class="flex-grow px-4 py-2 bg-transparent focus:outline-none text-gray-700 placeholder-gray-400 rounded-l-full" wire:model.live.debounce.300ms="search">

        <div class="h-6 w-px bg-gray-300 mx-2"></div>

        <div class="relative min-w-[140px]">
            <select wire:model.live="category" class="w-full appearance-none bg-transparent border-none text-sm font-semibold text-gray-600 focus:ring-0 cursor-pointer py-2 pl-2 pr-8 hover:text-teal-600 transition outline-none truncate">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <button class="bg-teal-600 text-white p-3 rounded-full hover:bg-teal-700 transition-colors shadow-sm ml-2 shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($posts as $post)
            @include('components.post-card', ['post' => $post])
        @empty
            <div class="col-span-full text-center py-24 font-semibold">No Stories Yet</div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $posts->links() }}
    </div>
</div>