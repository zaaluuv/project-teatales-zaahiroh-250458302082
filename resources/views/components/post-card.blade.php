@props(['post'])

<article class="mt-8 bg-white p-5 rounded-2xl shadow-sm border border-gray-100 h-full flex flex-col hover:-translate-y-1 hover:shadow-md transition duration-300">
    
    <a href="{{ route('post.show', $post->slug) }}">
        <div  class="block overflow-hidden rounded-xl mb-4 h-48">
            @if($post->thumbnail)
                <img src="{{ asset('storage/' . $post->thumbnail) }}" class="w-full h-full object-cover transition transform hover:scale-105 duration-500">
            @else
                <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400">
                    <i class="fas fa-image text-3xl"></i>
                </div>
            @endif
        </div>
    

        <div class="flex items-center gap-2 mb-3">
            <img src="{{ $post->user->profile_photo ? asset('storage/' . $post->user->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode($post->user->name) . '&color=7F9CF5&background=EBF4FF' }}" class="w-6 h-6 rounded-full object-cover">
            <a href="{{ route('profile.show', $post->user->username) }}" class="text-xs text-gray-600 font-medium hover:text-teal-600 truncate">
                {{ $post->user->name }}
            </a>
            <span class="text-xs text-gray-400">Published {{ $post->published_at ? $post->published_at->diffForHumans() : $post->created_at->diffForHumans() }}</span>
        </div>
    </a>

    <h3 class="font-bold text-lg text-gray-800 mb-2 line-clamp-2 leading-tight">
        <a href="{{ route('post.show', $post->slug) }}" class="hover:text-teal-700 transition-colors">
            {{ $post->title }}
        </a>
    </h3>

    <p class="text-gray-500 text-sm line-clamp-2 mb-4 grow break-words">
        {{ Str::limit(strip_tags(str_replace('&nbsp;', ' ', $post->content)), 80) }}
    </p>

    <div class="mt-auto flex items-center justify-between text-sm text-gray-500 pt-4 border-t border-gray-50">
        <span class="flex items-center gap-1">
            <i class="fas fa-eye text-xs"></i> {{ $post->view_count }}
        </span>
    </div>
</article>