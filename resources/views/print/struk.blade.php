<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Struk Penjualan #{{ $penjualan->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        .header { text-align: center; margin-bottom: 20px; }
        .title { font-size: 18px; font-weight: bold; }
        .info { margin-bottom: 15px; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { padding: 5px; border-bottom: 1px solid #ddd; }
        .table th { text-align: left; }
        .text-right { text-align: right; }
        .footer { margin-top: 30px; text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">{{ $penjualan->user->nama_toko ?? $nama_toko}}</div>
        <div>Jl. Contoh No. 123, Kota</div>
        <div>Telp: 08123456789</div>
    </div>

    <div class="info">
        <div>No. Transaksi: {{ $penjualan->id }}</div>
        <div>Tanggal: {{ $penjualan->created_at->format('d/m/Y H:i') }}</div>
        <div>Kasir: {{ $penjualan->user->name }}</div>
        <div>Metode Bayar: {{ ucfirst($penjualan->jenis_pembayaran) }}</div>
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
            @foreach($penjualan->items as $item)
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
        <div>Terima kasih telah berbelanja</div>
        <div>Barang yang sudah dibeli tidak dapat ditukar/dikembalikan</div>
    </div>
</body>
</html>