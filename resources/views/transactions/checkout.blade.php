<x-app-layout>
    <div class="container mt-5">
        <h1>Checkout</h1>
        <div class="card mb-4">
            <div class="card-body">
                <!-- Menampilkan informasi produk yang dipilih -->
                <h5 class="card-title">{{ $produk->nama }}</h5>
                <p class="card-text">{{ $produk->deskripsi }}</p>
                <img src="{{ $produk->foto ? url('image/' . $produk->foto) : url('image/nophoto.jpg') }}" 
                    class="card-img-top" 
                    alt="{{ $produk->nama }}" 
                    style="object-fit: cover; height: 200px;">
                <p><strong>Harga Jual:</strong> Rp. {{ number_format($produk->harga_jual, 0, ',', '.') }}</p>

                <!-- Form untuk mengatur quantity -->
                <form action="{{ route('transactions.process') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $produk->id }}">

                    <div class="form-group">
                        <label for="qty">Quantity</label>
                        <input type="number" id="qty" name="qty" class="form-control" value="1" min="1" max="{{ $produk->qty }}">
                    </div>

                    <p><strong>Total Harga:</strong> Rp. <span id="total-price">{{ number_format($produk->harga_jual, 0, ',', '.') }}</span></p>

                    <button type="submit" class="btn btn-success">Process Checkout</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const qtyInput = document.getElementById('qty');
        const totalPriceElem = document.getElementById('total-price');
        const pricePerItem = {{ $produk->harga_jual }};

        qtyInput.addEventListener('input', function() {
            const total = pricePerItem * parseInt(qtyInput.value);
            totalPriceElem.textContent = total.toLocaleString('id-ID');
        });
    </script>
</x-app-layout>
