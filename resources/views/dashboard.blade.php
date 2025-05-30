<x-layout title="Dashboard">
    <h1 class="text-2xl md:text-3xl font-bold mb-4 text-gray-800">Selamat Datang {{ Auth::user()->nama }}</h1>

    <!-- Top Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-xl p-4 shadow hover:shadow-md transition summary-card">
            <div class="flex items-center mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500 mr-2" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h2 class="text-base font-semibold text-gray-700">Profit</h2>
            </div>
            <p class="text-2xl font-bold text-green-600">Rp {{ number_format($profitBulanIni, 0, ',', '.') }}</p>
            <p class="text-xs text-gray-500 mt-1">Total profit bulan ini</p>
        </div>

        <div class="bg-white rounded-xl p-4 shadow hover:shadow-md transition summary-card">
            <div class="flex items-center mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500 mr-2" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h2 class="text-base font-semibold text-gray-700">Pengeluaran</h2>
            </div>
            <p class="text-2xl font-bold text-red-600">Rp {{ number_format($pengeluaranBulanIni, 0, ',', '.') }}</p>
            <p class="text-xs text-gray-500 mt-1">Total biaya bulan ini</p>
        </div>

        <div class="bg-white rounded-xl p-4 shadow hover:shadow-md transition summary-card">
            <div class="flex items-center mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500 mr-2" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                </svg>
                <h2 class="text-base font-semibold text-gray-700">Pemasukan</h2>
            </div>
            <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($pemasukanBulanIni, 0, ',', '.') }}</p>
            <p class="text-xs text-gray-500 mt-1">Total penjualan bulan ini</p>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">
        <div class="bg-white rounded-xl p-4 shadow">
            <h2 class="text-base font-semibold text-gray-700 mb-3">📦 Barang Terlaris</h2>
            <div class="chart-container">
                <canvas id="barangLarisChart"></canvas>
            </div>
        </div>
        <div class="bg-white rounded-xl p-4 shadow">
            <h2 class="text-base font-semibold text-gray-700 mb-3">📈 Grafik Penjualan</h2>
            <div class="chart-container">
                <canvas id="penjualanChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Laporan Barang Laris -->
    <div class="bg-white rounded-xl p-4 shadow mb-4">
        <h2 class="text-base font-semibold text-gray-700 mb-3">📃 Laporan Barang Terlaris</h2>
        <div class="table-responsive">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 py-2 text-left font-medium text-gray-500">No</th>
                        <th class="px-3 py-2 text-left font-medium text-gray-500">Nama Barang</th>
                        <th class="px-3 py-2 text-left font-medium text-gray-500">Jumlah Terjual</th>
                        <th class="px-3 py-2 text-left font-medium text-gray-500">Total Pendapatan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($barangTerlaris as $index => $barang)
                        <tr class="hover:bg-gray-50">
                            <td class="px-3 py-2">{{ $index + 1 }}</td>
                            <td class="px-3 py-2">{{ $barang->nama_barang }}</td>
                            <td class="px-3 py-2">{{ $barang->total_terjual }}</td>
                            <td class="px-3 py-2">Rp {{ number_format($barang->total_pendapatan, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-3 py-2 text-center text-gray-500">Tidak ada data penjualan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Transaksi Terakhir -->
    <div class="bg-white rounded-xl p-4 shadow">
        <h2 class="text-base font-semibold text-gray-700 mb-3">🕒 Transaksi Terakhir</h2>
        <div class="table-responsive">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 py-2 text-left font-medium text-gray-500">ID</th>
                        <th class="px-3 py-2 text-left font-medium text-gray-500">Tanggal</th>
                        <th class="px-3 py-2 text-left font-medium text-gray-500">Total</th>
                        <th class="px-3 py-2 text-left font-medium text-gray-500">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($transaksiTerakhir as $transaksi)
                        <tr class="hover:bg-gray-50">
                            <td class="px-3 py-2">{{ $transaksi->id }}</td>
                            <td class="px-3 py-2">{{ $transaksi->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-3 py-2">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                            <td class="px-3 py-2">
                                <a href="{{ route('riwayat.print', $transaksi->id) }}" target="_blank"
                                    class="text-blue-600 hover:text-blue-800">
                                    Cetak
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-3 py-2 text-center text-gray-500">Tidak ada transaksi terakhir
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Chart.js Config -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Barang Terlaris Chart
        const barangLarisCtx = document.getElementById('barangLarisChart').getContext('2d');
        new Chart(barangLarisCtx, {
            type: 'bar',
            data: {
                labels: @json($chartBarangTerlaris->pluck('nama_barang')),
                datasets: [{
                    label: 'Jumlah Terjual',
                    data: @json($chartBarangTerlaris->pluck('total_terjual')),
                    backgroundColor: [
                        '#60a5fa', '#818cf8', '#34d399', '#facc15', '#f87171',
                        '#a78bfa', '#fbbf24', '#38bdf8', '#4ade80', '#fb7185'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `Terjual: ${context.raw}`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value;
                            }
                        }
                    }
                }
            }
        });

        // Penjualan Chart
        const penjualanCtx = document.getElementById('penjualanChart').getContext('2d');
        new Chart(penjualanCtx, {
            type: 'line',
            data: {
                labels: @json($chartPenjualanHarian->pluck('tanggal')),
                datasets: [{
                    label: 'Penjualan Harian',
                    data: @json($chartPenjualanHarian->pluck('total')),
                    borderColor: '#22c55e',
                    backgroundColor: 'rgba(34,197,94,0.2)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `Rp ${context.raw.toLocaleString('id-ID')}`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return `Rp ${value.toLocaleString('id-ID')}`;
                            }
                        }
                    }
                }
            }
        });
    </script>
</x-layout>
