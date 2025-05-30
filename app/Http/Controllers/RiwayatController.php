<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\ItemPenjualan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        // Hanya ambil data penjualan dari user yang login
        $query = Penjualan::with(['items', 'user'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc');

        // Filter berdasarkan tanggal
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
        }

        $penjualans = $query->paginate(10);

        return view('riwayat', [
            'title' => 'Riwayat Penjualan',
            'active' => 'riwayat',
            'penjualans' => $penjualans,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ]);
    }

    public function print($id)
    {
        // Pastikan hanya pemilik transaksi yang bisa cetak
        $penjualan = Penjualan::with(['items.barang', 'user'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);
        
        $pdf = Pdf::loadView('print.struk', [
            'penjualan' => $penjualan
        ]);
        
        return $pdf->stream('struk-penjualan-'.$penjualan->id.'.pdf');
    }

    public function printLaporan(Request $request)
    {
        // Hanya data user yang login
        $query = Penjualan::with(['items', 'user'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc');

        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
        }

        $penjualans = $query->get();
        $total = $penjualans->sum('total_harga');

        $pdf = Pdf::loadView('print.laporan', [
            'penjualans' => $penjualans,
            'total' => $total,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ]);
        
        return $pdf->stream('laporan-penjualan-'.Auth::id().'.pdf');
    }
}