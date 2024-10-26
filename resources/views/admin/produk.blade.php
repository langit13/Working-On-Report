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
        <a href="{{ route('admin') }}" ><i class="fas fa-users"></i> Users</a>
        
        <!-- Bagian REPORTING -->
        <div class="nav-section">REPORTING</div>
        <a href="{{ route('reporting-page') }}"><i class="fas fa-chart-line"></i> Reporting</a>
        
        <!-- Bagian FEATURES -->
        <div class="nav-section">FEATURES</div>
        <a href="#" class="active"><i class="fas fa-shopping-cart"></i> Product</a>


    </div>
    <div class="container py-5" style="width: 70%; margin-left:23%;">
    <div class="card shadow-lg p-4 rounded-4">
        <div class="card-body">
            <h1 class="text-center text-dark fw-bold mb-4">Daftar Produk</h1>

            <!-- Tabel produk -->
            <div class="table-responsive">
                <table class="table table-hover table-borderless align-middle">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">jenis</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Harga Jual</th>
                            <th scope="col">Harga Beli</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Gambar</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (DB::table('produks')->get() as $k)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $k->nama }}</td>
                            <td>{{ $k->jenis }}</td>
                            <td>{{ $k->deskripsi }}</td>
                            <td>{{ $k->harga_jual }}</td>
                            <td>{{ $k->harga_beli }}</td>
                            <td>{{ $k->qty }}</td>
                            <td>
                            <td>
                                @empty($k->foto)
                                <img src="{{url('image/nophoto.jpg')}}"
                                    alt="project-image" class="rounded" style="width: 100%; max-width: 100px; height: auto;">
                                @else
                                <img src="{{url('image')}}/{{$k->foto}}"
                                    alt="project-image" class="rounded" style="width: 100%; max-width: 100px; height: auto;">
                                @endempty

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
