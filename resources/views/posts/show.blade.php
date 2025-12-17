<x-app-layout>
    <main class="container mx-auto px-4 py-8 lg:py-12">
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12">
            <div class="lg:col-span-2">
                <div class="mt-10 bg-white p-6 sm:p-8 rounded-2xl shadow-lg border border-gray-100">
                    
                    <div class="mb-8">
                        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 leading-tight mb-6">
                            {{ $post->title }}
                        </h1>

                        <div class="flex items-center gap-4">
                            <img src="{{ $post->user->profile_photo ? asset('storage/' . $post->user->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode($post->user->name) }}" class="w-12 h-12 rounded-full object-cover border-2 border-white shadow-sm">
                            
                            <div>
                                <a href="{{ route('profile.show', $post->user->username) }}" class="text-base font-bold text-gray-800 hover:text-teal-600 transition">
                                    {{ $post->user->name }}
                                </a>
                                <div class="flex items-center text-sm text-gray-500 gap-2">
                                    <span>Published {{ $post->published_at ? $post->published_at->diffForHumans() : $post->created_at->diffForHumans() }}</span>
                                    <span>&middot;</span>
                                    <span>{{ str_word_count(strip_tags($post->content)) / 200 }} min read</span>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    @if(auth()->id() === $post->user_id)
                        <div class="flex gap-2 mb-6">
                            <a href="{{ route('posts.edit', $post->id) }}" class="inline-flex items-center text-gray-600 px-3 py-1.5 border border-gray-200 rounded-lg text-sm font-bold hover:text-teal-600 hover:border-teal-200 transition">
                                <i class="fa-solid fa-pen-to-square mr-2"></i> Edit
                            </a>

                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus cerita ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-2 px-3 py-1.5 bg-red-50 text-red-600 border border-red-100 rounded-lg text-sm font-bold hover:bg-red-100 transition">
                                    <i class="fa-solid fa-trash"></i> 
                                    <span>Delete</span>
                                </button>
                            </form>
                        </div>
                    @endif

                    <article class="w-full break-words break-all prose prose-lg prose-teal max-w-none text-gray-700 prose-img:rounded-xl prose-img:shadow-md prose-a:text-teal-600">
                        {!! $post->content !!}
                    </article>

                    @if($post->category)
                        <div class="mt-8 pt-6 border-t border-gray-100">
                            <div class="flex items-center gap-2">
                                <span class="text-sm text-gray-400 font-medium">Kategori:</span>
                                
                                <a href="{{ route('explore', ['category' => $post->category->slug]) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-teal-50 text-teal-700 text-sm font-bold hover:bg-teal-100 hover:text-teal-800 transition-colors">
                                    <i class="fa-solid fa-tag text-xs"></i>
                                    {{ $post->category->name }}
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
                
                <div class="mt-12 pt-8">
                    <livewire:post-comments :post="$post" />
                </div>
            </div>

            <div class="hidden lg:block lg:col-span-1">
                <div class="sticky top-24">
                    <livewire:post-stats :post="$post" />
                </div>
            </div>

        </div>
    </main>
</x-app-layout>