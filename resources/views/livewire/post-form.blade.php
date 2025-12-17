<div class="max-w-4xl mx-auto bg-white p-6 sm:p-8 rounded-2xl shadow-lg border border-gray-100">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">
        {{ $post ? 'Edit Postingan' : 'Buat Postingan Baru' }}
    </h2>

    <form wire:submit.prevent="publish"> 
        @csrf
        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Thumbnail Utama</label>
            
            @if ($thumbnail)
                <img src="{{ $thumbnail->temporaryUrl() }}" class="w-full h-64 object-cover rounded-xl mb-3">
            @elseif ($oldThumbnail)
                <img src="{{ asset('storage/' . $oldThumbnail) }}" class="w-full h-64 object-cover rounded-xl mb-3">
            @endif

            <div class="flex items-center justify-center w-full">
                <label class="flex flex-col w-full h-32 border-4 border-dashed hover:bg-gray-100 hover:border-teal-300 group cursor-pointer">
                    <div class="flex flex-col items-center justify-center pt-7">
                        <i class="fa-solid fa-cloud-arrow-up text-3xl text-gray-400 group-hover:text-teal-600"></i>
                        <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-teal-600">
                            Pilih foto thumbnail
                        </p>
                    </div>
                    <input type="file" wire:model="thumbnail" class="opacity-0 hidden" />
                </label>
            </div>
            @error('thumbnail') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- JUDUL --}}
        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Judul Artikel</label>
            <input type="text" wire:model="title" class="w-full p-4 border rounded-xl focus:ring-2 focus:ring-teal-500 outline-none text-lg font-semibold" placeholder="Apa judul menarik hari ini?">
            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- KATEGORI & TAGS --}}
        <div class="w-full gap-6 mb-6">
            <div>
                <label class="block text-gray-700 font-bold mb-2">Kategori</label>
                <select wire:model="category_id" class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-teal-500 outline-none bg-white">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mb-8" wire:ignore>
            <label class="block text-gray-700 font-bold mb-2">Isi Tulisan</label>
            
            <textarea id="editor" class="w-full"></textarea>
        </div>

        <div class="mb-6">
            @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end gap-4 border-t pt-6">
            <button type="button" wire:click="saveDraft" wire:loading.attr="disabled" class="px-6 py-2.5 rounded-lg border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition">
                <span wire:loading.remove wire:target="saveDraft">Simpan Draft</span>
                <span wire:loading wire:target="saveDraft">Menyimpan...</span>
            </button>

            <button type="submit" wire:loading.attr="disabled" class="px-6 py-2.5 rounded-lg bg-teal-600 text-white font-medium hover:bg-teal-700 transition shadow-lg shadow-teal-200">
                <span wire:loading.remove wire:target="publish">Publikasikan</span>
                <span wire:loading wire:target="publish">Memproses...</span>
            </button>
        </div>
    </form>
    
    <script>
        class MyUploadAdapter {
            constructor(loader) { this.loader = loader; }
            upload() {
                return this.loader.file.then(file => new Promise((resolve, reject) => {
                    const reader = new FileReader();
                    reader.onload = () => resolve({ default: reader.result });
                    reader.onerror = error => reject(error);
                    reader.readAsDataURL(file);
                }));
            }
            abort() {}
        }

        function MyCustomUploadAdapterPlugin(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                return new MyUploadAdapter(loader);
            };
        }

        ClassicEditor
            .create(document.querySelector('#editor'), {
                extraPlugins: [MyCustomUploadAdapterPlugin],
                placeholder: 'Mulai tulis ceritamu...',
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable', 'uploadImage', 'undo', 'redo']
            })
            .then(editor => {
                const initialData = {!! json_encode($content) !!};

                if (initialData) {
                    editor.setData(initialData);
                }

                editor.model.document.on('change:data', () => {
                    @this.set('content', editor.getData());
                });
            })
            .catch(error => {
                console.error(error);
            });
    </script>
</div>