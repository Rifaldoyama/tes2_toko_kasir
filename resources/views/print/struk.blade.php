<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Struk Penjualan #{{ $penjualan->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
        }

        .info {
            margin-bottom: 15px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 5px;
            border-bottom: 1px solid #ddd;
        }

        .table th {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
        }

        .divider {
            border-top: 1px dashed #000;
            margin: 10px 0;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="title">{{ $user->nama_toko }}</div>
        @if ($user->alamat)
            <div>{{ $user->alamat }}</div>
        @endif
        @if ($user->no_hp)
            <div>Telp: {{ $user->no_hp }}</div>
        @endif
        <div class="divider"></div>
    </div>

    <div class="info">
        <div>No. Transaksi: #{{ str_pad($penjualan->id, 6, '0', STR_PAD_LEFT) }}</div>
        <div>Tanggal: {{ $penjualan->created_at->translatedFormat('d F Y H:i') }}</div>
        <div>Kasir: {{ $penjualan->user->name }}</div>
        <div>Metode Bayar: {{ ucfirst($penjualan->jenis_pembayaran) }}</div>
        <div class="divider"></div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Qty</th>
                <th class="text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penjualan->items as $item)
                <tr>
                    <td>{{ $item->barang->nama_barang }}</td>
                    <td>Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td class="text-right">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total</th>
                <th class="text-right">Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</th>
            </tr>
            <tr>
                <th colspan="3">Bayar</th>
                <th class="text-right">Rp {{ number_format($penjualan->uang_diterima, 0, ',', '.') }}</th>
            </tr>
            <tr>
                <th colspan="3">Kembali</th>
                <th class="text-right">Rp {{ number_format($penjualan->kembalian, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <div class="divider"></div>
        <div>Terima kasih telah berbelanja</div>
        <div>Barang yang sudah dibeli tidak dapat ditukar/dikembalikan</div>
        <div class="divider"></div>
        <div>*Struk ini sebagai bukti pembayaran*</div>
    </div>
</body>

</html>
