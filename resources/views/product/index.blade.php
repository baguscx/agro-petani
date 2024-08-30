<x-guest-layout>
    <x-nav/>
    <!-- Section-->
    <section id="product" class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <!-- Add Product Button for Sellers and Admins -->
            @if(Auth::check() && (Auth::user()->hasRole('seller') || Auth::user()->hasRole('admin')))
                <div class="mb-4 text-center">
                    <a class="btn btn-success" href="{{ route('product.create') }}">Tambah Product</a>
                </div>
            @endif

            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach($products as $product)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="{{ asset($product->gambar) }}" alt="{{ $product->nama }}">
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{$product->nama}}</h5>
                                    <!-- Product price-->
                                    <p>Rp. {{ number_format($product->harga, 0, '.', ',') }}</p>
                                    <!-- Product stock-->
                                    <p class="text-muted" style="font-size: 14px;">
                                        @if($product->jumlah > 0)
                                            <span class="badge bg-success">Tersedia : {{$product->jumlah}} {{$product->kategori == 'sewa' ? 'Barang' : 'Orang'}}</span>
                                        @else
                                            <span class="badge bg-danger">Tidak Tersedia</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    @if(Auth::check() && Auth::user()->hasRole('user'))
                                        @if($product->jumlah > 0)
                                            @if($product->kategori == 'sewa')
                                                <a class="btn btn-outline-dark mt-auto" href="{{ route('product.show', $product->id) }}">Sewa</a>
                                            @elseif($product->kategori == 'jasa')
                                                <a class="btn btn-outline-dark mt-auto" href="{{ route('product.show', $product->id) }}">Pesan</a>
                                            @endif
                                        @else
                                            <button class="btn btn-outline-dark mt-auto" disabled>Stok Habis</button>
                                        @endif
                                    @elseif(Auth::check() && (Auth::user()->hasRole('seller') || Auth::user()->hasRole('admin')))
                                        <a class="btn btn-outline-dark mt-auto" href="{{ route('product.show', $product->id) }}">Detail</a>
                                        <a class="btn btn-outline-primary mt-auto" href="{{ route('product.edit', $product->id) }}">Edit</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <x-footer/>
</x-guest-layout>
