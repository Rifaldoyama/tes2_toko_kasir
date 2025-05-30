<div class="bg-white rounded-lg shadow-xl w-full max-w-md overflow-hidden">
    <!-- Modal Header -->
    <div class="bg-blue-600 px-6 py-4 flex justify-between items-center">
        <h3 class="text-lg font-semibold text-white">Detail Barang</h3>
        <button onclick="closeDetailModal()" class="text-white hover:text-blue-200 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Modal Body -->
    <div class="p-6">
        <div class="flex flex-col items-center mb-4">
            @if($barang->foto)
                <img src="{{ asset('storage/' . $barang->foto) }}" alt="{{ $barang->nama_barang }}" class="h-32 w-32 rounded-full object-cover mb-4">
            @else
                <div class="h-32 w-32 rounded-full bg-gray-200 flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            @endif
            <h2 class="text-xl font-bold text-gray-800">{{ $barang->nama_barang }}</h2>
            <span class="text-sm text-gray-500">{{ $barang->kode_barang }}</span>
        </div>

        <div class="space-y-3">
            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-600">Kategori</span>
                <span class="font-medium">{{ $barang->kategori_barang }}</span>
            </div>
            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-600">Harga Modal</span>
                <span class="font-medium">Rp {{ number_format($barang->harga_modal, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-600">Harga Jual</span>
                <span class="font-medium text-blue-600">Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-600">Stok Tersedia</span>
                <span class="font-medium">{{ $barang->stok }}</span>
            </div>
            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-600">Tanggal Dibuat</span>
                <span class="font-medium">{{ $barang->created_at->format('d M Y ') }}</span>
            </div>
        </div>
    </div>

    <!-- Modal Footer -->
    <div class="flex justify-end space-x-3 px-6 py-4 border-t border-gray-200">
        <button onclick="closeDetailModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 transition-colors duration-200">
            Tutup
        </button>
    </div>
</div>