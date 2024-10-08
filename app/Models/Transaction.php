<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;


    protected $fillable = ['user_id', 'product_id', 'qty', 'total_price', 'status'];

    public function product()
    {
        return $this->belongsTo(Produk::class, 'product_id');
    }
}
