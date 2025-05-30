<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Penjualan;
use App\Models\ItemPenjualan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Pembelian;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $startOfMonth = $now->copy()->startOfMonth()->format('Y-m-d');
        $endOfMonth = $now->copy()->endOfMonth()->format('Y-m-d');
        $userId = Auth::id();

        // Hitung total pemasukan bulan ini (hanya user yang login)
        $pemasukanBulanIni = Penjualan::where('user_id', $userId)
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('total_harga');

        // Hitung total pengeluaran bulan ini (dari pembelian barang oleh user ini)
        $pengeluaranBulanIni = Pembelian::where('user_id', $userId)
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('total_harga');

        // Hitung profit (pemasukan - pengeluaran)
        $profitBulanIni = $pemasukanBulanIni - $pengeluaranBulanIni;

        // Ambil 5 barang terlaris bulan ini (hanya dari transaksi user ini)
        $barangTerlaris = ItemPenjualan::select(
            'barang_id',
            'barang.nama_barang',
            DB::raw('SUM(jumlah) as total_terjual'),
            DB::raw('SUM(subtotal) as total_pendapatan')
        )
            ->join('barang', 'item_penjualan.barang_id', '=', 'barang.id')
            ->join('penjualan', 'item_penjualan.penjualan_id', '=', 'penjualan.id')
            ->where('penjualan.user_id', $userId)
            ->whereBetween('penjualan.created_at', [$startOfMonth, $endOfMonth])
            ->groupBy('barang_id', 'barang.nama_barang')
            ->orderByDesc('total_terjual')
            ->limit(5)
            ->get();

        // Data untuk chart barang terlaris (hanya user ini)
        $chartBarangTerlaris = ItemPenjualan::select(
            'barang.nama_barang',
            DB::raw('SUM(jumlah) as total_terjual')
        )
            ->join('barang', 'item_penjualan.barang_id', '=', 'barang.id')
            ->join('penjualan', 'item_penjualan.penjualan_id', '=', 'penjualan.id')
            ->where('penjualan.user_id', $userId)
            ->whereBetween('penjualan.created_at', [$startOfMonth, $endOfMonth])
            ->groupBy('barang_id', 'barang.nama_barang')
            ->orderByDesc('total_terjual')
            ->limit(10)
            ->get();

        // Data penjualan 7 hari terakhir untuk chart (hanya user ini)
        $chartPenjualanHarian = Penjualan::select(
            DB::raw('DATE(created_at) as tanggal'),
            DB::raw('SUM(total_harga) as total')
        )
            ->where('user_id', $userId)
            ->whereBetween('created_at', [Carbon::now()->subDays(7), Carbon::now()])
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        // Transaksi terakhir 5 (hanya user ini)
        $transaksiTerakhir = Penjualan::with('user')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', [
            'pemasukanBulanIni' => $pemasukanBulanIni,
            'pengeluaranBulanIni' => $pengeluaranBulanIni,
            'profitBulanIni' => $profitBulanIni,
            'barangTerlaris' => $barangTerlaris,
            'chartBarangTerlaris' => $chartBarangTerlaris,
            'chartPenjualanHarian' => $chartPenjualanHarian,
            'transaksiTerakhir' => $transaksiTerakhir
        ]);
    }
    public function update(Request $request)
    {
        $user = User::find(Auth::id());

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nama_toko' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->nama = $validated['nama'];
        $user->nama_toko = $validated['nama_toko'];
        $user->email = $validated['email'];
        $user->no_hp = $validated['no_hp'];
        $user->alamat = $validated['alamat'];

        if ($validated['password']) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
}
