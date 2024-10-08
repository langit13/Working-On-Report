<x-app-layout>
<div class="container">
    <div class="row">
        @foreach ($produk as $product)
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset('images/' . $product->foto) }}" class="card-img-top" alt="{{ $product->nama }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->nama }}</h5>
                    <p class="card-text">{{ $product->deskripsi }}</p>
                    <p class="card-text">Harga: Rp. {{ number_format($product->harga_jual, 0, ',', '.') }}</p>
                    <form action="{{ route('transactions.add', $produk->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Buy Now</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
</x-app-layout>
