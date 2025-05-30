<x-layout title="Barang">
    <!-- Modal Tambah Barang -->
    <div id="addBarangModal"
        class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-black/50 transition-opacity duration-300">
        <div id="addModalContent"
            class="w-full max-w-md bg-white rounded-lg shadow-xl transform transition-all duration-300 scale-95 opacity-0 overflow-hidden">
            <!-- Modal Header -->
            <div class="flex items-center justify-between px-6 py-4 bg-blue-600">
                <h3 class="text-lg font-semibold text-white">Tambah Barang Baru</h3>
                <button onclick="closeAddBarangModal()" class="text-white hover:text-blue-200 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data" class="p-6"
                id="addBarangForm">
                @csrf
                <div class="space-y-4">
                    <div class="p-3 mb-4 rounded-md bg-blue-50">
                        <p class="text-sm text-blue-800">Kode Barang akan dibuat otomatis oleh sistem.</p>
                    </div>

                    <div>
                        <label for="kategori_barang" class="block mb-1 text-sm font-medium text-gray-700">Kategori
                            Barang <span class="text-red-500">*</span></label>
                        <input type="text" id="kategori_barang" name="kategori_barang" required
                            class="w-full px-3 py-2 transition duration-200 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Contoh: Elektronik, Makanan, dll">
                        <div id="kategori-error" class="hidden mt-1 text-sm text-red-600"></div>
                    </div>

                    <div>
                        <label for="nama_barang" class="block mb-1 text-sm font-medium text-gray-700">Nama Barang <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="nama_barang" name="nama_barang" required
                            class="w-full px-3 py-2 transition duration-200 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Nama lengkap barang">
                        <div id="nama-error" class="hidden mt-1 text-sm text-red-600"></div>
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Foto Barang</label>
                        <div class="flex items-center mt-1">
                            <label for="foto" class="cursor-pointer">
                                <span
                                    class="inline-block px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                                    Pilih File
                                </span>
                                <input id="foto" name="foto" type="file" accept="image/*" class="sr-only">
                            </label>
                            <span id="file-name" class="ml-2 text-sm text-gray-500">Tidak ada file dipilih</span>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG (Maks. 2MB)</p>
                        <div id="foto-error" class="hidden mt-1 text-sm text-red-600"></div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label for="harga_modal" class="block mb-1 text-sm font-medium text-gray-700">Harga Modal
                                <span class="text-red-500">*</span></label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <span class="text-gray-500">Rp</span>
                                </div>
                                <input type="number" id="harga_modal" name="harga_modal" required min="0"
                                    class="block w-full py-2 pl-10 pr-3 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                    placeholder="0">
                            </div>
                            <div id="harga_modal-error" class="hidden mt-1 text-sm text-red-600"></div>
                        </div>

                        <div>
                            <label for="harga_jual" class="block mb-1 text-sm font-medium text-gray-700">Harga Jual
                                <span class="text-red-500">*</span></label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <span class="text-gray-500">Rp</span>
                                </div>
                                <input type="number" id="harga_jual" name="harga_jual" required min="0"
                                    class="block w-full py-2 pl-10 pr-3 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                    placeholder="0">
                            </div>
                            <div id="harga_jual-error" class="hidden mt-1 text-sm text-red-600"></div>
                        </div>
                    </div>

                    <div>
                        <label for="stok" class="block mb-1 text-sm font-medium text-gray-700">Stok Awal <span
                                class="text-red-500">*</span></label>
                        <input type="number" id="stok" name="stok" required min="0"
                            class="w-full px-3 py-2 transition duration-200 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                            placeholder="0">
                        <div id="stok-error" class="hidden mt-1 text-sm text-red-600"></div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="flex justify-end pt-4 mt-6 space-x-3 border-t border-gray-200">
                    <button type="button" onclick="closeAddBarangModal()"
                        class="px-4 py-2 text-sm font-medium text-gray-700 transition-colors duration-200 bg-gray-100 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white transition-colors duration-200 bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Simpan Barang
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Barang -->
    <div id="editBarangModal"
        class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-black/50 transition-opacity duration-300">
        <div id="editModalContent"
            class="w-full max-w-md bg-white rounded-lg shadow-xl transform transition-all duration-300 scale-95 opacity-0 overflow-hidden">
            <!-- Content will be loaded here via AJAX -->
        </div>
    </div>

    <!-- Modal Detail Barang -->
    <div id="detailBarangModal"
        class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-black/50 transition-opacity duration-300">
        <div id="detailModalContent"
            class="w-full max-w-md bg-white rounded-lg shadow-xl transform transition-all duration-300 scale-95 opacity-0 overflow-hidden">
            <!-- Content will be loaded here via AJAX -->
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="deleteConfirmationModal"
        class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-black/50">
        <div class="w-full max-w-md overflow-hidden bg-white rounded-lg shadow-xl">
            <div class="p-6">
                <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full">
                    <svg class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div class="mt-3 text-center sm:mt-5">
                    <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">Konfirmasi Hapus Barang
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">Apakah Anda yakin ingin menghapus barang ini? Data yang
                            dihapus tidak dapat dikembalikan.</p>
                    </div>
                </div>
            </div>
            <div class="flex justify-end px-6 py-4 space-x-3 bg-gray-50">
                <button type="button" onclick="closeDeleteModal()"
                    class="px-4 py-2 text-sm font-medium text-gray-700 transition-colors duration-200 bg-gray-100 rounded-md hover:bg-gray-200">
                    Batal
                </button>
                <form id="deleteForm" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white transition-colors duration-200 bg-red-600 rounded-md hover:bg-red-700">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="flex flex-col mb-6 space-y-4 md:space-y-0 md:flex-row md:justify-between md:items-center">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Barang</h1>
        <!-- Tombol buka modal -->
        <button onclick="openAddBarangModal()"
            class="flex items-center px-4 py-2 text-white transition-colors duration-200 bg-blue-600 rounded-lg hover:bg-blue-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                    clip-rule="evenodd" />
            </svg>
            Tambah Barang
        </button>
    </div>

    @if (session('success'))
        <div class="p-4 mb-6 text-green-700 bg-green-100 border-l-4 border-green-500 rounded">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="overflow-hidden bg-white shadow rounded-lg">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th
                            class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase sm:px-6">
                            Foto</th>
                        <th
                            class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase sm:px-6">
                            Kode</th>
                        <th
                            class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase sm:px-6">
                            Nama Barang</th>
                        <th
                            class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase sm:px-6">
                            Kategori</th>
                        <th
                            class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase sm:px-6">
                            Harga Modal</th>
                        <th
                            class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase sm:px-6">
                            Harga Jual</th>
                        <th
                            class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase sm:px-6">
                            Stok</th>
                        <th
                            class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase sm:px-6">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($barang as $item)
                        <tr>
                            <td class="px-4 py-4 whitespace-nowrap sm:px-6">
                                @if ($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_barang }}"
                                        class="object-cover w-10 h-10 rounded-full">
                                @else
                                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-500 whitespace-nowrap sm:px-6">
                                {{ $item->kode_barang }}</td>
                            <td class="px-4 py-4 whitespace-nowrap sm:px-6">
                                <div class="text-sm font-medium text-gray-900">{{ $item->nama_barang }}</div>
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-500 whitespace-nowrap sm:px-6">
                                {{ $item->kategori_barang }}</td>
                            <td class="px-4 py-4 text-sm text-gray-500 whitespace-nowrap sm:px-6">Rp
                                {{ number_format($item->harga_modal, 0, ',', '.') }}</td>
                            <td class="px-4 py-4 text-sm font-medium text-blue-600 whitespace-nowrap sm:px-6">Rp
                                {{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                            <td class="px-4 py-4 text-sm text-gray-500 whitespace-nowrap sm:px-6">{{ $item->stok }}
                            </td>
                            <td class="px-4 py-4 text-sm font-medium whitespace-nowrap sm:px-6">
                                <div class="flex space-x-2">
                                    <button onclick="openDetailModal({{ $item->id }})"
                                        class="text-blue-600 hover:text-blue-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                    <button onclick="openEditModal({{ $item->id }})"
                                        class="text-yellow-600 hover:text-yellow-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <button onclick="openDeleteModal({{ $item->id }})"
                                        class="text-red-600 hover:text-red-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-4 text-sm text-center text-gray-500 sm:px-6">
                                Tidak ada data barang
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($barang->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $barang->links() }}
            </div>
        @endif
    </div>

    <script>
        // Fungsi-fungsi modal tetap sama seperti sebelumnya
        function openAddBarangModal() {
            const modal = document.getElementById('addBarangModal');
            const modalContent = document.getElementById('addModalContent');

            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                modalContent.classList.remove('scale-95');
                modalContent.classList.remove('opacity-0');
            }, 10);

            document.body.classList.add('overflow-hidden');
        }

        function closeAddBarangModal() {
            const modal = document.getElementById('addBarangModal');
            const modalContent = document.getElementById('addModalContent');

            modalContent.classList.add('scale-95');
            modalContent.classList.add('opacity-0');
            modal.classList.add('opacity-0');

            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
                document.getElementById('addBarangForm').reset();
                document.getElementById('file-name').textContent = 'Tidak ada file dipilih';
                clearErrorMessages();
            }, 300);
        }

        function openDetailModal(barangId) {
            fetch(`/barang/${barangId}`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('detailModalContent').innerHTML = html;
                    const modal = document.getElementById('detailBarangModal');
                    const modalContent = document.getElementById('detailModalContent');

                    modal.classList.remove('hidden');
                    setTimeout(() => {
                        modal.classList.remove('opacity-0');
                        modalContent.classList.remove('scale-95');
                        modalContent.classList.remove('opacity-0');
                    }, 10);

                    document.body.classList.add('overflow-hidden');
                })
                .catch(error => {
                    console.error('Error:', error);
                    showErrorAlert('Terjadi kesalahan saat memuat detail barang');
                });
        }

        function closeDetailModal() {
            const modal = document.getElementById('detailBarangModal');
            const modalContent = document.getElementById('detailModalContent');

            modalContent.classList.add('scale-95');
            modalContent.classList.add('opacity-0');
            modal.classList.add('opacity-0');

            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }, 300);
        }

        function openEditModal(barangId) {
            fetch(`/barang/${barangId}/edit`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('editModalContent').innerHTML = html;
                    const modal = document.getElementById('editBarangModal');
                    const modalContent = document.getElementById('editModalContent');

                    modal.classList.remove('hidden');
                    setTimeout(() => {
                        modal.classList.remove('opacity-0');
                        modalContent.classList.remove('scale-95');
                        modalContent.classList.remove('opacity-0');
                    }, 10);

                    document.body.classList.add('overflow-hidden');

                    const editFotoInput = document.getElementById('edit-foto');
                    if (editFotoInput) {
                        editFotoInput.addEventListener('change', function(e) {
                            const fileName = e.target.files[0] ? e.target.files[0].name :
                                'Gunakan file saat ini';
                            document.getElementById('edit-file-name').textContent = fileName;
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showErrorAlert('Terjadi kesalahan saat memuat data barang');
                });
        }

        function closeEditModal() {
            const modal = document.getElementById('editBarangModal');
            const modalContent = document.getElementById('editModalContent');

            modalContent.classList.add('scale-95');
            modalContent.classList.add('opacity-0');
            modal.classList.add('opacity-0');

            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }, 300);
        }

        function openDeleteModal(barangId) {
            const modal = document.getElementById('deleteConfirmationModal');
            const form = document.getElementById('deleteForm');

            form.action = `/barang/${barangId}`;
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteConfirmationModal');
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // Fungsi bantuan untuk SweetAlert
        function showSuccessAlert(message) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: message,
                confirmButtonColor: '#3b82f6',
            });
        }

        function showErrorAlert(message) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: message,
                confirmButtonColor: '#3b82f6',
            });
        }

        // Event listeners dan fungsi pendukung tetap sama
        window.onclick = function(event) {
            const addModal = document.getElementById('addBarangModal');
            const editModal = document.getElementById('editBarangModal');
            const detailModal = document.getElementById('detailBarangModal');
            const deleteModal = document.getElementById('deleteConfirmationModal');

            if (event.target === addModal) closeAddBarangModal();
            if (event.target === editModal) closeEditModal();
            if (event.target === detailModal) closeDetailModal();
            if (event.target === deleteModal) closeDeleteModal();
        };

        document.getElementById('foto').addEventListener('change', function(e) {
            document.getElementById('file-name').textContent =
                e.target.files[0] ? e.target.files[0].name : 'Tidak ada file dipilih';
        });

        // Handle form submission dengan SweetAlert
        document.getElementById('addBarangForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = e.target;
            const formData = new FormData(form);

            fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'error') {
                        clearErrorMessages();
                        for (const [field, messages] of Object.entries(data.errors)) {
                            const errorElement = document.getElementById(`${field}-error`);
                            if (errorElement) {
                                errorElement.textContent = messages[0];
                                errorElement.classList.remove('hidden');
                            }
                        }
                    } else if (data.status === 'success') {
                        showSuccessAlert(data.message || 'Barang berhasil ditambahkan');
                        setTimeout(() => window.location.reload(), 1500);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showErrorAlert('Terjadi kesalahan saat menyimpan data');
                });
        });

        document.addEventListener('submit', function(e) {
            if (e.target && e.target.id === 'editBarangForm') {
                e.preventDefault();
                const form = e.target;
                const formData = new FormData(form);

                fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'X-HTTP-Method-Override': 'PUT'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'error') {
                            clearErrorMessages();
                            for (const [field, messages] of Object.entries(data.errors)) {
                                const errorElement = document.getElementById(`edit-${field}-error`);
                                if (errorElement) {
                                    errorElement.textContent = messages[0];
                                    errorElement.classList.remove('hidden');
                                }
                            }
                        } else if (data.status === 'success') {
                            showSuccessAlert(data.message || 'Barang berhasil diperbarui');
                            setTimeout(() => window.location.reload(), 1500);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showErrorAlert('Terjadi kesalahan saat menyimpan data');
                    });
            }
        });

        document.getElementById('deleteForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = e.target;

            fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-HTTP-Method-Override': 'DELETE'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        showSuccessAlert(data.message || 'Barang berhasil dihapus');
                        setTimeout(() => window.location.reload(), 1500);
                    } else {
                        showErrorAlert(data.message || 'Terjadi kesalahan saat menghapus data');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showErrorAlert('Terjadi kesalahan saat menghapus data');
                });
        });

        function clearErrorMessages() {
            document.querySelectorAll('[id$="-error"]').forEach(el => {
                el.textContent = '';
                el.classList.add('hidden');
            });
        }

        // Tangkap notifikasi dari Laravel
        @if (session('success'))
            showSuccessAlert('{{ session('success') }}');
        @endif

        @if (session('error'))
            showErrorAlert('{{ session('error') }}');
        @endif
    </script>
</x-layout>
