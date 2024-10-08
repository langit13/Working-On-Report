<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */
    public function admin()
    {
    // Logika untuk menampilkan halaman admin
    $data['title'] = 'Dashboard Admin';
    return view('admin.admin', $data);
    }

     public function user(Request $request)
    {
        $data['title'] = 'Data User';
        $data['q'] = $request->q;
        // Mengambil semua user berdasarkan pencarian
        $data['rows'] = User::where('name', 'like', '%' . $request->q . '%')->get();

            // Menambahkan mapping untuk role
        $data['roles'] = [
            0 => 'admin',
            1 => 'supplier',
            2 => 'user',
        ];

        return view('admin.admin', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data['title'] = 'Tambah User';
        $data['role'] = ['admin' => 'admin', 'supplier' => 'supplier', 'user' => 'user'];
        return view('admin.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'role' => 'required|in:0,1,2', // Validasi role harus salah satu dari 0, 1, atau 2
        ]);
    
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role = $request->role; // Simpan nilai numerik
        $user->save();
    
        return redirect()->route('admin')->with('success', 'Tambah Data Berhasil');

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $data['title'] = 'Ubah User';
        $data['row'] = $user;
        $data['role'] = ['admin' => 'admin', 'supplier' => 'supplier', 'user' => 'user'];
        return view('admin.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required|in:0,1,2', // Validasi role harus salah satu dari 0, 1, atau 2
        ]);
    
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = $request->password; // Update password jika ada
        }
        $user->role = $request->role; // Simpan nilai numerik
        $user->save();
    
        return redirect('admin')->with('success', 'Ubah Data Berhasil');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin')->with('success', 'Hapus Data Berhasil');
    }
}
