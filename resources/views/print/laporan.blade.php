<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        .header { text-align: center; margin-bottom: 20px; }
        .title { font-size: 18px; font-weight: bold; }
        .period { margin-bottom: 15px; text-align: center; }
        .table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .table th, .table td { padding: 8px; border: 1px solid #ddd; }
        .table th { background-color: #f2f2f2; text-align: left; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .summary { font-weight: bold; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">LAPORAN PENJUALAN</div>
        <div>TOKO ABC</div>
    </div>

    <div class="period">
        Periode: {{ date('d/m/Y', strtotime($start_date)) }} - {{ date('d/m/Y', strtotime($end_date)) }}
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>No. Transaksi</th>
                <th>Tanggal</th>
                <th>Kasir</th>
                <th>Metode Bayar</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penjualans as $penjualan)
            <tr>
                <td>{{ $penjualan->id }}</td>
                <td>{{ $penjualan->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $penjualan->user->name }}</td>
                <td>{{ ucfirst($penjualan->jenis_pembayaran) }}</td>
                <td class="text-right">Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-right">Total Penjualan:</td>
                <td class="text-right">Rp {{ number_format($total, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="summary">
        <div>Total Transaksi: {{ $penjualans->count() }}</div>
        <div>Total Pendapatan: Rp {{ number_format($total, 0, ',', '.') }}</div>
    </div>
</body>
</html>