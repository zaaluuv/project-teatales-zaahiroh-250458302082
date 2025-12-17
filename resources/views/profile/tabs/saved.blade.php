@php
    $savedPosts = $user->favorites->map(function ($fav) {
        return $fav->post;
    })->filter();
@endphp

@if($savedPosts->isEmpty())
    <div class="text-center py-16">
        <div class="bg-blue-50 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
            <i class="fa-regular fa-bookmark text-blue-400 text-2xl"></i>
        </div>
        <h3 class="text-lg font-medium text-gray-900">Belum ada simpanan</h3>
        <p class="text-gray-500">Simpan cerita menarik untuk dibaca nanti.</p>
    </div>
@else

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($savedPosts as $post)
            @include('components.post-card', ['post' => $post])
        @endforeach
    </div>
@endif