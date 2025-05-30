<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Barang extends Model
{
    protected $table = 'barang';
    protected $fillable = [
        'kode_barang',
        'kategori_barang',
        'nama_barang',
        'foto',
        'harga_modal',
        'harga_jual',
        'stok',
        'user_id'
    ];
     public function user()
    {
        return $this->belongsTo(User::class);
    }
     public function getFotoUrlAttribute()
    {
        return $this->foto ? Storage::url($this->foto) : asset('images/default-product.png');
    }
     public function scopeUserBarang($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
