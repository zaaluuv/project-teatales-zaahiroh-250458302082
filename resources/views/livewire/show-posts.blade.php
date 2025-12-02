<div>
    <div class="flex bg-white p-2 rounded-full shadow-md max-w-lg">
        <input type="text" placeholder="Search for stories, places, authors..." class="w-full px-4 py-2 rounded-full focus:outline-none text-gray-700" wire:model.live.debounce.300ms="search">
        <button class="bg-teal-600 text-white p-3 rounded-full hover:bg-teal-700 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        @foreach ($posts as $post)
        <a href="{{ route('post.show', $post->slug) }}">
            <article class="bg-white p-6 rounded-2xl shadow-md border border-gray-100 mb-8 flex flex-col">
                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="Thumbnail" class="w-full h-40 rounded-xl mb-4 object-cover">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <img src="https://placehold.co/40x40/99e6b4/4a5568?text=SC" alt="Avatar" class="w-10 h-10 rounded-full">
                        <div>
                            <h4>{{ $post->user->name }}</h4>
                            <p class="text-sm text-gray-500">2 hours ago</p>
                        </div>
                    </div>
                    <button class="text-sm text-teal-600 font-medium hover:text-teal-700">Follow</button>
                </div>
                
                <h3 class="text-2xl font-bold text-gray-800 mb-2 hover:text-teal-700 cursor-pointer">{{ $post->title }}</h3>
                <p class="text-gray-600 mb-4 grow line-clamp-3">{{ Str::limit(strip_tags($post->content), 150) }}</p>
    
                <div class="flex">
                    <p class="text-gray-500 pb-4"><small>Published 2 hours ago</small></p>
                </div>
    
                <div class="flex items-center justify-between">
                    
                    <div class="flex gap-4">
                            <span class="text-sm text-gray-700"><i class="fas fa-eye"></i>{{ $post->view_count }} views</span>
                            <livewire:like-button :post="$post" :key="'like-'.$post->id" />
                        </div>
                    <button class="mt-4" aria-label="Bookmark story">
                        <i class="fa-regular fa-bookmark text-lg"></i>
                    </button>
                </div>
            </article>
        </a>
    
        <a href="{{ route('post.show', $post->slug) }}">
            <article class="bg-white p-6 rounded-2xl shadow-md border border-gray-100 mb-8 flex flex-col">
                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="Thumbnail" class="w-full h-40 rounded-xl mb-4 object-cover">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <img src="https://placehold.co/40x40/99e6b4/4a5568?text=SC" alt="Avatar" class="w-10 h-10 rounded-full">
                        <div>
                            <h4>{{ $post->user->name }}</h4>
                            <p class="text-sm text-gray-500">2 hours ago</p>
                        </div>
                    </div>
                    <button class="text-sm text-teal-600 font-medium hover:text-teal-700">Follow</button>
                </div>
                
                <h3 class="text-2xl font-bold text-gray-800 mb-2 hover:text-teal-700 cursor-pointer">{{ $post->title }}</h3>
                <p class="text-gray-600 mb-4 grow line-clamp-3">{{ Str::limit(strip_tags($post->content), 150) }}</p>
    
                <div class="flex">
                    <p class="text-gray-500 pb-4"><small>Published 2 hours ago</small></p>
                </div>
    
                <div class="flex items-center justify-between">
                    
                    <div class="flex gap-4">
                            <span class="..."><i class="fas fa-eye"></i>{{ $post->view_count }} views</span>
                            <livewire:like-button :post="$post" :key="'like-'.$post->id" />
                        </div>
                    <button class="mt-4" aria-label="Bookmark story">
                        <i class="fa-regular fa-bookmark text-lg"></i>
                    </button>
                </div>
            </article>
        </a>
    
        <a href="{{ route('post.show', $post->slug) }}">
            <article class="bg-white p-6 rounded-2xl shadow-md border border-gray-100 mb-8 flex flex-col">
                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="Thumbnail" class="w-full h-40 rounded-xl mb-4 object-cover">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <img src="https://placehold.co/40x40/99e6b4/4a5568?text=SC" alt="Avatar" class="w-10 h-10 rounded-full">
                        <div>
                            <h4>{{ $post->user->name }}</h4>
                            <p class="text-sm text-gray-500">2 hours ago</p>
                        </div>
                    </div>
                    <button class="text-sm text-teal-600 font-medium hover:text-teal-700">Follow</button>
                </div>
                
                <h3 class="text-2xl font-bold text-gray-800 mb-2 hover:text-teal-700 cursor-pointer">{{ $post->title }}</h3>
                <p class="text-gray-600 mb-4 grow line-clamp-3">{{ Str::limit(strip_tags($post->content), 150) }}</p>
    
                <div class="flex">
                    <p class="text-gray-500 pb-4"><small>Published 2 hours ago</small></p>
                </div>
    
                <div class="flex items-center justify-between">
                    <div class="flex gap-4">
                            <span class="..."><i class="fas fa-eye"></i>{{ $post->view_count }} views</span>
                            <livewire:like-button :post="$post" :key="'like-'.$post->id" />
                        </div>
                    <button class="mt-4" aria-label="Bookmark story">
                        <i class="fa-regular fa-bookmark text-lg"></i>
                    </button>
                </div>
            </article>
        </a>
    
        <a href="{{ route('post.show', $post->slug) }}">
            <article class="bg-white p-6 rounded-2xl shadow-md border border-gray-100 mb-8 flex flex-col">
                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="Thumbnail" class="w-full h-40 rounded-xl mb-4 object-cover">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <img src="https://placehold.co/40x40/99e6b4/4a5568?text=SC" alt="Avatar" class="w-10 h-10 rounded-full">
                        <div>
                            <h4>{{ $post->user->name }}</h4>
                            <p class="text-sm text-gray-500">2 hours ago</p>
                        </div>
                    </div>
                    <button class="text-sm text-teal-600 font-medium hover:text-teal-700">Follow</button>
                </div>
                
                <h3 class="text-2xl font-bold text-gray-800 mb-2 hover:text-teal-700 cursor-pointer">{{ $post->title }}</h3>
                <p class="text-gray-600 mb-4 grow line-clamp-3">{{ Str::limit(strip_tags($post->content), 150) }}</p>
    
                <div class="flex">
                    <p class="text-gray-500 pb-4"><small>Published 2 hours ago</small></p>
                </div>
    
                <div class="flex items-center justify-between">
                    
                    <div class="flex gap-4">
                            <span class="..."><i class="fas fa-eye"></i>{{ $post->view_count }} views</span>
                            <livewire:like-button :post="$post" :key="'like-'.$post->id" />
                        </div>
                    <button class="mt-4" aria-label="Bookmark story">
                        <i class="fa-regular fa-bookmark text-lg"></i>
                    </button>
                </div>
            </article>
        </a>
    
        <a href="{{ route('post.show', $post->slug) }}">
            <article class="bg-white p-6 rounded-2xl shadow-md border border-gray-100 mb-8 flex flex-col">
                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="Thumbnail" class="w-full h-40 rounded-xl mb-4 object-cover">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <img src="https://placehold.co/40x40/99e6b4/4a5568?text=SC" alt="Avatar" class="w-10 h-10 rounded-full">
                        <div>
                            <h4>{{ $post->user->name }}</h4>
                            <p class="text-sm text-gray-500">2 hours ago</p>
                        </div>
                    </div>
                    <button class="text-sm text-teal-600 font-medium hover:text-teal-700">Follow</button>
                </div>
                
                <h3 class="text-2xl font-bold text-gray-800 mb-2 hover:text-teal-700 cursor-pointer">{{ $post->title }}</h3>
                <p class="text-gray-600 mb-4 grow line-clamp-3">{{ Str::limit(strip_tags($post->content), 150) }}</p>
    
                <div class="flex">
                    <p class="text-gray-500 pb-4"><small>Published 2 hours ago</small></p>
                </div>
    
                <div class="flex items-center justify-between">
                    
                    <div class="flex gap-4">
                            <span class="..."><i class="fas fa-eye"></i>{{ $post->view_count }} views</span>
                            <livewire:like-button :post="$post" :key="'like-'.$post->id" />
                        </div>
                    <button class="mt-4" aria-label="Bookmark story">
                        <i class="fa-regular fa-bookmark text-lg"></i>
                    </button>
                </div>
            </article>
        </a>
    
        <a href="{{ route('post.show', $post->slug) }}">
            <article class="bg-white p-6 rounded-2xl shadow-md border border-gray-100 mb-8 flex flex-col">
                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="Thumbnail" class="w-full h-40 rounded-xl mb-4 object-cover">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <img src="https://placehold.co/40x40/99e6b4/4a5568?text=SC" alt="Avatar" class="w-10 h-10 rounded-full">
                        <div>
                            <h4>{{ $post->user->name }}</h4>
                            <p class="text-sm text-gray-500">2 hours ago</p>
                        </div>
                    </div>
                    <button class="text-sm text-teal-600 font-medium hover:text-teal-700">Follow</button>
                </div>
                
                <h3 class="text-2xl font-bold text-gray-800 mb-2 hover:text-teal-700 cursor-pointer">{{ $post->title }}</h3>
                <p class="text-gray-600 mb-4 grow line-clamp-3">{{ Str::limit(strip_tags($post->content), 150) }}</p>
    
                <div class="flex">
                    <p class="text-gray-500 pb-4"><small>Published 2 hours ago</small></p>
                </div>
    
                <div class="flex items-center justify-between">
                    
                    <div class="flex gap-4">
                            <span class="..."><i class="fas fa-eye"></i>{{ $post->view_count }} views</span>
                            <livewire:like-button :post="$post" :key="'like-'.$post->id" />
                        </div>
                    <button class="mt-4" aria-label="Bookmark story">
                        <i class="fa-regular fa-bookmark text-lg"></i>
                    </button>
                </div>
            </article>
        </a>
        @endforeach
    </div>
    {{ $posts->links() }}
</div>