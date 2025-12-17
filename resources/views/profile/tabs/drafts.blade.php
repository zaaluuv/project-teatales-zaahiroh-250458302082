@php
    $drafts = $user->posts()
        ->whereIn('status', ['draft', 'hidden']) 
        ->latest('updated_at')
        ->get();
@endphp

@if($drafts->isEmpty())
    <div class="text-center py-16">
        <div class="bg-gray-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-pencil-alt text-gray-400 text-2xl"></i>
        </div>
        <h3 class="text-lg font-medium text-gray-900">Tidak ada draft atau postingan tersembunyi</h3>
        <p class="text-gray-500">Ide tulisan Anda yang belum selesai akan muncul di sini.</p>
        
        <a href="{{ route('posts.create') }}" class="inline-block mt-4 text-teal-600 font-semibold hover:underline">
            Buat tulisan baru &rarr;
        </a>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($drafts as $post)
            <div class="relative group">
                @include('components.post-card', ['post' => $post])

                <div class="absolute inset-0 bg-white/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center rounded-2xl border-teal-500">
                    <a href="{{ route('posts.edit', $post->id) }}" class="bg-teal-600 text-white px-6 py-2 rounded-full font-bold shadow-lg hover:bg-teal-700 transform hover:scale-105 transition-all flex items-center gap-2">
                        <i class="fas fa-pen"></i> Lanjut Tulis
                    </a>
                </div>
                
                @if($post->status === 'hidden')
                    <div class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded shadow">
                        HIDDEN
                    </div>
                @else
                    <div class="absolute top-3 right-3 bg-yellow-400 text-yellow-900 text-xs font-bold px-2 py-1 rounded shadow">
                        DRAFT
                    </div>
                @endif
            </div>
        @endforeach
    </div>
@endif