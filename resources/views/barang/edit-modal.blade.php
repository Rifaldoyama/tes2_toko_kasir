<form id="editBarangForm" action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md overflow-hidden">
        <!-- Modal Header -->
        <div class="bg-blue-600 px-6 py-4 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-white">Edit Barang</h3>
            <button type="button" onclick="closeEditModal()" class="text-white hover:text-blue-200 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="p-6 space-y-4">
            <div>
                <label for="edit-kategori_barang" class="block text-sm font-medium text-gray-700 mb-1">Kategori Barang <span class="text-red-500">*</span></label>
                <input type="text" id="edit-kategori_barang" name="kategori_barang" required
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                    value="{{ $barang->kategori_barang }}">
                <div id="edit-kategori-error" class="mt-1 text-sm text-red-600 hidden"></div>
            </div>

            <div>
                <label for="edit-nama_barang" class="block text-sm font-medium text-gray-700 mb-1">Nama Barang <span class="text-red-500">*</span></label>
                <input type="text" id="edit-nama_barang" name="nama_barang" required
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                    value="{{ $barang->nama_barang }}">
                <div id="edit-nama-error" class="mt-1 text-sm text-red-600 hidden"></div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Foto Barang</label>
                <div class="mt-1 flex items-center">
                    <label for="edit-foto" class="cursor-pointer">
                        <span class="inline-block px-4 py-2 border border-gray-300 rounded-md bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                            Pilih File
                        </span>
                        <input id="edit-foto" name="foto" type="file" accept="image/*" class="sr-only">
                    </label>
                    <span id="edit-file-name" class="ml-2 text-sm text-gray-500">Gunakan file saat ini</span>
                </div>
                @if($barang->foto)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $barang->foto) }}" alt="Current photo" class="h-20 w-20 object-cover rounded">
                    </div>
                @endif
                <div id="edit-foto-error" class="mt-1 text-sm text-red-600 hidden"></div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="edit-harga_modal" class="block text-sm font-medium text-gray-700 mb-1">Harga Modal <span class="text-red-500">*</span></label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500">Rp</span>
                        </div>
                        <input type="number" id="edit-harga_modal" name="harga_modal" required min="0"
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            value="{{ $barang->harga_modal }}">
                    </div>
                    <div id="edit-harga_modal-error" class="mt-1 text-sm text-red-600 hidden"></div>
                </div>

                <div>
                    <label for="edit-harga_jual" class="block text-sm font-medium text-gray-700 mb-1">Harga Jual <span class="text-red-500">*</span></label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500">Rp</span>
                        </div>
                        <input type="number" id="edit-harga_jual" name="harga_jual" required min="0"
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            value="{{ $barang->harga_jual }}">
                    </div>
                    <div id="edit-harga_jual-error" class="mt-1 text-sm text-red-600 hidden"></div>
                </div>
            </div>

            <div>
                <label for="edit-stok" class="block text-sm font-medium text-gray-700 mb-1">Stok <span class="text-red-500">*</span></label>
                <input type="number" id="edit-stok" name="stok" required min="0"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                    value="{{ $barang->stok }}">
                <div id="edit-stok-error" class="mt-1 text-sm text-red-600 hidden"></div>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="flex justify-end space-x-3 px-6 py-4 border-t border-gray-200">
            <button type="button" onclick="closeEditModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 transition-colors duration-200">
                Batal
            </button>
            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 transition-colors duration-200">
                Simpan Perubahan
            </button>
        </div>
    </div>
</form>