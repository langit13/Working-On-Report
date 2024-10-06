<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Supplier Dashboard') }}
        </h2>
    </x-slot>
    <div class="container py-5">
    <div class="card shadow-lg p-4 rounded-4">
        <div class="card-body">
            <h1 class="text-center text-dark fw-bold mb-4">Daftar Produk</h1>

            <!-- Tabel produk -->
            <div class="table-responsive">
                <table class="table table-hover table-borderless align-middle">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Gambar</th>
                            <th scope="col" class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Produk 1</td>
                            <td>Deskripsi produk 1 yang cukup panjang dan detail.</td>
                            <td>Rp 100.000</td>
                            <td>
                                <img src="https://via.placeholder.com/100" alt="Gambar Produk 1" class="product-img">
                            </td>
                            <td class="text-end">
                                <a href="#" class="btn btn-warning btn-sm btn-edit">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <a href="#" class="btn btn-danger btn-sm btn-delete ms-2">
                                    <i class="bi bi-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                        <!-- Tambahkan produk lain di sini -->
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <a href="#" class=" btn btn-primary btn-lg shadow-sm">
                    <i class="bi bi-plus-circle"></i> Tambah Produk
                </a>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
