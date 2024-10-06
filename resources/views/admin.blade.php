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

        <!-- Bagian FEATURES -->
        <div class="nav-section">FEATURES</div>
        <a href="#"><i class="fas fa-shopping-cart"></i> Product</a>

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
                            <button class="btn btn-primary btn-add-user"><i class="fas fa-plus"></i> Tambah User</button>

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
                                    <tr>
                                        <td>1</td>
                                        <td>Muhammad Azmi Nur Iman</td>
                                        <td>azmi@example.com</td>
                                        <td>Admin</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary">Edit</button>
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>John Doe</td>
                                        <td>john@example.com</td>
                                        <td>User</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary">Edit</button>
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </td>
                                    </tr>
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
