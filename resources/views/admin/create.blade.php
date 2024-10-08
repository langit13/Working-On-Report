<x-app-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="mb-4" style="font-size: large;">Tambah Pengguna</h2>

                <!-- Menampilkan Pesan Kesalahan -->
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Nama Pelanggan <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="name" value="{{ old('name') }}" required />
                    </div>
                    
                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input class="form-control" type="email" name="email" value="{{ old('email') }}" required />
                    </div>
                    
                    <div class="form-group">
                        <label>Password <span class="text-danger">*</span></label>
                        <input class="form-control" type="password" name="password" required />
                    </div>
                    
                    <div class="form-group">
                        <label for="role">Role:</label>
                        <select name="role" class="form-control" required>
                            <option value="" disabled {{ old('role') ? '' : 'selected' }}>Pilih Role</option>
                            <option value="0" {{ old('role', $user->role ?? '') == 0 ? 'selected' : '' }}>Admin</option>
                            <option value="1" {{ old('role', $user->role ?? '') == 1 ? 'selected' : '' }}>Supplier</option>
                            <option value="2" {{ old('role', $user->role ?? '') == 2 ? 'selected' : '' }}>User</option>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <button class="btn btn-primary">Simpan</button>
                        <a class="btn btn-danger" href="{{ route('admin') }}">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
