<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;

class Produk extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'jenis',
        'deskripsi',
        'harga_jual',
        'harga_beli',
        'qty',
        'foto'
    ];

    // Relasi ke transaksi (satu produk bisa ada di banyak transaksi)
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
