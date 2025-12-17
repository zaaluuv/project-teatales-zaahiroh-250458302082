<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-24">
    <h3 class="font-bold text-gray-900 mb-6 text-lg">Statistik Artikel</h3>

    @if (session()->has('stat_message'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="mb-4 text-xs font-semibold bg-green-100 text-green-700 p-3 rounded-lg flex items-center gap-2 transition-all">
            <i class="fa-solid fa-check-circle"></i> {{ session('stat_message') }}
        </div>
    @endif

    <div class="grid grid-cols-2 gap-3 mb-6">
        <button wire:click="toggleLike" 
            class="flex flex-col items-center justify-center p-3 rounded-xl border transition-all duration-200 
            {{ $isLiked ? 'bg-red-50 border-red-200 text-red-600' : 'bg-gray-50 border-gray-100 text-gray-500 hover:bg-gray-100' }}">
            <i class="{{ $isLiked ? 'fa-solid animate-pulse' : 'fa-regular' }} fa-heart text-2xl mb-1"></i>
            <span class="text-xs font-bold">{{ $likeCount }} Suka</span>
        </button>

        <button wire:click="toggleFavorite" 
            class="flex flex-col items-center justify-center p-3 rounded-xl border transition-all duration-200 
            {{ $isFavorited ? 'bg-teal-50 border-teal-200 text-teal-600' : 'bg-gray-50 border-gray-100 text-gray-500 hover:bg-gray-100' }}">
            <i class="{{ $isFavorited ? 'fa-solid' : 'fa-regular' }} fa-bookmark text-2xl mb-1"></i>
            <span class="text-xs font-bold">{{ $isFavorited ? 'Disimpan' : 'Simpan' }}</span>
        </button>
    </div>

    <div class="space-y-5">
        
        <a href="#comments" class="flex items-center justify-between w-full group cursor-pointer">
            <div class="flex items-center gap-3 text-gray-500 group-hover:text-teal-600 transition-colors">
                <i class="fa-regular fa-comment text-xl w-6 text-center"></i>
                <span class="font-medium">Komentar</span>
            </div>
            <span class="font-bold text-gray-900">{{ $post->comments()->count() }}</span>
        </a>

        <div class="flex items-center justify-between w-full cursor-default">
            <div class="flex items-center gap-3 text-gray-500">
                <i class="fa-regular fa-eye text-xl w-6 text-center"></i>
                <span class="font-medium">Tayangan</span>
            </div>
            <span class="font-bold text-gray-900">{{ $post->view_count }}</span>
        </div>
        <button wire:click="toggleReshare" class="flex items-center justify-between w-full group">
            <div class="flex items-center gap-3 transition-colors {{ $isReshared ? 'text-green-600' : 'text-gray-500 group-hover:text-green-600' }}">
                <i class="fa-solid fa-retweet text-xl w-6 text-center"></i>
                <span class="font-medium">{{ $isReshared ? 'Dibagikan' : 'Bagikan Ulang' }}</span>
            </div>
            <span class="font-bold text-gray-900">{{ $reshareCount }}</span>
        </button>

        <div class="border-t border-gray-100 my-2"></div>

        <div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Bagikan Ke</p>
            
            <div class="grid grid-cols-1 gap-2"
                <div x-data="{ copied: false,
                        copy() {
                            navigator.clipboard.writeText('{{ route('post.show', $post->slug) }}');
                            this.copied = true;
                            setTimeout(() => this.copied = false, 2000);
                        }
                    }" class="w-full">
                    
                    <button @click="copy()"
                        class="w-full flex items-center justify-center gap-2 py-2.5 rounded-xl border border-gray-200 text-gray-600 font-bold hover:bg-gray-50 transition-colors relative overflow-hidden">
                        
                        <i class="fa-solid transition-all duration-300" :class="copied ? 'fa-check text-teal-600 scale-110' : 'fa-link'"></i>

                        <span x-text="copied ? 'Link Disalin!' : 'Salin Link'"></span>
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>