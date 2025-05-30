<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $table = 'penjualan';
   protected $fillable = [
        'total_harga',
        'uang_diterima',
        'kembalian',
        'user_id',
        'jenis_pembayaran',
        
    ];

    public function items()
    {
        return $this->hasMany(ItemPenjualan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

     public function penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

}
 
  