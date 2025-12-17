<x-app-layout>
    <div id="home" class="bg-teal-50/70 pt-1 pb-16">
        <header class="container mx-auto px-6 mt-16 flex flex-col lg:flex-row items-center gap-12">
            <div class="lg:w-1/2">
                <h1 class="text-5xl font-bold text-gray-800 mb-4 leading-tight">
                    Find Inspiring<br><span class="text-teal-800">Stories</span>
                </h1>
                <p class="text-gray-600 text-lg mb-8">
                    Discover wonderful stories from creators around the world, or share your own thoughts with our community.
                </p>
                
                <div class="mt-6 flex flex-wrap gap-2 items-center">
                    <span class="text-sm font-medium text-gray-500 mr-2">Recommendation:</span>
                    @php
                        $categories = \App\Models\Category::limit(3)->get();
                    @endphp

                    @foreach( $categories as $cat )
                        <a href="#" class="text-sm bg-teal-100 text-teal-800 px-3 py-1 rounded-full hover:bg-teal-200">
                            #{{ $cat->name }}
                        </a>
                    @endforeach
                </div>
            </div>
            
            <div class="relative flex flex-col items-center justify-center lg:w-1/2">
                <div class="mb-6 px-6 py-4 bg-white/80 backdrop-blur rounded-lg text-center shadow-md border border-teal-100 max-w-sm">
                    <p class="text-gray-800 italic">
                        @if($quote)
                            "{{ $quote->content }}"
                            <br>
                            <span class="text-sm font-semibold text-teal-600">-{{ $quote->title }}</span>
                        @else
                            "Write your own story and inspire the world."
                            <br>
                            <span class="text-sm font-semibold text-teal-600">#TeaTales</span>
                        @endif
                    </p>
                </div>

                <div class="relative">
                    <div class="border-8 border-white rounded-2xl shadow-2xl overflow-hidden max-w-md">
                        <img src="{{ asset('media/hero.jpg') }}" alt="Hero" class="w-full h-auto object-cover">
                    </div>
                </div>
            </div>
        </header>
    </div>

    <main id="community" class="bg-white py-16">
        <div class="container mx-auto px-6">
            
            <section class="text-center mb-20">
                <h2 class="text-3xl font-bold text-gray-800 mb-4 font-['Poppins']">Growing Community</h2>
                <p class="text-gray-600 max-w-2xl mx-auto mb-10">Join thousands of storytellers sharing their passion and creativity.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                        <span class="text-4xl">☕</span>
                        <h3 class="text-4xl font-bold text-teal-600 my-2">{{ $activeUsers }}</h3>
                        <p class="text-gray-700 font-semibold">Active Users</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                        <span class="text-4xl">📝</span>
                        <h3 class="text-4xl font-bold text-teal-600 my-2">{{ $publishedStories }}</h3>
                        <p class="text-gray-700 font-semibold">Stories Published</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                        <span class="text-4xl">👀</span>
                        <h3 class="text-4xl font-bold text-teal-600 my-2">{{ $monthlyVisitors }}</h3>
                        <p class="text-gray-700 font-semibold">Total Visits</p>
                    </div>

                </div>

                <div class="mt-12 flex flex-col sm:flex-row justify-center gap-4">
                    @guest
                        <a href="{{ route('register') }}" class="bg-teal-600 h-12 text-white px-8 rounded-full font-bold shadow hover:bg-teal-700 transition flex justify-center items-center">Join Our Community</a>
                    @endguest
                    <a href="#explore" class="bg-orange-300 h-12 text-white px-8 rounded-full font-bold shadow hover:bg-orange-400 transition flex justify-center items-center">Explore Stories</a>
                </div>
            </section>

            <section id="explore" class="flex flex-col lg:flex-row gap-12">
                
                <div class="w-full lg:w-2/3">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-2xl font-bold text-gray-800">Latest Stories</h3>
                    </div>
                    
                    {{-- GANTI INI: Dari show-posts ke explore-stories --}}
                    <livewire:show-posts /> 

                </div>

                <aside class="lg:w-1/3 sticky top-20">
                        <livewire:authors-to-follow />

                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 mb-8">
                            <h4 class="font-bold text-gray-800 mb-4">Popular Categories</h4>
                            <div class="flex flex-wrap gap-2">
                                @php
                                    $categories = \App\Models\Category::limit(6)->get();
                                @endphp

                                @foreach( $categories as $cat )
                                    <a href="#" class="text-xs bg-gray-50 text-gray-600 px-3 py-1.5 rounded-lg border border-gray-100 hover:bg-teal-50 hover:text-teal-700 transition">
                                        #{{ $cat->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-orange-100 to-orange-200 p-8 rounded-2xl shadow-inner text-center">
                            <div class="bg-white/50 w-16 h-16 rounded-full flex justify-center items-center mx-auto mb-4">
                                <i class="fa-solid fa-mug-hot text-orange-500 text-2xl"></i>
                            </div>
                            <h4 class="font-bold text-teal-900 text-xl mb-2">Ready to Write?</h4>
                            <p class="text-sm text-teal-800/80 mb-6">Share your unique perspective with our warm community.</p>
                            @auth
                                <a href="{{ route('posts.create') }}" class="bg-orange-300 text-white font-bold px-6 py-2.5 rounded-full shadow-lg hover:bg-orange-500">Write Now</a>
                            @else
                                <a href="{{ route('login') }}" class="bg-orange-300 text-white font-bold px-6 py-2.5 rounded-full shadow-lg hover:bg-orange-500">Login to Write</a>
                            @endauth
                        </div>

                        @auth
                            <div class="sticky top-24 mt-8">
                                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                                    <h4 class="font-bold text-gray-800 mb-4 flex items-center border-b pb-3 gap-3">
                                        <i class="fas fa-file-pen text-teal-700"></i> Your Drafts
                                    </h4>
                                    
                                    <div class="space-y-3">
                                        @auth
                                            @php
                                                $myDrafts = Auth::user()->posts()
                                                            ->where('status', 'draft') 
                                                            ->latest()
                                                            ->take(3)
                                                            ->get();
                                            @endphp

                                            @forelse($myDrafts as $draft)
                                                <a href="{{ route('posts.edit', $draft) }}" 
                                                class="block text-sm text-gray-600 hover:text-teal-700 transition truncate"
                                                title="{{ $draft->title }}">
                                                    {{ $draft->title }}
                                                </a>
                                            @empty
                                                <span class="text-sm text-gray-400 italic">You have no drafts yet.</span>
                                            @endforelse

                                            <a href="{{ route('profile.show', Auth::user()->username) }}?tab=drafts" 
                                            class="block w-full text-left text-xs font-bold text-teal-600 mt-4 hover:underline">
                                            View All Drafts
                                            </a>
                                        @else
                                            <p class="text-sm text-gray-500">Please login to see your drafts.</p>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        @endauth
                </aside>
            </section>
        </div>
    </main>

    <footer id="about" class="bg-teal-950 text-white py-16">
        <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-12">
            <div>
                <h5 class="text-xl font-bold mb-4"><span class="text-teal-500">☕︎ </span>TeaTales+</h5>
                <p class="text-gray-400 text-sm leading-relaxed">Sharing stories, one cup at a time. A community for those who find beauty in the small things.</p>
            </div>
            <div>
                <h6 class="font-bold text-orange-300 mb-4 uppercase text-xs tracking-widest">Navigation</h6>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="#home" class="hover:text-white transition">Home</a></li>
                    <li><a href="#community" class="hover:text-white transition">Community</a></li>
                    <li><a href="#explore" class="hover:text-white transition">Explore</a></li>
                </ul>
            </div>
            <div>
                <h6 class="font-bold text-orange-300 mb-4 uppercase text-xs tracking-widest">Contact</h6>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li class="hover:text-white transition">+62 8123456789</li>
                    <li class="hover:text-white transition">teatales@gmail.com</li>
                </ul>
            </div>
            <div>
                <h6 class="font-bold text-orange-300 mb-4 uppercase text-xs tracking-widest">Connect</h6>
                <div class="flex space-x-4 text-xl">
                    <a href="https://www.instagram.com/zwoify" class="text-gray-400 hover:text-white transition"><i class="fa-brands fa-facebook"></i></a>
                    <a href="https://www.instagram.com/zwoify" class="text-gray-400 hover:text-white transition"><i class="fa-brands fa-instagram"></i></a>
                    <a href="https://www.instagram.com/zwoify" class="text-gray-400 hover:text-white transition"><i class="fa-brands fa-x-twitter"></i></a>
                </div>
            </div>
        </div>
        <div class="container mx-auto px-6 text-center text-xs text-gray-500 border-t border-white/5 pt-8 mt-12">
            &copy; 2025 TeaTales+. All rights reserved.
        </div>
    </footer>

    @if (session('blocked_message'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Akses Ditolak',
                text: "{{ session('blocked_message') }}",
                confirmButtonColor: '#115e59',
            });
        </script>
    @endif

    @livewireScripts
</x-app-layout>