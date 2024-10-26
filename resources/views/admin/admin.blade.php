<x-app-layout>
    <div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar p-3">
        <!-- Profil Pengguna -->
        <div class="profile">
            <img src="https://via.placeholder.com/70" alt="User Profile">
            <h5>Muhammad Azmi Nur Iman</h5>
        </div>

        <!-- Bagian DATA MASTER -->
        <div class="nav-section">DATA MASTER</div>
        <a href="#" class="active"><i class="fas fa-users"></i> Users</a>

         <!-- Bagian REPORTING -->
         <div class="nav-section">REPORTING</div>
         <a href="{{ route('reporting-page') }}"><i class="fas fa-chart-line"></i> Reporting</a>
        
        <!-- Bagian FEATURES -->
        <div class="nav-section">FEATURES</div>
        <a href="{{ route('admin.produk') }}"><i class="fas fa-shopping-cart"></i> Product</a>

    </div>

    <!-- Konten Utama -->
    <div class="main-content">
        <div class="header">
            <h1>Selamat Datang, Admin</h1>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <!-- Tombol Tambah User -->
                        <div class="table-container">
                            <a href="{{ route('admin.create') }}" class="btn btn-primary btn-add-user"><i class="fas fa-fa-plus"></i> Tambah User</a>

                            <!-- Tabel untuk CRUD User -->
                            <table class="table table-striped table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1 ?>
                                    @foreach($rows as $row)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->email}}</td>
                                        <td>{{ $roles[$row->role] ?? 'Unknown' }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-warning" href="{{ route('admin.edit', $row) }}">Ubah</a>
                                            <form method="POST" action="{{ route('admin.destroy', $row) }}" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus Data?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <!-- Tambahkan baris data lainnya di sini -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
