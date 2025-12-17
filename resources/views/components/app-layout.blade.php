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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    @livewireStyles
    
    <style>
        .ck-editor__editable_inline {
            min-height: 300px;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased">

    <nav class="sticky top-0 z-50 bg-white w-full mx-auto px-6 py-4 flex justify-between items-center shadow-sm">
        <a href="{{ url('/') }}" class="text-2xl font-bold text-teal-700">☕︎ <span class="text-black">TeaTales+</span></a>
        
        <div class="hidden md:flex space-x-6 items-center text-gray-700">
            <a href="#home" class="hover:text-teal-600 font-medium">Home</a>
            <a href="#community" class="hover:text-teal-600">Community</a>
            <a href="#explore" class="hover:text-teal-600">Explore</a>
            <a href="#about" class="hover:text-teal-600">About</a>
        </div>
            
        <div class="flex items-center gap-2">
            @guest
                <div class="hidden md:flex items-center gap-2">
                    <a href="{{ route('login') }}" class="bg-teal-600 h-8 text-white px-6 py-5 rounded-full font-semibold shadow hover:bg-teal-700 transition-colors flex justify-center items-center">Login</a>
                    <a href="{{ route('register') }}" class="bg-orange-300 h-8 text-white px-6 py-5 rounded-full font-semibold shadow hover:bg-orange-600 transition-colors flex justify-center items-center">Register</a>
                </div>
            @endguest
            
            @auth
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="w-10 h-10 rounded-full overflow-hidden border-2 border-teal-900 block focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2">
                        <img class="w-full h-full object-cover" src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}" alt="Profile">
                    </button>

                <div x-show="open" @click.outside="open = false" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 ring-1 ring-black ring-opacity-5" style="display: none;">
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ url('/admin') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Dashboard Admin
                        </a>
                    @else
                        <a href="{{ route('profile.show', Auth::user()->username) }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Your Profile
                        </a>

                        <a href="{{ route('posts.create') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Write Story
                        </a>
                    @endif

                    <div class="border-t border-gray-100"></div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer">
                            Log Out
                        </a>
                    </form>
                </div>

                </div>
            @endauth
        </div>
    </nav>

    <main>
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>