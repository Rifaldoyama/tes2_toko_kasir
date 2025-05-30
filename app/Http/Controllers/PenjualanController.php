<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penjualan;
use App\Models\ItemPenjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenjualanController extends Controller
{
    public function index()
    {
        return view('penjualan', [
            'title' => 'penjualan',
            'active' => 'penjualan'
        ]);
    }

    public function getBarang()
    {
        $barang = Barang::userBarang(Auth::id())->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'kode_barang' => $item->kode_barang,
                'nama_barang' => $item->nama_barang,
                'foto' => $item->foto, // The actual filename
                'foto_url' => $item->foto_url, // This uses the accessor
                'harga_jual' => $item->harga_jual,
                'stok' => $item->stok,
                // Add other fields as needed
            ];
        });

        return response()->json($barang);
    }

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.barang_id' => 'required|exists:barang,id',
            'items.*.jumlah' => 'required|integer|min:1',
            'total_harga' => 'required|numeric|min:0',
            'uang_diterima' => 'required|numeric|min:' . $request->total_harga
        ]);

        // Create the sale
        $penjualan = Penjualan::create([
            'total_harga' => $request->total_harga,
            'uang_diterima' => $request->uang_diterima,
            'kembalian' => $request->uang_diterima - $request->total_harga,
            'user_id' => Auth::id(),
            'jenis_pembayaran' => $request->jenis_pembayaran
        ]);

        // Create sale items and update stock
        foreach ($request->items as $item) {
            $barang = Barang::find($item['barang_id']);

            ItemPenjualan::create([
                'penjualan_id' => $penjualan->id,
                'barang_id' => $item['barang_id'],
                'jumlah' => $item['jumlah'],
                'harga_satuan' => $barang->harga_jual,
                'subtotal' => $item['jumlah'] * $barang->harga_jual
            ]);

            // Update stock
            $barang->decrement('stok', $item['jumlah']);
        }

        return response()->json([
            'success' => true,
            'message' => 'Transaksi berhasil disimpan',
            'data' => $penjualan
        ]);
    }
}
