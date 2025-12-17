<div id="comments" class="mt-10 bg-white p-6 sm:p-8 rounded-2xl shadow-lg border border-gray-100">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">
        Komentar ({{ $comments->total() }})
    </h2>
    
    <div class="mb-8">
        @auth
            <form wire:submit.prevent="postComment">
                <div class="flex items-start space-x-3">
                    <img src="{{ auth()->user()->profile_photo ? asset('storage/' . auth()->user()->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}" alt="{{ auth()->user()->name }}" class="w-10 h-10 rounded-full object-cover border border-gray-200">
                    
                    <div class="flex-1">
                        <textarea wire:model="content"rows="3" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 @error('content') border-red-500 ring-red-200 @enderror" placeholder="Tulis komentarmu..."></textarea>
                        
                        @error('content') 
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> 
                        @enderror

                        <div class="mt-2 flex items-center justify-between">
                            <button type="submit" 
                                    wire:loading.attr="disabled"
                                    class="bg-teal-600 text-white px-5 py-2 rounded-full font-semibold hover:bg-teal-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                                <span wire:loading.remove>Kirim Komentar</span>
                                <span wire:loading><i class="fa-solid fa-spinner fa-spin"></i> Mengirim...</span>
                            </button>

                            @if (session()->has('message'))
                                <span class="text-teal-600 font-medium text-sm animate-pulse">
                                    <i class="fa-solid fa-check mr-1"></i> {{ session('message') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        @else
            <div class="bg-gray-50 p-4 rounded-xl text-center border border-gray-200">
                <p class="text-gray-600">Silakan <a href="{{ route('login') }}" class="text-teal-600 font-bold hover:underline">Login</a> untuk ikut berdiskusi.</p>
            </div>
        @endauth
    </div>

    <div class="space-y-6">
        @forelse($comments as $comment)
            <div class="flex items-start space-x-3">
                <img src="{{ $comment->user->profile_photo ? asset('storage/' . $comment->user->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode($comment->user->name) }}" alt="{{ $comment->user->name }}" class="w-10 h-10 rounded-full object-cover border border-gray-200">
                
                <div class="flex-1">
                    <div class="bg-gray-100 p-4 rounded-lg rounded-tl-none">
                        <div class="flex items-center gap-2 mb-1">
                            <h5 class="font-semibold text-gray-800">{{ $comment->user->name }}</h5>
                            
                            @if($post->user_id === $comment->user_id)
                                <span class="text-xs bg-teal-100 text-teal-700 px-2 py-0.5 rounded-full font-bold border border-teal-200">
                                    Penulis
                                </span>
                            @endif
                        </div>

                        <p class="text-gray-700 mt-1 whitespace-pre-wrap leading-relaxed">{{ $comment->content }}</p>
                    </div>
                    
                    <div class="text-sm text-gray-500 mt-1 space-x-3 flex items-center">
                        <span>{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-8 text-gray-400">
                <i class="fa-regular fa-comments text-4xl mb-3 opacity-50"></i>
                <p>Belum ada komentar. Jadilah yang pertama!</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $comments->links() }} 
    </div>
</div>