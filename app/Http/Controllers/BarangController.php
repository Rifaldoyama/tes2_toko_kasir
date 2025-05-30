<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Barang::class);
        
        $title = 'Barang';
        $active = 'barang';
        $barang = Barang::where('user_id', Auth::id())
                        ->latest()
                        ->paginate(10);

        return view('barang', compact('title', 'active', 'barang'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Barang::class);

        $validator = Validator::make($request->all(), [
            'kategori_barang' => 'required|string|max:50',
            'nama_barang' => 'required|string|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'harga_modal' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0|gte:harga_modal',
            'stok' => 'required|integer|min:0',
        ], [
            'harga_jual.gte' => 'Harga jual harus lebih besar atau sama dengan harga modal',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Generate kode barang
            $lastId = Barang::max('id') + 1;
            $kodeBarang = 'BRG' . date('Ymd') . str_pad($lastId, 4, '0', STR_PAD_LEFT);

            $data = $validator->validated();
            $data['kode_barang'] = $kodeBarang;
            $data['user_id'] = Auth::id();

            // Handle file upload
            if ($request->hasFile('foto')) {
                $data['foto'] = $request->file('foto')->store('barang-images', 'public');
            }

            Barang::create($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Barang berhasil ditambahkan!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $barang = Barang::findOrFail($id);
        $this->authorize('view', $barang);
        
        return view('barang.show-modal', compact('barang'));
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $this->authorize('update', $barang);
        
        return view('barang.edit-modal', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
        $this->authorize('update', $barang);

        $validator = Validator::make($request->all(), [
            'kategori_barang' => 'required|string|max:50',
            'nama_barang' => 'required|string|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'harga_modal' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0|gte:harga_modal',
            'stok' => 'required|integer|min:0',
        ], [
            'harga_jual.gte' => 'Harga jual harus lebih besar atau sama dengan harga modal',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $data = $validator->validated();

            // Handle file upload
            if ($request->hasFile('foto')) {
                // Delete old image if exists
                if ($barang->foto) {
                    Storage::disk('public')->delete($barang->foto);
                }
                $data['foto'] = $request->file('foto')->store('barang-images', 'public');
            }

            $barang->update($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Barang berhasil diperbarui!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $this->authorize('delete', $barang);

        try {
            // Delete image if exists
            if ($barang->foto) {
                Storage::disk('public')->delete($barang->foto);
            }

            $barang->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Barang berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}