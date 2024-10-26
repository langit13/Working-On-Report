<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Supplier Dashboard') }}
            </h2>
        </div>
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
                                @empty($k->foto)
                                <img src="{{url('image/nophoto.jpg')}}"
                                    alt="project-image" class="rounded" style="width: 100%; max-width: 100px; height: auto;">
                                @else
                                <img src="{{url('image')}}/{{$k->foto}}"
                                    alt="project-image" class="rounded" style="width: 100%; max-width: 100px; height: auto;">
                                @endempty

                            </td>

                            </td>
                            <td class="text-center">
                                <a href="{{route('supplier.edit', $k->id)}}" class="btn btn-sm btn-warning">Edit</a>
                                <a href="{{ route('reporting-supplier') }}" class="btn btn-sm btn-secondary">Reporting</a>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{$k->id}}">Hapus</button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{$k->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Produk</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah anda yakin akan menghapus data {{$k->nama}}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                                <form action="{{ route('supplier.destroy', $k->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('supplier.create') }}" class=" btn btn-primary btn-lg shadow-sm">
                    <i class="bi bi-plus-circle"></i> Tambah Produk
                </a>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
