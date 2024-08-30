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
                    <span>Harga : Rp. {{number_format($product->harga, 0, '.', ',')}}/Hari</span> <br>
                    <span>Jumlah : {{$product->jumlah}}</span> <br>
                    <span>{{$product->deskripsi}}</span>
                    <hr>
                    @if($product->jumlah > 0)
                        @if(Auth::check() && Auth::user()->hasRole('user'))
                        <form id="orderForm" action="{{route('order.store')}}" method="POST">
                            @csrf
                            <input name="product_id" class="form-control text-center" value="{{$product->id}}" hidden />
                            <input name="harga" class="form-control text-center" value="{{$product->harga}}" hidden />
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="mulai" class="form-label">Tanggal Mulai</label>
                                    <input id="tanggalMulai" name="mulai" class="form-control text-center" type="date" required />
                                </div>
                                <div class="col-md-6">
                                    <label for="selesai" class="form-label">Tanggal Selesai</label>
                                    <input id="tanggalSelesai" name="selesai" class="form-control text-center" type="date" required />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="jumlah" class="form-label">Jumlah Pesan</label>
                                    <input id="jumlahPesan" name="jumlah" class="form-control" type="number" placeholder="Masukkan Jumlah Pesan" required />
                                </div>
                                <div class="col-md-6">
                                    <label for="telepon" class="form-label">Nomor Telepon</label>
                                    <input name="telepon" class="form-control" type="text" placeholder="Masukkan nomor telepon" required />
                                </div>
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
                    @else
                        <div class="alert alert-danger" role="alert">
                            Maaf, produk ini sedang tidak tersedia.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <x-footer/>

    <!-- JavaScript to validate order quantity and date -->
    <script>
        document.getElementById('orderForm').addEventListener('submit', function(event) {
            var stok = {{ $product->jumlah }};
            var jumlahPesan = document.getElementById('jumlahPesan').value;
            var tanggalMulai = new Date(document.getElementById('tanggalMulai').value);
            var tanggalSelesai = new Date(document.getElementById('tanggalSelesai').value);
            var today = new Date();

            // Check if order quantity exceeds stock
            if (jumlahPesan > stok) {
                event.preventDefault();
                alert('Jumlah pesanan tidak bisa melebihi stok yang tersedia.');
                return;
            }

            // Check if start date is in the past
            if (tanggalMulai < today.setHours(0,0,0,0)) {
                event.preventDefault();
                alert('Tanggal mulai tidak bisa kurang dari hari ini.');
                return;
            }

            // Check if end date is before start date
            if (tanggalSelesai < tanggalMulai) {
                event.preventDefault();
                alert('Tanggal selesai tidak bisa kurang dari tanggal mulai.');
                return;
            }
        });
    </script>
</x-app-layout>
