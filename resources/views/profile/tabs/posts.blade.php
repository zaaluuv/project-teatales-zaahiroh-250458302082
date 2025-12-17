@php
    $myPosts = $user->posts->where('status', 'published')->map(function($post) {
        $post->is_reshare = false; 
        return $post;
    });

    $myReshares = $user->reshares->map(function($reshare) {
        $post = $reshare->post;

        if($post) {
            $post->is_reshare = true; 
            $post->reshared_at = $reshare->created_at;
            return $post;
        }
    })->filter(); 

    $feed = $myPosts->concat($myReshares)->sortByDesc(function($post) {
        return $post->is_reshare ? $post->reshared_at : $post->created_at;
    });
@endphp

@if($feed->isEmpty())
    <div class="text-center py-12">
        <div class="bg-gray-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
            <i class="fa-solid fa-pen-nib text-gray-400 text-2xl"></i>
        </div>
        <h3 class="text-lg font-medium text-gray-900 mt-14">No Stories Yet</h3>
        <p class="text-gray-500">User ini belum memposting atau membagikan apapun.</p>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($feed as $post)
            <div class="relative group">
                @if($post->is_reshare)
                    <div class="flex items-center gap-2 text-xs text-gray-500 mb-2 font-semibold">
                        <i class="fa-solid fa-retweet text-green-600"></i>
                        <span>{{ $user->name }} membagikan ulang</span>
                    </div>
                @endif

                @include('components.post-card', ['post' => $post])
            </div>
        @endforeach
    </div>
@endif