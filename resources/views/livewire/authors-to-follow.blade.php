<div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 mb-8">
    <h4 class="font-bold text-gray-800 mb-5 flex items-center gap-2">
        <i class="fa-solid fa-users text-teal-600"></i> 
        @if($search) Result: "{{ $search }}" @else Authors To Follow @endif
    </h4>
    
    {{-- SEARCH BAR --}}
    <div class="mb-6 relative">
        <input 
            wire:model.live.debounce.300ms="search" 
            type="text" 
            placeholder="Cari Penulis..." 
            class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-teal-100 focus:border-teal-500 outline-none transition-all text-sm"
        >
        <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
    </div>

    {{-- LIST AUTHOR --}}
    <div class="space-y-4">
        @forelse($users as $user)
            <div class="flex items-center justify-between">
                <a href="{{ route('profile.show', $user->username) }}" class="flex items-center gap-3 group flex-1">
                    <img src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}" class="w-10 h-10 rounded-full object-cover border border-gray-100 group-hover:ring-2 group-hover:ring-teal-500 transition-all">
                    
                    <div class="overflow-hidden">
                        <h5 class="font-bold text-gray-800 group-hover:text-teal-600 transition text-sm truncate">
                            {{ Str::limit($user->name, 15) }}
                        </h5>
                        <p class="text-xs text-gray-400 truncate">{{ '@' . $user->username }}</p>
                    </div>
                </a>

                @if(View::exists('livewire.follow-button'))
                    <livewire:follow-button :author="$user" wire:key="sidebar-follow-{{ $user->id }}" />
                @else
                    <a href="{{ route('profile.show', $user->username) }}" class="text-xs bg-teal-50 text-teal-700 px-3 py-1 rounded-full font-bold hover:bg-teal-100 transition">
                        View
                    </a>
                @endif
            </div>
        @empty
            <div class="text-center py-4 text-gray-400 text-sm">
                <i class="fa-regular fa-face-frown mb-2 text-lg"></i>
                <p>Penulis tidak ditemukan.</p>
            </div>
        @endforelse
    </div>
</div>