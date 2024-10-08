<x-app-layout>
    <div class="container mt-5">
        <h1>Checkout Successful</h1>

        <!-- Tampilkan pesan sukses jika ada -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <p>Terima kasih, transaksi Anda telah berhasil diproses!</p>
        <a href="{{ route('transactions.index') }}" class="btn btn-primary">Kembali ke Produk</a>
    </div>
</x-app-layout>
