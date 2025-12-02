<x-app-layout>
    <div class="container mx-auto max-w-4xl py-12 px-6">
        <div class="flex flex-col md:flex-row items-center gap-8">
            <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}" class="w-32 h-32 rounded-full border-4 border-teal-500">
            <div class="text-center md:text-left">
                <h1 class="text-3xl font-bold">{{ $user->name }}</h1>
                <p class="text-lg text-gray-500">
                    {{ $user->username }}
                </p>
                <p class="text-gray-700 mt-2">{{ $user->bio }}</p>

                <div class="mt-4">
                    <livewire:follow-button :user="$user" :key="'follow-'.$user->id" />
                </div>
            </div>
        </div>

        <div class="mt-12">
            <livewire:user-profile-tabs :user="$user" :key="'tabs-'.$user->id" />
        </div>
    </div>
</x-app-layout>