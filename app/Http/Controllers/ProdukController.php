<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    public function reportingSupplier() {
        $produk = Produk::all();
        return view('supplier.reporting', ["produk" => $produk]);
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

    public function supplier()
    {
        $produk = Produk::all();
        return view('supplier.supplier', compact('produk'));
    }

    public function create()
    {
    //
    return view('supplier.create');
    }


    //create
    public function store(Request $request)
    {
    // melakukan validasi data
    $request->validate([
        'nama' => 'required|max:45',
        'jenis' => 'required|max:45',
        'harga_jual' => 'required|numeric',
        'harga_beli' => 'required|numeric',
        'qty' => 'required|',
        'foto' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
    ],
    [
        'nama.required' => 'Nama wajib diisi',
        'nama.max' => 'Nama maksimal 45 karakter',
        'jenis.required' => 'jenis wajib diisi',
        'jenis.max' => 'jenis maksimal 45 karakter',
        'foto.max' => 'Foto maksimal 2 MB',
        'foto.mimes' => 'File ekstensi hanya bisa jpg,png,jpeg,gif, svg',
        'foto.image' => 'File harus berbentuk image'
    ]);
    
    //jika file foto ada yang terupload
    if(!empty($request->foto)){
        //maka proses berikut yang dijalankan
        $fileName = 'foto-'.uniqid().'.'.$request->foto->extension();
        //setelah tau fotonya sudah masuk maka tempatkan ke public
        $request->foto->move(public_path('image'), $fileName);
    }
    
    //tambah data produk
    $produk = new Produk();
    $produk->nama = $request->nama;
    $produk->jenis = $request->jenis;
    $produk->harga_jual = $request->harga_jual;
    $produk->harga_beli = $request->harga_beli;
    $produk->qty = $request->qty;
    $produk->deskripsi = $request->deskripsi;
    $produk->foto = $fileName;

    $produk->save(); // Simpan ke database
  
    
    return redirect()->route('supplier');
    }

    //update
    public function edit(Produk $id)
    {
        return view('supplier.edit', compact('id'));
    }
    

    public function update(Request $request, string $id){
        // Validasi data
        $request->validate([
            'nama' => 'required|max:45',
            'jenis' => 'required|max:45',
            'harga_jual' => 'required|numeric',
            'harga_beli' => 'required|numeric',
            'qty' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ],
        [
            'nama.required' => 'Nama wajib diisi',
            'nama.max' => 'Nama maksimal 45 karakter',
            'jenis.required' => 'Jenis wajib diisi',
            'jenis.max' => 'Jenis maksimal 45 karakter',
            'foto.max' => 'Foto maksimal 2 MB',
            'foto.mimes' => 'File ekstensi hanya bisa jpg,png,jpeg,gif, svg',
            'foto.image' => 'File harus berbentuk image'
        ]);
    
        // Ambil produk berdasarkan ID
        $produk = Produk::findOrFail($id); // Mengambil produk dengan ID
    
        // Foto lama
        $fotoLama = $produk->foto;
    
        // Jika foto sudah ada yang terupload
        if (!empty($request->foto)) {
            // Hapus foto lama jika ada
            if ($fotoLama) unlink(public_path('image/' . $fotoLama));
            
            // Proses ganti foto
            $fileName = 'foto-' . $produk->id . '.' . $request->foto->extension();
            // Simpan foto baru ke public
            $request->foto->move(public_path('image'), $fileName);
        } else {
            $fileName = $fotoLama; // Tetap gunakan foto lama
        }
    
        // Update data produk dengan Eloquent
        $produk->nama = $request->nama;
        $produk->jenis = $request->jenis;
        $produk->harga_jual = $request->harga_jual;
        $produk->harga_beli = $request->harga_beli;
        $produk->qty = $request->qty;
        $produk->deskripsi = $request->deskripsi;
        $produk->foto = $fileName;
    
        $produk->save(); // Simpan perubahan ke database
        
        return redirect()->route('supplier');
    }


    
    //delete
    public function destroy(Produk $id)
    {
        $id->delete();
        
        return redirect()->route('supplier') // Pastikan ini merujuk ke rute yang benar
            ->with('success', 'Data berhasil dihapus');
    }
}

