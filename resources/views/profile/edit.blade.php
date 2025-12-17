<x-app-layout>
    <main class="container mx-auto px-6 py-10 max-w-3xl">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <h1 class="text-xl font-bold text-gray-800">Edit Profil</h1>
            </div>

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-8">
                @csrf
                @method('PATCH')
                
                <div class="flex flex-col sm:flex-row items-center gap-6">
                    <div class="relative group">
                        <img id="profile-preview" src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}" class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-md">
                    </div>
                    <div class="text-center sm:text-left">
                        <h3 class="font-semibold text-gray-800">Foto Profil</h3>
                        <div class="flex gap-3 mt-2">
                            <label class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 cursor-pointer shadow-sm">
                                Ganti Foto
                                <input type="file" name="profile_photo" class="hidden" onchange="previewImage(this)">
                            </label>
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
                    </div>
                </div>

                <hr class="border-gray-100">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="name" class="text-sm font-semibold text-gray-700">Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500">
                        <x-input-error :messages="$errors->get('name')" />
                    </div>
                    
                    <div class="space-y-2">
                        <label for="username" class="text-sm font-semibold text-gray-700">Username</label>
                        <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500">
                        <x-input-error :messages="$errors->get('username')" />
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="bio" class="text-sm font-semibold text-gray-700">Bio Singkat</label>
                    <textarea id="bio" name="bio" rows="4" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500">{{ old('bio', $user->bio) }}</textarea>
                    <x-input-error :messages="$errors->get('bio')" />
                </div>

                <hr class="border-gray-100">

                <div class="pt-6 flex items-center justify-end gap-4 border-t border-gray-100">
                    <a href="{{ route('profile.show', $user->username) }}" class="px-6 py-2.5 rounded-lg text-gray-600 font-medium hover:bg-gray-100 transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2.5 rounded-lg bg-teal-600 text-white font-semibold shadow-sm hover:bg-teal-700 transition-all">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profile-preview').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-layout>