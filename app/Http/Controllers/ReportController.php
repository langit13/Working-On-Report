<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function reporting() {
        $produk = Produk::all();
        return view('admin.reporting', ["produk" => $produk]);
    }

    public function alldataproduk() {
    $produk = Produk::all();
    for ($i = 0; $i < count($produk); $i++) { // Perbaiki di sini
        if ($produk[$i]['harga_jual'] < 50000) {
            $produk[$i]['price_range'] = 'less_50000';
        } else if ($produk[$i]['harga_jual'] >= 50000 && $produk[$i]['harga_jual'] < 99999) {
            $produk[$i]['price_range'] = '_50000_99999';
        } else if ($produk[$i]['harga_jual'] >= 100000 && $produk[$i]['harga_jual'] < 999999) {
            $produk[$i]['price_range'] = '_100000_999999';
        } else {
            $produk[$i]['price_range'] = 'more_1000000';
        }
        $produk[$i]['created_range'] = substr($produk[$i]['created_at'], 0, 7);
    }
    return response($produk);
}


    public function chartproduk() {
        $data = [
            "less_50000"=> 50,
            "_50000_99999"=> 43,
            "_100000_999999"=> 343,
            "more_1000000"=> 21
        ];
        return response($data);
    }
}
