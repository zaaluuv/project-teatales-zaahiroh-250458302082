<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white border border-teal-700 shadow-sm sm:rounded-2xl mb-8">
            <div class="p-6">
                {{-- Search Bar --}}
{{-- Search Bar dengan Filter --}}
                <div class="relative mb-6 group">
                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="{{ $activeTab == 'users' ? 'Cari nama penulis...' : 'Ketik kata kunci...' }}"class="w-full pl-5 pr-40 py-4 border-gray-200 rounded-xl bg-gray-50 focus:ring-2 focus:ring-teal-500 focus:border-transparent transition shadow-inner text-gray-700 placeholder-gray-400">
                    
                    <div class="absolute right-3 top-1/2 -translate-y-1/2 flex items-center space-x-2">
                        
                        @if($activeTab == 'posts')
                        <div class="relative border-r border-gray-300 pr-2">
                            <select wire:model.live="filterType" class="appearance-none bg-transparent border-none text-sm font-semibold text-teal-700 focus:ring-0 cursor-pointer py-1 pr-6 pl-2 hover:text-teal-900 transition">
                                <option value="all">Semua</option>
                                <option value="title">Judul</option>
                                <option value="category">Kategori</option>
                                <option value="content">Isi Cerita</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center px-1 text-teal-700">
                                <i class="fa-solid fa-chevron-down text-[10px]"></i>
                            </div>
                        </div>
                        @endif

                        <div class="text-gray-400 px-2">
                            <i wire:loading.remove class="fa-solid fa-magnifying-glass text-lg"></i>
                            <i wire:loading class="fa-solid fa-spinner fa-spin text-teal-500 text-lg"></i>
                        </div>
                    </div>
                </div>

                {{-- Tabs --}}
                <div class="flex space-x-6 border-b border-gray-100">
                    <button wire:click="setTab('posts')"class="pb-3 text-sm font-bold tracking-wide transition relative {{ $activeTab == 'posts' ? 'text-teal-700' : 'text-gray-400 hover:text-gray-600' }}">
                        Stories & Quotes
                        @if($activeTab == 'posts')
                            <span class="absolute bottom-0 left-0 w-full h-1 bg-teal-500 rounded-t-full"></span>
                        @endif
                    </button>
                    <button wire:click="setTab('users')"class="pb-3 text-sm font-bold tracking-wide transition relative {{ $activeTab == 'users' ? 'text-teal-700' : 'text-gray-400 hover:text-gray-600' }}">
                        Authors
                        @if($activeTab == 'users')
                            <span class="absolute bottom-0 left-0 w-full h-1 bg-teal-500 rounded-t-full"></span>
                        @endif
                    </button>
                </div>
            </div>
        </div>

        <div class="min-h-screen pb-20">
            {{-- POSTS --}}
            @if($activeTab == 'posts')
                <section class="flex flex-col lg:flex-row gap-12">
                    <div class="w-full">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @forelse($posts as $post)
                                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition duration-300 flex flex-col h-full">
                                    @if($post->image)
                                        <div class="h-48 overflow-hidden">
                                            <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-full object-cover transition hover:scale-105 duration-500">
                                        </div>
                                    @endif

                                    <div class="p-6 flex-1 flex flex-col">
                                        <div class="flex items-center justify-between mb-3">
                                            @if($post->category)
                                                <span class="text-xs font-bold text-teal-600 bg-teal-50 px-2 py-1 rounded-md uppercase tracking-wider">
                                                    {{ $post->category->name }}
                                                </span>
                                            @endif
                                            <span class="text-xs text-gray-400">{{ $post->created_at->diffForHumans() }}</span>
                                        </div>

                                        <a href="{{ route('post.show', $post->slug) }}" class="block group">
                                            <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-teal-700 transition line-clamp-2">
                                                {{ ucwords(str_replace('-', ' ', $post->slug)) }}
                                            </h3>
                                        </a>

                                        <p class="text-gray-600 text-sm mb-4 line-clamp-3 flex-1">
                                            {{ Str::limit(strip_tags($post->content), 120) }}
                                        </p>

                                        <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-50">
                                            <div class="flex items-center">
                                                <div class="h-8 w-8 rounded-full bg-orange-100 flex items-center justify-center text-xs font-bold text-orange-500 mr-2">
                                                    {{ substr($post->user->name, 0, 1) }}
                                                </div>
                                                <span class="text-sm font-medium text-gray-700">{{ $post->user->name }}</span>
                                            </div>
                                            <div class="flex items-center space-x-3 text-gray-400 text-sm">
                                                <span><i class="fa-regular fa-eye"></i> {{ $post->view_count ?? 0 }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-full text-center py-20">
                                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                                        <i class="fa-regular fa-folder-open text-gray-400 text-2xl"></i>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900">Belum ada cerita ditemukan</h3>
                                    <p class="text-gray-500">Coba cari dengan kata kunci atau kategori lain.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </section>
            @endif

            {{-- USER --}}
            @if($activeTab == 'users')
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($users as $user)
                        <div class="flex items-center bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md hover:border-teal-100 transition group cursor-pointer" onclick="window.location='{{ route('profile.show', $user->username) }}'">
                            <div class="h-16 w-16 rounded-full bg-orange-100 flex items-center justify-center text-2xl font-bold text-orange-500 border-2 border-white shadow-sm group-hover:scale-110 transition shrink-0">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div class="ml-5 overflow-hidden">
                                <h4 class="font-bold text-gray-900 group-hover:text-teal-700 transition truncate">{{ $user->name }}</h4>
                                <p class="text-sm text-gray-500 truncate">@ {{ $user->username }}</p>
                                <button class="mt-2 text-xs font-semibold text-teal-600 border border-teal-200 px-3 py-1 rounded-full hover:bg-teal-50 transition">
                                    Lihat Profil
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-20 text-gray-500">
                            User tidak ditemukan.
                        </div>
                    @endforelse
                </div>
            @endif
            
        </div>
    </div>
</div>