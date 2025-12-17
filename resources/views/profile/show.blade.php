
    <x-app-layout>
    <main class="container mx-auto px-6 py-12">
        
        <section class="mb-12">
            <div class="flex flex-col md:flex-row items-center md:items-start gap-6 md:gap-10">
                
                <div class="shrink-0">
                    <img src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}" alt="{{ $user->name }}" class="w-32 h-32 rounded-full shadow-lg border-4 border-white object-cover">
                </div>
                
                <div class="flex-1 text-center md:text-left">
                    <div class="flex flex-col md:flex-row items-center gap-4 mb-3 justify-center md:justify-start">
                        <h1 class="text-3xl font-bold text-gray-800">{{ $user->name }}</h1>
                        
                        @auth
                            @if(Auth::id() === $user->id)
                                <a href="{{ route('posts.create') }}" class="bg-teal-600 text-white text-sm font-semibold px-5 py-2 rounded-lg shadow-md hover:bg-teal-700 transition-colors flex items-center gap-2">
                                    <i class="fa-solid fa-plus"></i>
                                    Add Post
                                </a>
                                <a href="{{ route('profile.edit') }}" class="bg-gray-200 text-gray-700 text-sm font-semibold px-5 py-2 rounded-lg hover:bg-gray-300 transition-colors">
                                    Edit Profil
                                </a>
                            @else
                                <livewire:follow-button :author="$user" />
                            @endif
                        @endauth
                    </div>

                    <span class="text-gray-500 text-lg block mb-4">@ {{ $user->username }}</span>
                    
                    <div class="flex justify-center md:justify-start space-x-6 mb-4">
                        <a href="#modal-following" class="text-center hover:text-teal-600 transition">
                            <span class="text-xl font-bold text-gray-800">{{ $user->following()->count() }}</span>
                            <span class="text-gray-600 block">Following</span>
                        </a>
                        
                        <a href="#modal-followers" class="text-center hover:text-teal-600 transition">
                            <span class="text-xl font-bold text-gray-800">{{ $user->followers()->count() }}</span>
                            <span class="text-gray-600 block">Followers</span>
                        </a>

                        <div id="modal-authors" class="fixed inset-0 z-[100] hidden target:flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">
                            <div class="bg-white w-full max-w-sm rounded-2xl shadow-xl">
                                <div class="flex items-center justify-between p-4 border-b">
                                    <h3 class="font-bold text-gray-800">Authors to Follow</h3>
                                    <a href="#" class="text-gray-400 text-2xl">&times;</a>
                                </div>
                                <div class="max-h-80 overflow-y-auto p-4 space-y-4 text-left">
                                    @forelse($suggestedAuthors ?? [] as $author)
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-3">
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($author->name) }}&background=ccf2f4&color=0d9488" class="w-10 h-10 rounded-full">
                                                <div>
                                                    <p class="text-sm font-semibold text-gray-800">{{ $author->name }}</p>
                                                    <p class="text-xs text-gray-500">@ {{ $author->username }}</p>
                                                </div>
                                            </div>
                                            <a href="{{ route('profile.show', $author->username) }}" class="text-xs text-teal-600 font-bold">View</a>
                                        </div>
                                    @empty
                                        <p class="text-center text-gray-500 py-4 text-sm">Tidak ada saran author.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <span class="text-xl font-bold text-gray-800">{{ $user->posts()->where('status', 'published')->count() }}</span>
                            <span class="text-gray-600 block">Posts</span>
                        </div>
                    </div>
                    
                    <p class="text-gray-700 max-w-lg mb-4">
                        {{ $user->bio ?? 'Belum ada bio.' }}
                    </p>
                </div>
            </div>
        </section>

        <div class="border-b border-gray-300 mb-8">
            <nav class="flex gap-8 justify-center sm:gap-10 overflow-x-auto">
                
                <a href="?tab=posts" class="py-4 px-2 border-b-2 font-semibold flex items-center gap-2 transition-all {{ $activeTab == 'posts' ? 'border-teal-600 text-teal-600' : 'border-transparent text-gray-500 hover:text-gray-800' }}">
                    <i class="fa-solid fa-grip-lines"></i>
                    Postingan
                </a>

                @if(Auth::id() === $user->id)
                    <a href="?tab=saved" class="py-4 px-2 border-b-2 font-semibold flex items-center gap-2 transition-all {{ $activeTab == 'saved' ? 'border-teal-600 text-teal-600' : 'border-transparent text-gray-500 hover:text-gray-800' }}">
                        <i class="fa-solid fa-bookmark"></i>
                        Tersimpan
                    </a>

                    <a href="?tab=liked" class="py-4 px-2 border-b-2 font-semibold flex items-center gap-2 transition-all {{ $activeTab == 'liked' ? 'border-teal-600 text-teal-600' : 'border-transparent text-gray-500 hover:text-gray-800' }}">
                        <i class="fa-solid fa-heart"></i>
                        Disukai
                    </a>

                    <a href="?tab=drafts" class="py-4 px-2 border-b-2 font-semibold flex items-center gap-2 transition-all {{ $activeTab == 'drafts' ? 'border-teal-600 text-teal-600' : 'border-transparent text-gray-500 hover:text-gray-800' }}">
                        <i class="fas fa-edit"></i>
                        Draft
                    </a>
                @endif
            </nav>
        </div>

        <div class="min-h-screen">
            @if($activeTab == 'posts')
                @include('profile.tabs.posts')
            @elseif($activeTab == 'liked' && Auth::id() === $user->id)
                @include('profile.tabs.liked')
            @elseif($activeTab == 'saved' && Auth::id() === $user->id)
                @include('profile.tabs.saved')
            @elseif($activeTab == 'drafts' && Auth::id() === $user->id)
                @include('profile.tabs.drafts')
            @endif
        </div>

        <div id="modal-following" class="fixed inset-0 z-[100] hidden target:flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">
            <div class="bg-white w-full max-w-sm rounded-2xl shadow-xl">
                <div class="flex items-center justify-between p-4 border-b">
                    <h3 class="font-bold text-gray-800">Following</h3>
                    <a href="#" class="text-gray-400 text-2xl">&times;</a>
                </div>
                <div class="max-h-80 overflow-y-auto p-4 space-y-4">
                    @forelse($user->following as $following)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($following->name) }}" class="w-10 h-10 rounded-full">
                                <span class="text-sm font-semibold">{{ $following->name }}</span>
                            </div>
                            <a href="{{ route('profile.show', $following->username) }}" class="text-xs text-teal-600 font-bold">View</a>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 text-sm">Tidak mengikuti siapapun.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div id="modal-followers" class="fixed inset-0 z-[100] hidden target:flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">
            <div class="bg-white w-full max-w-sm rounded-2xl shadow-xl">
                <div class="flex items-center justify-between p-4 border-b">
                    <h3 class="font-bold text-gray-800">Followers</h3>
                    <a href="#" class="text-gray-400 text-2xl">&times;</a>
                </div>
                <div class="max-h-80 overflow-y-auto p-4 space-y-4">
                    @forelse($user->followers as $follower)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($follower->name) }}" class="w-10 h-10 rounded-full">
                                <span class="text-sm font-semibold">{{ $follower->name }}</span>
                            </div>
                            <a href="{{ route('profile.show', $follower->username) }}" class="text-xs text-teal-600 font-bold">View</a>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 text-sm">Belum memiliki pengikut.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </main>
</x-app-layout>