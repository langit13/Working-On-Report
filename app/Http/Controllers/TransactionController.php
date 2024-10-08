<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{

    public function checkout(Request $request)
    {
    $produk = Produk::find($request->id);

    if (!$produk) {
        return redirect()->back()->with('error', 'Produk tidak ditemukan');
    }

    return view('transactions.checkout', compact('produk'));
    }
    public function processTransaction(Request $request)
    {   
        // Validasi input
        $request->validate([
            'product_id' => 'required|exists:produks,id',
            'qty' => 'required|integer|min:1',
        ]);

        // Temukan produk berdasarkan ID
        $produk = Produk::find($request->product_id);
        $quantity = $request->qty;

        // Cek apakah quantity yang diminta lebih besar dari yang tersedia
        if ($quantity > $produk->qty) {
            return redirect()->back()->with('error', 'Jumlah yang diminta melebihi stok yang tersedia.');
        }

        $totalPrice = $produk->harga_jual * $quantity;

        // Menyimpan transaksi ke database
        Transaction::create([
            'product_id' => $produk->id,
            'user_id' => auth()->id(), // Mendapatkan ID user yang sedang login
            'qty' => $quantity,
            'total_price' => $totalPrice,
            'status' => 'sukses', // Status transaksi
        ]);

        // Kurangi quantity produk
        $produk->qty -= $quantity;
        $produk->save();

        return redirect()->route('transactions.success')->with('success', 'Transaksi berhasil diproses');
    }


    public function orders()
    {
        // Mengambil semua transaksi untuk user yang sedang login
        $orders = Transaction::where('user_id', auth()->id())->get();
    
        return view('transactions.orders', compact('orders')); // Pastikan ini menggunakan 'orders', bukan 'transactions'
    }
    


}
