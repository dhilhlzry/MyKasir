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
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->nullable();
            $table->string('produk');
            $table->string('satuan');
            $table->integer('stok');
            $table->integer('hargabeli');
            $table->integer('hargajual');
            $table->string('keterangan')->nullable();
            $table->foreignId('kategori');
            $table->foreignId('supplier');
            // $table->string('id_user');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
