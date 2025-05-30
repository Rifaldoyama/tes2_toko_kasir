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
    $penjualan = Penjualan::with(['items.barang', 'user'])
        ->where('user_id', Auth::id())
        ->findOrFail($id);

    $pdf = Pdf::loadView('print.struk', [
        'penjualan' => $penjualan,
        'user' => $penjualan->user // Pass the user data
    ]);

    return $pdf->stream('struk-penjualan-' . $penjualan->id . '.pdf');
}

}
