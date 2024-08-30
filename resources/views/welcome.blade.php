<x-guest-layout>
    <x-nav/>
    <!-- Header-->
    <header class="bg-dark py-5" style="height: 100vh; position: relative; overflow: hidden;">
        <div class="container-fluid h-100 px-0">
            <!-- Dark Overlay -->
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 1;"></div>
            <!-- Image -->
            <img src="{{asset('images/banner.jpg')}}" alt="" style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0;">
            <!-- Text Center -->
            <div class="text-center text-white h-100 d-flex flex-column justify-content-center align-items-center" style="position: relative; z-index: 2;">
                <!-- <h1 class="display-4 fw-bolder">Shop in style</h1> -->
                <p class="lead fw-normal text-white mb-0" style="font-size: 30px;">"Bertani & Berniaga Dengan Mudah"</p>
            </div>
        </div>
    </header>
    <!-- Section-->
    <section id="product" class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
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
                                    <p class="mb-1">Rp. {{number_format($product->harga, 0, '.', ',')}}</p>
                                    <!-- Product stock-->
                                    <p class="text-muted" style="font-size: 14px;">
                                        @if($product->jumlah > 0)
                                            <span class="badge bg-success">Tersedia: {{$product->jumlah}} {{$product->kategori == 'sewa' ? 'Barang' : 'Orang'}}</span>
                                        @else
                                            <span class="badge bg-danger">Tidak Tersedia</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                @if($product->kategori == 'sewa')
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{route('product.show', $product->id)}}">Sewa</a></div>
                                @elseif($product->kategori == 'jasa')
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{route('product.show', $product->id)}}">Pesan</a></div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <x-footer/>
</x-guest-layout>
