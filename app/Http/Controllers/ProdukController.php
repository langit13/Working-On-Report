<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
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
    DB::table('produks')->insert([
        'nama'=>$request->nama,
        'jenis'=>$request->jenis,
        'harga_jual'=>$request->harga_jual,
        'harga_beli'=>$request->harga_beli,
        'qty'=>$request->qty,
        'deskripsi' => $request->deskripsi,
        'foto'=>$fileName,
    ]);
    
    return redirect()->route('supplier');
    }

    //update
    public function edit(Produk $id)
    {
        return view('supplier.edit', compact('id'));
    }
    

    public function update(Request $request, string $id)
    {
    // validasi data
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
        'jenis.required' => 'jenis wajib diisi',
        'jenis.max' => 'jenis maksimal 45 karakter',
        'foto.max' => 'Foto maksimal 2 MB',
        'foto.mimes' => 'File ekstensi hanya bisa jpg,png,jpeg,gif, svg',
        'foto.image' => 'File harus berbentuk image'
    ]);
 
 
    //foto lama
    $fotoLama = DB::table('produks')->select('foto')->where('id',$id)->get();
    foreach($fotoLama as $f1){
        $fotoLama = $f1->foto;
    }
 
    //jika foto sudah ada yang terupload
    if(!empty($request->foto)){
        //maka proses selanjutnya
        if(!empty($fotoLama->foto)) unlink(public_path('image'.$fotoLama->foto));
        //proses ganti foto
        $fileName = 'foto-'.$request->id.'.'.$request->foto->extension();
        //setelah tau fotonya sudah masuk maka tempatkan ke public
        $request->foto->move(public_path('image'), $fileName);
    } else{
        $fileName = $fotoLama;
    }
 
    //update data produk
    DB::table('produks')->where('id',$id)->update([
        'nama'=>$request->nama,
        'jenis'=>$request->jenis,
        'harga_jual'=>$request->harga_jual,
        'harga_beli'=>$request->harga_beli,
        'qty'=>$request->qty,
        'deskripsi' => $request->deskripsi,
        'foto'=>$fileName,
    ]);
            
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

