<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan {{ $start_date }} - {{ $end_date }}</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 0.5cm;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 10px;
            line-height: 1.3;
        }

        .receipt {
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .title {
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .store-name {
            font-size: 12px;
            font-weight: 600;
        }

        .divider {
            border-top: 1px dashed #000;
            margin: 5px 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 5px 0;
        }

        .table th,
        .table td {
            padding: 3px;
            border: 1px solid #ddd;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .bg-gray {
            background-color: #f5f5f5;
        }

        .bold {
            font-weight: bold;
        }

        .nowrap {
            white-space: nowrap;
        }

        .grid {
            display: grid;
        }

        .grid-cols-3 {
            grid-template-columns: repeat(3, 1fr);
        }

        .gap-2 {
            gap: 8px;
        }

        .mb-2 {
            margin-bottom: 8px;
        }

        .mt-2 {
            margin-top: 8px;
        }

        .p-1 {
            padding: 4px;
        }

        .footer {
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>

<body class="p-1">
    <div class="receipt">
        <!-- Header Section -->
        <div class="header">
            <div class="title">Laporan Penjualan</div>
            <div class="store-name">{{ $user->nama_toko }}</div>
            <div>{{ $user->alamat }}</div>
            <div>Telp: {{ $user->no_hp }}</div>
        </div>

        <!-- Report Info Section -->
        <div class="grid grid-cols-3 gap-2 mb-2">
            <div>
                <span class="bold">Periode:</span>
                {{ date('d/m/Y', strtotime($start_date)) }} - {{ date('d/m/Y', strtotime($end_date)) }}
            </div>
            <div class="text-center">
                <span class="bold">Total Transaksi:</span> {{ $totalTransactions }}
            </div>
            <div class="text-right">
                <span class="bold">Tanggal Cetak:</span> {{ now()->format('d/m/Y H:i') }}
            </div>
        </div>

        <div class="divider"></div>

        <!-- Sales Data Table -->
        <table class="table">
            <thead>
                <tr class="bg-gray">
                    <th class="text-left">No</th>
                    <th class="text-left nowrap">No. Transaksi</th>
                    <th class="text-left nowrap">Tanggal</th>
                    <th class="text-left">Pelanggan</th>
                    <th class="text-left">Produk</th>
                    <th class="text-right">Harga</th>
                    <th class="text-right">Qty</th>
                    <th class="text-right">Diskon</th>
                    <th class="text-right">Subtotal</th>
                    <th class="text-left">Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                @php $counter = 1; @endphp
                @forelse($penjualans as $penjualan)
                    @foreach ($penjualan->items as $item)
                        <tr>
                            <td>{{ $counter++ }}</td>
                            <td class="nowrap">#{{ str_pad($penjualan->id, 6, '0', STR_PAD_LEFT) }}</td>
                            <td class="nowrap">{{ $penjualan->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $penjualan->customer->nama ?? 'Umum' }}</td>
                            <td>{{ $item->barang->nama_barang }}</td>
                            <td class="text-right">@currency($item->harga_satuan)</td>
                            <td class="text-right">{{ $item->jumlah }}</td>
                            <td class="text-right">@currency($item->diskon ?? 0)</td>
                            <td class="text-right">@currency($item->subtotal)</td>
                            <td>{{ ucfirst($penjualan->jenis_pembayaran) }}</td>
                        </tr>
                    @endforeach
                @empty
                    <tr>
                        <td colspan="11" class="text-center">Tidak ada data penjualan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="divider"></div>

        <!-- Summary Section -->
        <div class="grid grid-cols-3 gap-2 mb-2">
            <div>
                <span class="bold">Total Transaksi:</span> {{ $totalTransactions }}
            </div>
            <div class="text-center">
                <span class="bold">Total Item Terjual:</span> {{ $totalItemsSold }}
            </div>
            <div class="text-right bold">
                TOTAL PENJUALAN: @currency($grandTotal)
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div>Dicetak oleh: {{ $user->name }}</div>
            <div>{{ $user->nama_toko }} - {{ now()->format('d/m/Y H:i') }}</div>
        </div>
    </div>
</body>

</html>
