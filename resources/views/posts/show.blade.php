<x-guest-layout>
    <div class="container mx-auto max-w-3xl py-12 px-6">
        <h1 class="text-4xl font-bold mb-4">{{ $post->title }}</h1>

        <!-- Info Penulis -->
        <div class="flex items-center space-x-3 mb-4">
            <img src="..." alt="{{ $post->user->name }}" class="w-10 h-10 rounded-full">
            <div>
                <h4 class="font-semibold">{{ $post->user->name }}</h4>
                <p class="text-sm text-gray-500">{{ $post->created_at->format('M d, Y') }}</Data>
            </div>
        </div>

        <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="w-full rounded-xl mb-6">

        <div class="prose lg:prose-xl">
            {!! $post->content !!}
        </div>

        <div class="grid grid-cols-3 gap-4 mt-8">
            @foreach ($post->postImages as $image)
                <img src="{{ asset('storage/' . $image->image) }}" class="rounded-lg">
            @endforeach
        </div>

        <hr class="my-8">
        <div class="flex items-center space-x-6">
            <livewire:like-button :post="$post" :key="'like-'.$post->id" />
            <livewire:favorite-button :post="$post" :key="'fav-'.$post->id" />
        </div>

        <div class="mt-8">
            <livewire:post-comments :post="$post" :key="'comments-'.$post->id" />
        </div>
    </div>
</x-guest-layout>