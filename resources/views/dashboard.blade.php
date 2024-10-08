<link href="{{ asset('css/pelanggan.css') }}" rel="stylesheet" type="text/css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Customer Portal</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Transactions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('transactions.orders') }}">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile.edit') }}">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="event.preventDefault(); this.nextElementSibling.submit();">Logout</a>
                    <form method="POST" action="{{ route('logout') }}" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="container main-content mt-5">
                    <div class="row">
                        <div class="col-12">
                            <h1>Available Products</h1>
                            <p>Here are the available products you can purchase:</p>
                            <hr>
                            <div class="row">
                                @foreach (DB::table('produks')->get() as $product)
                                    <div class="col-md-4">
                                        <div class="card mb-4">
                                            <img src="{{ $product->foto ? url('image/' . $product->foto) : url('image/nophoto.jpg') }}" 
                                                class="card-img-top" 
                                                alt="{{ $product->nama }}" 
                                                style="object-fit: cover; height: 200px;">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $product->nama }}</h5>
                                                <p class="card-text">{{ $product->deskripsi }}</p>
                                                <p class="card-text"><strong>Harga Jual:</strong> Rp. {{ number_format($product->harga_jual, 0, ',', '.') }}</p>
                                                <form action="{{ route('transactions.checkout', $product->id) }}" method="GET">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">Buy Now</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
