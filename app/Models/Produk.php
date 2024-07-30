<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produk';
    protected $fillable = [
        'kode',
        'produk',
        'satuan',
        'kategori',
        'stok',
        'hargabeli',
        'hargajual',
        'keterangan',
        'supplier',
    ];

    public function join_kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori', 'id');
    }

    public function join_supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier', 'id');
    }

    //////belongsto yang satu data
    //////hasmany banyak data
}
