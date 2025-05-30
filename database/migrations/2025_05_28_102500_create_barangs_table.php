<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('barang', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
    $table->string('kode_barang')->unique();
    $table->string('kategori_barang');
    $table->string('nama_barang');
    $table->integer('stok')->default(0);
    $table->string('foto')->nullable();
    $table->decimal('harga_modal', 15, 2);
    $table->decimal('harga_jual', 15, 2);
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
