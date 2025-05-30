<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Penjualan;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index()
    {
        // Get summary data for the logged-in user
        $user = Auth::user();

        // Daily summary
        $dailyData = Penjualan::where('user_id', $user->id)
            ->whereDate('created_at', Carbon::today())
            ->selectRaw('count(*) as total_transactions, sum(total_harga) as total_income')
            ->first();

        // Monthly summary
        $monthlyData = Penjualan::where('user_id', $user->id)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->selectRaw('count(*) as total_transactions, sum(total_harga) as total_income')
            ->first();

        return view('laporan', [
            'title' => 'Laporan Penjualan',
            'active' => 'laporan',
            'dailyData' => $dailyData,
            'monthlyData' => $monthlyData,
            'user' => $user
        ]);
    }

    public function printLaporanHarian()
    {
        return $this->generateLaporan(
            Carbon::today()->startOfDay(),
            Carbon::today()->endOfDay(),
            'laporan-harian'
        );
    }

    public function printLaporanBulanan()
    {
        return $this->generateLaporan(
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth(),
            'laporan-bulanan'
        );
    }

    public function printLaporanCustom(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date'
        ]);

        return $this->generateLaporan(
            $request->start_date . ' 00:00:00',
            $request->end_date . ' 23:59:59',
            'laporan-custom'
        );
    }

    private function generateLaporan($startDate, $endDate, $type)
    {
        $user = Auth::user();

        $penjualans = Penjualan::with(['items.barang', 'user'])
            ->where('user_id', $user->id)
            ->whereBetween('created_at', [$startDate, $endDate . ' 23:59:59']) // Include full end date
            ->orderBy('created_at', 'desc')
            ->get();

        // Calculate summary data
        $totalTransactions = $penjualans->count();
        $totalItemsSold = $penjualans->sum(function ($penjualan) {
            return $penjualan->items->sum('jumlah');
        });
        $grandTotal = $penjualans->sum('total_harga');

        return Pdf::loadView('print.laporan', [
            'penjualans' => $penjualans,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'type' => $type,
            'user' => $user,
            'totalTransactions' => $totalTransactions,
            'totalItemsSold' => $totalItemsSold,
            'grandTotal' => $grandTotal
        ])->setPaper('a4', 'landscape')
            ->stream('laporan-penjualan-' . $startDate . '-sd-' . $endDate . '.pdf');
    }
}
