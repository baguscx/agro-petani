<x-app-layout>
    <x-nav/>
    <!-- Product section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6">
                    <img class="card-img-top mb-5 mb-md-0" src="{{ asset($product->gambar) }}" alt="{{ $product->nama }}"/>
                </div>
                <div class="col-md-6">
                    <h1 class="display-5 fw-bolder">{{$product->nama}}</h1>
                    <span>Rp. {{number_format($product->harga, 0, '.', ',');}}/Hari</span>
                    <p class="lead">{{$product->deskripsi}}</p>
                    @if(Auth::check() && Auth::user()->hasRole('user'))
                    <form action="{{route('order.store')}}" method="POST">
                        @csrf
                        <input name="product_id" class="form-control text-center" value="{{$product->id}}" hidden />
                        <input name="harga" class="form-control text-center" value="{{$product->harga}}" hidden />
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="mulai" class="form-label">Tanggal Mulai</label>
                                <input name="mulai" class="form-control text-center" type="date" required />
                            </div>
                            <div class="col-md-6">
                                <label for="selesai" class="form-label">Tanggal Selesai</label>
                                <input name="selesai" class="form-control text-center" type="date" required />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="telepon" class="form-label">Nomor Telepon</label>
                            <input name="telepon" class="form-control" type="text" placeholder="Masukkan nomor telepon" required />
                        </div>
                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <input name="lokasi" class="form-control" type="text" placeholder="Masukkan lokasi penanaman" required />
                        </div>
                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan</label>
                            <textarea name="catatan" class="form-control" placeholder="Masukkan catatan (Opsional)"></textarea>
                        </div>
                        <button class="btn btn-outline-dark flex-shrink-0" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            @if($product->kategori == 'sewa')
                                Sewa
                            @elseif($product->kategori == 'jasa')
                                Pesan
                            @endif
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <x-footer/>
</x-app-layout>
