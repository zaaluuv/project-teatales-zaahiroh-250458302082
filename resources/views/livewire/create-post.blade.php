<x-app-layout>
<div class="max-w-7xl mx-auto">
    <style>
        .ck.ck-editor__main>.ck-editor__editable:not(.ck-focused) {
            border-color: #e5e7eb !important;
        }

        .ck.ck-editor__main>.ck-editor__editable.ck-focused {
            border-color: #0d9488 !important;
            box-shadow: 0 0 0 1px #0d9488 !important;
        }

        .ck.ck-toolbar {
            background-color: #f9fafb !important;
            border-color: #e5e7eb !important;
        }

        .ck-editor__editable {
            min-height: 500px;
            padding: 1rem 2rem !important;
            font-family: 'Inter', sans-serif !important;
        }

        .ck-powered-by { display: none; }
    </style>

    <form wire:submit="save"> 
        <main class="container mx-auto px-6 py-12">
            <div class="flex flex-col lg:flex-row gap-12">
                <div class="lg:w-2/3">
                    <div class="bg-white p-6 sm:p-10 rounded-2xl shadow-lg border border-gray-100 h-full">
                        <div>
                            <label for="title" class="sr-only">Judul Artikel</label>
                            <input type="text" wire:model="title" id="title" placeholder="Judul Artikelmu..." class="w-full text-3xl sm:text-4xl font-extrabold text-gray-900 border-0 border-b-2 border-gray-200 p-2 focus:ring-0 focus:border-teal-500 transition-colors">
                            @error('title') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="mt-8">
                            <label for="content" class="sr-only">Isi Konten</label>
                            
                            <div wire:ignore>
                                <textarea id="content" rows="18" class="w-full h-auto text-lg text-gray-700 border border-gray-200 rounded-lg p-4 focus:outline-none focus:ring-2 focus:ring-teal-500 transition-colors" placeholder="Mulai tulis ceritamu di sini..."></textarea>
                            </div>
                            @error('content') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <aside class="lg:w-1/3">
                    <div class="lg:sticky lg:top-8 space-y-8">
                        <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
                            <h4 class="text-lg font-bold text-gray-800 mb-5 border-b pb-3">Publikasi</h4>
                            <div class="flex gap-4">
                                <button type="button" wire:click="$set('status', 'draft')" wire:loading.attr="disabled" onclick="confirm('Simpan sebagai draft?') || event.stopImmediatePropagation()" wire:click="save" class="flex-1 text-center bg-gray-200 text-gray-700 px-5 py-2 rounded-full font-medium hover:bg-gray-300 transition-colors">
                                    Simpan Draft
                                </button>
                                
                                <button type="submit" wire:loading.attr="disabled" class="flex-1 text-center bg-teal-600 text-white px-5 py-2 rounded-full font-semibold hover:bg-teal-700 transition-colors">
                                    <span wire:loading.remove>Publikasikan</span>
                                    <span wire:loading>Processing...</span>
                                </button>
                            </div>
                        </div>
                        
                        <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
                            <h4 class="text-lg font-bold text-gray-800 mb-4">Gambar Utama</h4>
                            <label for="thumbnail" class="mt-4 border-2 border-dashed border-gray-300 rounded-lg p-8 text-center cursor-pointer block hover:border-teal-500 hover:bg-teal-50 transition-colors relative">
                                
                                @if ($thumbnail)
                                    <img src="{{ $thumbnail->temporaryUrl() }}" class="absolute inset-0 w-full h-full object-cover rounded-lg opacity-50">
                                @endif

                                <div class="relative z-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l-1.586-1.586a2 2 0 00-2.828 0L6 14m6-6l.01.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="mt-2 block text-sm font-medium text-gray-700">
                                        Seret & lepas gambar
                                    </span>
                                    <span class="text-xs text-gray-500">atau klik untuk memilih file</span>
                                </div>
                            </label>
                            
                            <input type="file" wire:model="thumbnail" id="thumbnail" class="hidden">
                            @error('thumbnail') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
                            <h4 class="text-lg font-bold text-gray-800 mb-4">Kategori & Tags</h4>
                            <div class="mb-4">
                                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                                <select wire:model="category_id" id="category_id" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                                    <option value="">Pilih Kategori</option>

                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="tags" class="block text-sm font-medium text-gray-700 mb-1">Tags</label>
                                <input type="text" wire:model="tags" id="tags" placeholder="tag" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </main>
    </form>
    
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>

    <script>
    class MyUploadAdapter {
            constructor(loader) {
                this.loader = loader;
            }
            upload() {
                return this.loader.file
                    .then(file => new Promise((resolve, reject) => {
                        const reader = new FileReader();
                        reader.onload = () => {
                            resolve({ default: reader.result });
                        };
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
        .create(document.querySelector('#content'), {
            extraPlugins: [ MyCustomUploadAdapterPlugin ],
            toolbar: [ 
                'heading', '|', 
                'bold', 'italic', 'underline', 'strikethrough', 'link', '|',
                'bulletedList', 'numberedList', '|',
                'outdent', 'indent', '|',
                'imageUpload', 'blockQuote', '|',
                'undo', 'redo'
            ],
            placeholder: 'Mulai tulis ceritamu di sini...'
        })
        .then(editor => {
            editor.model.document.on('change:data', () => {
                @this.set('content', editor.getData());
            });
        })
        .catch(error => {
            console.error('Ada masalah saat memuat editor:', error);
        });
    </script>
</div>
</x-app-layout>