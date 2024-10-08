<x-app-layout>
    <div class="container mt-5">
        <h1>Your Orders</h1>
    <br>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Quantity</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Tanggal Transaksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $transaction) <!-- Ubah $transactions menjadi $orders -->
                    <tr>
                        <td>{{ $transaction->product->nama }}</td>
                        <td>{{ $transaction->qty }}</td>
                        <td>Rp. {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                        <td>{{ $transaction->status }}</td>
                        <td>{{ $transaction->created_at->format('d-m-Y H:i:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <form action="{{ route('dashboard') }}" method="GET">
                @csrf
                <button type="submit" class="btn btn-primary">Kembali</button>
            </form>
    </div>
</x-app-layout>
