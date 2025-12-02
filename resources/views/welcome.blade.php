<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TeaTales+</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<!-- NAVBAR & HERO -->
    <nav class="sticky top-0 z-50 bg-white w-full mx-auto px-6 py-4 flex justify-between items-center">
        <div class="text-2xl font-bold text-teal-700">☕︎ <span class="text-black">TeaTales+</span></div>
            <div class="hidden md:flex space-x-6 items-center text-gray-700">
                <a href="#home" class="hover:text-teal-600 font-medium">Home</a>
                <a href="#community" class="hover:text-teal-600">Community</a>
                <a href="#explore" class="hover:text-teal-600">Explore</a>
                <a href="#about" class="hover:text-teal-600">About</a>
            </div>
            
        <div class="flex items-center gap-2">
            @guest
                <div class="hidden md:flex items-center gap-2">
                    <button class="bg-teal-600 h-8 text-white px-6 py-3 rounded-full font-semibold shadow hover:bg-teal-700 transition-colors flex justify-center items-center">Login</button>
                    <button class="bg-orange-300 h-8 text-white px-6 py-3 rounded-full font-semibold shadow hover:bg-orange-600 transition-colors flex justify-center items-center">Register</button>
                </div>
            @endguest
            
            <!-- kalau udh login -->
            @auth
                <div class="relative" x-data="{ open: false }">

                    <button @click="open = !open" class="w-8 h-8 rounded-full overflow-hidden border-2 border-teal-900 block">
                        <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="User avatar">
                    </button>

                    <div id="user-menu-dropdown" x-show="open" @click.outside="open = false" class="absolute right-0 mt-2 w-48 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-base-900 focus:outline-hidden z-10">
                        <div class="py-1">
                            <a href="profile.html" class="block px-4 py-2 text-black hover:bg-gray-200">Your Profile</a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" 
                                onclick="event.preventDefault(); this.closest('form').submit();" 
                                class="block px-4 py-2 text-black hover:bg-gray-200">
                                    Log Out
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            @endauth

            
        </div>
    </nav>

    <div id="home" class="bg-teal-50/70 pt-1 pb-16">
        <header class="container mx-auto px-6 mt-16 flex flex-col lg:flex-row items-center gap-12">
            <div class="lg:w-1/2">
                <h1 class="text-5xl font-bold text-gray-800 mb-4 leading-tight">
                    Find Inspiring<br><span class="text-teal-800">Stories</span>
                </h1>
                <p class="text-gray-600 text-lg mb-8">
                    Discover wonderful stories from creators around the world, or share your own thoughts with our community.
                </p>

                <!-- Search Bar -->
                <livewire:show-posts/>

                <div class="mt-6 flex flex-wrap gap-2 items-center">
                    <span class="text-sm font-medium text-gray-500 mr-2">Trending:</span>
                    <button class="text-sm bg-teal-100 text-teal-800 px-3 py-1 rounded-full hover:bg-teal-200 transition-colors">#slowliving</button>
                    <button class="text-sm bg-teal-100 text-teal-800 px-3 py-1 rounded-full hover:bg-teal-200 transition-colors">#teatime</button>
                    <button class="text-sm bg-teal-100 text-teal-800 px-3 py-1 rounded-full hover:bg-teal-200 transition-colors">#mindfulness</button>
                </div>
            </div>
            
            <div class="relative flex flex-col items-center justify-center">
                <div class="mb-6 px-6 py-4 bg-teal-700/10 rounded-lg text-center text-lg italic relative z-10 shadow-md">
                    <p class="text-base-900 font-bold">
                        @if($quote)
                            "{{ $quote->content }}"
                            <br>
                            <span class="text-sm font-normal text-teal-600">#{{ $quote->title }}</span>
                        @else
                            "Belum ada kutipan hari ini."
                        @endif
                    </p>
                </div>

                <div>
                    <div class="border-8 border-white rounded-2xl shadow-2xl overflow-hidden">
                        <img src="/media/ilustrasiHero.jpeg" alt="Tea" class="w-full h-auto object-cover">
                    </div>
                    
                    <div class="flex items-center justify-center gap-3 bg-white rounded-2xl px-4 py-2 shadow">
                        <div class="p-2 bg-teal-100 rounded-full flex items-center justify-center">
                            <i class="fa-regular fa-thumbs-up"></i>
                        </div>
                        <div class="text-center">
                            <p class="font-bold text-lg text-base-900 leading-tight">2.8k+</p>
                            <p class="text-sm text-base-600 leading-none">Positive Reviews</p>
                        </div>
                    </div>
                </div>
            </div>
        </header>

    </div>

    <!-- ISI UTAMA -->
    <main id="community" class="bg-white py-16">
        <div class="container mx-auto px-6">
            <!-- STATS -->
            <section class="text-center mb-20">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Growing Community</h2>
                <p class="text-gray-600 max-w-2xl mx-auto mb-10">
                    Join thousands of storytellers sharing their passion and creativity.
                </p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    
                    <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
                        <span class="text-4xl">☕</span>
                        <h3 class="text-4xl font-bold text-teal-600 my-2">892+</h3>
                        <p class="text-gray-700 font-semibold">Active Users</p>
                        <p class="text-sm text-gray-500 mt-2">Sharing their stories daily.</p>
                    </div>
                    
                    <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
                        <span class="text-4xl">📝</span>
                        <h3 class="text-4xl font-bold text-teal-600 my-2">2,847</h3>
                        <p class="text-gray-700 font-semibold">Stories Published</p>
                        <p class="text-sm text-gray-500 mt-2">New articles published this week.</p>
                    </div>
                    
                    <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
                        <span class="text-4xl">👀</span>
                        <h3 class="text-4xl font-bold text-teal-600 my-2">15.2k+</h3>
                        <p class="text-gray-700 font-semibold">Monthly Visitors</p>
                        <p class="text-sm text-gray-500 mt-2">Reading and engaging.</p>
                    </div>
                </div>

                <div class="mt-12 flex flex-col sm:flex-row justify-center gap-4">
                    {{-- join our community itu masuk laman login, kalau udah login, ini ilang --}}
                    <a href="" class="bg-teal-600 h-10 text-white px-6 py-3 rounded-full font-semibold shadow hover:bg-teal-700 transition-colors flex justify-center items-center">Join Our Community</a>
                    {{-- explore stories ke halaman explore --}}
                    <a href="" class="bg-orange-300 h-10 text-white px-6 py-3 rounded-full font-semibold shadow hover:bg-orange-600 transition-colors flex justify-center items-center">Explore Stories</a>
                </div>
            </section>

            <!-- FEED & SIDEBAR-->
            <section class="flex flex-col lg:flex-row gap-12">
                
                <div class="w-full lg:w-2/3">
                    <livewire:show-posts/>
                </div>

                
                <aside class="lg:w-1/3">
                    
                    <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100 mb-8">
                        <h4 class="font-bold text-gray-800 mb-5">Authors To Follow</h4>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <a href="">
                                    <div class="flex items-center space-x-3">
                                        <img src="{{ Auth::user()->profile_photo }}" alt="Avatar" class="w-10 h-10 rounded-full">
                                        <div>
                                            <h5 class="font-semibold text-gray-700">Alexei D.</h5>
                                            <p class="text-sm text-gray-500">@alexei</p>
                                        </div>
                                    </div>
                                </a>
                                <button class="text-sm text-teal-600 font-medium hover:text-teal-700">Follow</button>
                            </div>

                            <div class="flex items-center justify-between">
                                <a href="">
                                    <div class="flex items-center space-x-3">
                                        <img src="{{ Auth::user()->profile_photo }}" alt="Avatar" class="w-10 h-10 rounded-full">
                                        <div>
                                            <h5 class="font-semibold text-gray-700">Alexei D.</h5>
                                            <p class="text-sm text-gray-500">@alexei</p>
                                        </div>
                                    </div>
                                </a>
                                <button class="text-sm text-teal-600 font-medium hover:text-teal-700">Follow</button>
                            </div>

                            <div class="flex items-center justify-between">
                                <a href="">
                                    <div class="flex items-center space-x-3">
                                        <img src="{{ Auth::user()->profile_photo }}" alt="Avatar" class="w-10 h-10 rounded-full">
                                        <div>
                                            <h5 class="font-semibold text-gray-700">Alexei D.</h5>
                                            <p class="text-sm text-gray-500">@alexei</p>
                                        </div>
                                    </div>
                                </a>
                                <button class="text-sm text-teal-600 font-medium hover:text-teal-700">Follow</button>
                            </div>

                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100 mb-8">
                        <h4 class="font-bold text-gray-800 mb-4">Popular Categories</h4>
                        <div class="flex flex-wrap gap-2">
                            <a href="#" class="text-sm bg-gray-100 text-gray-700 px-3 py-1 rounded-full hover:bg-gray-200">Lifestyle</a>
                            <a href="#" class="text-sm bg-gray-100 text-gray-700 px-3 py-1 rounded-full hover:bg-gray-200">Tea</a>
                            <a href="#" class="text-sm bg-gray-100 text-gray-700 px-3 py-1 rounded-full hover:bg-gray-200">Journey</a>
                            <a href="#" class="text-sm bg-gray-100 text-gray-700 px-3 py-1 rounded-full hover:bg-gray-200">Wellness</a>
                            <a href="#" class="text-sm bg-gray-100 text-gray-700 px-3 py-1 rounded-full hover:bg-gray-200">Recipes</a>
                            <a href="#" class="text-sm bg-gray-100 text-gray-700 px-3 py-1 rounded-full hover:bg-gray-200">Mindfulness</a>
                        </div>
                    </div>

                    <div class="bg-orange-100 text-white p-8 rounded-2xl shadow-lg text-center">
                        <div class="bg-orange-300 h-20 w-20 rounded-full flex justify-center items-center mx-auto mb-4">
                            <i class="fa-solid fa-book text-white text-3xl"></i>
                        </div>
                        
                        <h4 class="font-bold text-teal-900 text-xl mb-2">Let's Explore</h4>
                        <p class="text-sm text-teal-800 mb-6">
                            Reading more stories, and enjoy it with a cup of tea!
                        </p>
                        <a href="" class="bg-white text-teal-700 font-semibold px-6 py-2 rounded-full shadow hover:bg-gray-100 transition-colors">
                            Start Reading
                        </a>
                    </div>

                    <div class="sticky top-20">
                        <a href="">
                            <div class="bg-white p-6 rounded-xl shadow-xl border border-gray-200 mt-8">
                                <h4 class="font-bold text-lg text-gray-800 mb-4 flex items-center border-b pb-3">
                                    <i class="fas fa-edit text-teal-900 pr-6"></i>
                                    Your Draft
                                </h4>

                                <div class="flex flex-wrap gap-3">
                                    <a href="#" class="text-sm text-gray-600 font-medium px-4 py-2 rounded-lg hover:text-gray-800 transition duration-150 truncate max-w-full">How To Cook Apple Pie..</a>
                                    <a href="#" class="text-sm text-gray-600 font-medium px-4 py-2 rounded-lg hover:text-gray-800 transition duration-150 truncate max-w-full">Let's We Talk About...</a>
                                    <a href="#" class="text-sm text-gray-600 font-medium px-4 py-2 rounded-lg hover:text-gray-800 transition duration-150 truncate max-w-full">What's The Popular Place...</a>
                                    <a href="#" class="text-sm text-gray-600 font-medium px-4 py-2 rounded-lg hover:text-gray-800 transition duration-150 truncate max-w-full">You Can Feel Relax With...</a>
                                </div>
                            </div>
                        </a>
                        
                    </div>
                </aside>
            </section>
        </div>
    </main>

    <!-- FOOTER -->
    <footer id="about" class="bg-teal-950 text-white mt-16 py-16">
        <div class="container mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-8">
            <div>
                <h5 class="text-xl font-bold text-white mb-4"><span class="text-teal-700">☕︎ </span>TeaTales+</h5>
                <p class="text-sm">Sharing stories, one cup at a time.</p>
            </div>
            
            <div>
                <h6 class="font-bold text-orange-300 mb-3 uppercase text-sm">Quick Menu</h6>
                <ul class="space-y-2 text-sm">
                    <li><a href="#home" class="hover:text-teal-600 font-medium">Home</a></li>
                    <li><a href="#community" class="hover:text-teal-600">Community</a></li>
                    <li><a href="#explore" class="hover:text-teal-600">Explore</a></li>
                    <li><a href="#about" class="hover:text-teal-600">About</a></li>
                </ul>
            </div>
            
            <div>
                <h6 class="font-bold text-orange-300 mb-3 uppercase text-sm">Support</h6>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-white">FAQ</a></li>
                    <li><a href="#" class="hover:text-white">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-white">Help Service</a></li>
                </ul>
            </div>
            
            <div>
                <h6 class="font-bold text-orange-300 mb-3 uppercase text-sm">Connect With Us</h6>
                <div class="flex space-x-4">
                    <a href="#" class="hover:text-white"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#" class="hover:text-white"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="hover:text-white"><i class="fa-brands fa-x-twitter"></i></a>
                </div>
            </div>

        </div>
        
        <div class="container mx-auto px-6 text-center text-sm border-t border-teal-900 pt-8 mt-12">
            &copy; 2025 TeaTales+.
        </div>
    </footer>
    @livewireScripts
</body>
</html>