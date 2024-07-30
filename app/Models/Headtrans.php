<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class Headtrans extends Model
{
    use HasFactory;
    protected $table = 'headtrans';
    protected $fillable = [
        'kode',
        'tanggal',
        'id_user',
        'jumlah',
        'total_bayar',
        'bayar',
        'kembali',
    ];

    public function join_user()
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }
}
