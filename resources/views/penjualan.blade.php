<x-layout title="Penjualan">
    <div class="flex flex-col gap-4 lg:flex-row">
        <!-- Left Div - Product Selection and Cart -->
        <div
            class="w-full lg:w-3/4 h-auto lg:h-[50.5rem] bg-gradient-to-r from-gray-900 via-gray-800 to-gray-700 rounded-lg p-4 shadow-lg">
            <div class="text-white">
                <h2 class="text-xl font-semibold mb-4">Daftar Produk</h2>

                <!-- Product Search -->
                <div class="mb-4 relative">
                    <input type="text" id="productSearch" placeholder="Cari produk..."
                        class="w-full px-4 py-2 rounded-lg bg-gray-800 border border-gray-600 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute right-3 top-2.5 text-gray-400"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>

                <!-- Product List -->
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3 mb-4" id="productList">
                    <!-- Products will be loaded here via JavaScript -->
                    <div class="col-span-full text-center py-10">
                        <div class="animate-pulse flex flex-col items-center">
                            <div class="h-5 w-5 bg-gray-700 rounded-full mb-2"></div>
                            <p class="text-gray-400">Memuat daftar produk...</p>
                        </div>
                    </div>
                </div>

                <h2 class="text-xl font-semibold mb-4 mt-6">Keranjang Belanja</h2>
                <div class="bg-gray-800 rounded-lg p-4 shadow-inner">
                    <div class="overflow-x-auto">
                        <table class="w-full text-white">
                            <thead>
                                <tr class="border-b border-gray-600">
                                    <th class="text-left py-2 px-2">Produk</th>
                                    <th class="text-left py-2 px-2">Harga</th>
                                    <th class="text-left py-2 px-2">Qty</th>
                                    <th class="text-left py-2 px-2">Subtotal</th>
                                    <th class="text-left py-2 px-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="cartItems">
                                <!-- Cart items will be added here -->
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-gray-400">Keranjang kosong</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="border-t border-gray-600 font-semibold">
                                    <td colspan="3" class="text-right py-2 px-2">Total:</td>
                                    <td id="cartTotal" class="px-2">Rp 0</td>
                                    <td class="px-2"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Div - Payment Form -->
        <div
            class="w-full lg:w-1/4 h-auto lg:h-[50.5rem] bg-gradient-to-r from-gray-900 via-gray-800 to-gray-700 rounded-lg shadow-lg">
            <div class="text-white p-4 space-y-6">
                <h2 class="text-xl font-semibold mb-4">Form Pembayaran</h2>

                <form id="formPembayaran" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block mb-1 text-sm text-gray-300">Total Belanja</label>
                        <input type="text" id="totalBelanja" name="totalBelanja" readonly
                            class="w-full px-4 py-2 rounded-lg bg-gray-800 border border-gray-600 text-white font-medium">
                    </div>

                    <div>
                        <label class="block mb-1 text-sm text-gray-300">Uang Bayar</label>
                        <input type="text" id="uangBayar" name="uangBayar"
                            class="w-full px-4 py-2 rounded-lg bg-gray-800 border border-gray-600 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                            placeholder="Masukkan nominal bayar">
                    </div>

                    <div>
                        <label class="block mb-1 text-sm text-gray-300">Kembalian</label>
                        <input type="text" id="kembalian" name="kembalian" readonly
                            class="w-full px-4 py-2 rounded-lg bg-gray-800 border border-gray-600 text-white font-medium"
                            value="Rp 0">
                    </div>

                    <button type="button" id="prosesPembayaranBtn"
                        class="w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold py-3 px-4 rounded-lg shadow-md transition duration-200 transform hover:scale-[1.02]">
                        Proses Pembayaran
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Payment Method Modal -->
    <div id="paymentModal"
        class="hidden fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 backdrop-blur-sm">
        <div class="bg-gray-800 rounded-xl p-6 w-full max-w-sm mx-4 shadow-2xl">
            <h3 class="text-xl font-semibold mb-4 text-white">Pilih Metode Pembayaran</h3>

            <div class="space-y-3">
                <button id="cashPaymentBtn"
                    class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white py-3 px-4 rounded-lg transition duration-200 transform hover:scale-[1.02]">
                    Tunai
                </button>
                <button id="qrPaymentBtn"
                    class="w-full bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white py-3 px-4 rounded-lg transition duration-200 transform hover:scale-[1.02]">
                    QR Code
                </button>
                <button id="cancelPaymentBtn"
                    class="w-full bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 text-white py-3 px-4 rounded-lg transition duration-200 transform hover:scale-[1.02]">
                    Batal
                </button>
            </div>
        </div>
    </div>

    <!-- QR Code Modal -->
    <!-- QR Code Modal -->
    <div id="qrModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-gray-800 rounded-lg p-6 w-96">
            <h3 class="text-xl font-semibold mb-4 text-white">Scan QR Code</h3>
            <div class="flex justify-center mb-4" id="qrCodeContainer">
                <!-- QR Code will be generated here -->
            </div>
            <div class="text-center text-white mb-4">
                <p>Total Pembayaran: <span id="qrTotalAmount">Rp 0</span></p>
            </div>
            <button id="confirmQrPaymentBtn"
                class="w-full bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded">
                Konfirmasi Pembayaran
            </button>
            <button id="cancelQrPaymentBtn"
                class="w-full mt-2 bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded">
                Batal
            </button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
    <script>
        // Shopping cart
        let cart = [];
        let products = [];
        let paymentMethod = null;

        // Format to Rupiah
        function formatRupiah(angka) {
            const numberValue = Number(angka) || 0;
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(numberValue);
        }

        // Parse Rupiah back to number
        function parseRupiah(rupiah) {
            if (typeof rupiah === 'number') return rupiah;
            return Number(rupiah.toString().replace(/\D/g, '')) || 0;
        }

        // Load products from server
        function loadProducts() {
            fetch('/penjualan/barang')
                .then(response => response.json())
                .then(data => {
                    products = data;
                    renderProducts(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('productList').innerHTML = `
                        <div class="col-span-4 text-center py-10">
                            <p class="text-red-400">Gagal memuat daftar produk</p>
                        </div>
                    `;
                });
        }

        // Render product list
        function renderProducts(products) {
            const productList = document.getElementById('productList');
            productList.innerHTML = '';

            if (products.length === 0) {
                productList.innerHTML = `
                    <div class="col-span-4 text-center py-10">
                        <p class="text-gray-400">Tidak ada produk tersedia</p>
                    </div>
                `;
                return;
            }

            products.forEach(product => {
                const productElement = document.createElement('div');
                productElement.className = 'bg-gray-800 p-3 rounded-lg cursor-pointer hover:bg-gray-700 transition';
                productElement.innerHTML = `
                    <div class="flex items-center mb-2">
                        <img src="${product.foto_url}" alt="${product.nama_barang}" 
                             class="w-10 h-10 object-cover rounded mr-2">
                        <h3 class="font-semibold">${product.nama_barang}</h3>
                    </div>
                    <p class="text-sm text-gray-300">${formatRupiah(product.harga_jual)}</p>
                    <p class="text-xs text-gray-400">Stok: ${product.stok}</p>
                    <p class="text-xs text-gray-400">Kode: ${product.kode_barang}</p>
                `;
                productElement.addEventListener('click', () => addToCart(product));
                productList.appendChild(productElement);
            });
        }

        // Add product to cart
        function addToCart(product) {
            const productStock = Number(product.stok) || 0;
            const existingItemIndex = cart.findIndex(item => item.barang_id === product.id);

            if (existingItemIndex >= 0) {
                const item = cart[existingItemIndex];
                const newQty = Number(item.jumlah) + 1;

                if (newQty > productStock) {
                    alert('Stok tidak mencukupi!');
                    return;
                }

                cart[existingItemIndex].jumlah = newQty;
                cart[existingItemIndex].subtotal = newQty * Number(item.harga_satuan);
            } else {
                if (productStock < 1) {
                    alert('Stok barang habis!');
                    return;
                }

                cart.push({
                    barang_id: product.id,
                    kode_barang: product.kode_barang,
                    nama_barang: product.nama_barang,
                    harga_satuan: Number(product.harga_jual) || 0,
                    jumlah: 1,
                    subtotal: Number(product.harga_jual) || 0
                });
            }

            updateCart();
        }

        // Update cart display
        function updateCart() {
            const cartItems = document.getElementById('cartItems');
            cartItems.innerHTML = '';

            let totalBelanjaAngka = 0;

            if (cart.length === 0) {
                cartItems.innerHTML = `
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-400">Keranjang kosong</td>
                    </tr>
                `;
            } else {
                cart.forEach(item => {
                    item.harga_satuan = Number(item.harga_satuan) || 0;
                    item.jumlah = Number(item.jumlah) || 0;
                    item.subtotal = item.harga_satuan * item.jumlah;
                    totalBelanjaAngka += item.subtotal;

                    const row = document.createElement('tr');
                    row.className = 'border-b border-gray-700';
                    row.innerHTML = `
                        <td class="py-2">${item.nama_barang}</td>
                        <td class="py-2">${formatRupiah(item.harga_satuan)}</td>
                        <td class="py-2">
                            <div class="flex items-center">
                                <button class="px-2 bg-gray-700 rounded-l decrease-btn" data-id="${item.barang_id}">-</button>
                                <span class="px-2 bg-gray-800">${item.jumlah}</span>
                                <button class="px-2 bg-gray-700 rounded-r increase-btn" data-id="${item.barang_id}">+</button>
                            </div>
                        </td>
                        <td class="py-2">${formatRupiah(item.subtotal)}</td>
                        <td class="py-2">
                            <button class="text-red-500 remove-btn" data-id="${item.barang_id}">Hapus</button>
                        </td>
                    `;
                    cartItems.appendChild(row);
                });
            }

            document.getElementById('cartTotal').textContent = formatRupiah(totalBelanjaAngka);
            document.getElementById('totalBelanja').value = formatRupiah(totalBelanjaAngka);
            document.getElementById('qrTotalAmount').textContent = formatRupiah(totalBelanjaAngka);

            // Update kembalian if uangBayar already has value
            const uangBayar = document.getElementById('uangBayar');
            if (uangBayar.value) {
                const bayarValue = parseRupiah(uangBayar.value);
                const kembali = bayarValue - totalBelanjaAngka;
                document.getElementById('kembalian').value = formatRupiah(Math.max(kembali, 0));
            }

            // Attach event listeners to buttons
            document.querySelectorAll('.increase-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const id = parseInt(e.target.getAttribute('data-id'));
                    const item = cart.find(item => item.barang_id === id);
                    const product = products.find(p => p.id === id);

                    const currentStock = Number(product.stok) - item.jumlah;
                    if (currentStock > 0) {
                        item.jumlah += 1;
                        item.subtotal = item.jumlah * item.harga_satuan;
                        updateCart();
                    } else {
                        alert('Stok tidak mencukupi');
                    }
                });
            });

            document.querySelectorAll('.decrease-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const id = parseInt(e.target.getAttribute('data-id'));
                    const item = cart.find(item => item.barang_id === id);

                    if (item.jumlah > 1) {
                        item.jumlah -= 1;
                        item.subtotal = item.jumlah * item.harga_satuan;
                        updateCart();
                    }
                });
            });

            document.querySelectorAll('.remove-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const id = parseInt(e.target.getAttribute('data-id'));
                    cart = cart.filter(item => item.barang_id !== id);
                    updateCart();
                });
            });
        }

        // Payment calculation
        document.getElementById('uangBayar').addEventListener('input', function() {
            const bayarValue = parseRupiah(this.value);
            this.value = formatRupiah(bayarValue);

            const totalBelanja = parseRupiah(document.getElementById('totalBelanja').value);
            const kembali = bayarValue - totalBelanja;

            document.getElementById('kembalian').value = formatRupiah(Math.max(kembali, 0));
        });

        // Payment method selection
        document.getElementById('prosesPembayaranBtn').addEventListener('click', function() {
            if (cart.length === 0) {
                alert('Keranjang belanja kosong!');
                return;
            }

            paymentMethod = null;
            document.getElementById('paymentModal').classList.remove('hidden');
        });

        // Cash payment
        document.getElementById('cashPaymentBtn').addEventListener('click', function() {
            paymentMethod = 'tunai';
            document.getElementById('paymentModal').classList.add('hidden');

            const bayarValue = parseRupiah(document.getElementById('uangBayar').value);
            const totalBelanja = parseRupiah(document.getElementById('totalBelanja').value);

            if (bayarValue < totalBelanja) {
                alert('Uang bayar tidak mencukupi!');
                return;
            }

            processPayment();
        });

        // QR payment
        document.getElementById('qrPaymentBtn').addEventListener('click', function() {
            paymentMethod = 'qr';
            document.getElementById('paymentModal').classList.add('hidden');

            const qrCodeContainer = document.getElementById('qrCodeContainer');
            qrCodeContainer.innerHTML = '';

            const transactionData = {
                total: parseRupiah(document.getElementById('totalBelanja').value),
                items: cart.map(item => ({
                    kode: item.kode_barang,
                    nama: item.nama_barang,
                    qty: item.jumlah,
                    harga: item.harga_satuan
                })),
                timestamp: new Date().toISOString()
            };

            new QRCode(qrCodeContainer, {
                text: JSON.stringify(transactionData),
                width: 200,
                height: 200,
                colorDark: "#ffffff",
                colorLight: "transparent",
                correctLevel: QRCode.CorrectLevel.H
            });

            document.getElementById('qrModal').classList.remove('hidden');
        });

        // Confirm QR payment
        document.getElementById('confirmQrPaymentBtn').addEventListener('click', function() {
            document.getElementById('qrModal').classList.add('hidden');
            processPayment();
        });

        // Cancel payment
        document.getElementById('cancelPaymentBtn').addEventListener('click', function() {
            document.getElementById('paymentModal').classList.add('hidden');
        });

        // Cancel QR payment
        document.getElementById('cancelQrPaymentBtn').addEventListener('click', function() {
            document.getElementById('qrModal').classList.add('hidden');
            document.getElementById('paymentModal').classList.remove('hidden');
        });

        // Process payment
        function processPayment() {
            const totalBelanja = parseRupiah(document.getElementById('totalBelanja').value);
            const bayarValue = paymentMethod === 'tunai' ?
                parseRupiah(document.getElementById('uangBayar').value) :
                totalBelanja;

            const formData = {
                items: cart,
                total_harga: totalBelanja,
                uang_diterima: bayarValue,
                jenis_pembayaran: paymentMethod,
                _token: document.querySelector('meta[name="csrf-token"]').content
            };

            fetch('/penjualan', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': formData._token
                    },
                    body: JSON.stringify(formData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Transaksi berhasil disimpan!');
                        resetForm();
                    } else {
                        throw new Error(data.message || 'Terjadi kesalahan');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal menyimpan transaksi: ' + error.message);
                });
        }

        function resetForm() {
            cart = [];
            document.getElementById('uangBayar').value = '';
            document.getElementById('kembalian').value = 'Rp 0';
            updateCart();
            loadProducts();
        }

        // Initialize the page
        document.addEventListener('DOMContentLoaded', () => {
            loadProducts();
        });
    </script>
</x-layout>
