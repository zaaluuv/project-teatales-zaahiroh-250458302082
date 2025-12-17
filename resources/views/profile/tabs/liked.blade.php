@php
    $likedPosts = $user->likes->map(function ($like) {
        return $like->post;
    })->filter(); 
@endphp

@if($likedPosts->isEmpty())
    <div class="text-center py-16">
        <div class="bg-red-50 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
            <i class="fa-regular fa-heart text-red-400 text-2xl"></i>
        </div>
        <h3 class="text-lg font-medium text-gray-900">Belum ada yang disukai</h3>
        <p class="text-gray-500">Postingan yang Anda sukai akan muncul di sini.</p>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($likedPosts as $post)
            @include('components.post-card', ['post' => $post])
        @endforeach
    </div>
@endif