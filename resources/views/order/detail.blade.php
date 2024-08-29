<x-app-layout>
    <x-nav/>
    <div class="container py-5">
        <h2 class="mb-4">Detail Pesanan</h2>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        @if($order->product->gambar)
                            <img src="{{ asset($order->product->gambar) }}" class="img-fluid mb-3" alt="Product Image">
                        @else
                            <img src="/images/default-product.png" class="img-fluid mb-3" alt="Default Image">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <h5 class="card-title">Pesanan #{{ $order->id }}</h5>
                        <p class="card-text"><strong>Nama Pelanggan:</strong> {{ $order->user->name ?? 'Tidak Diketahui' }}</p>
                        <p class="card-text"><strong>Produk:</strong> {{ $order->product->nama ?? 'Tidak Diketahui' }}</p>
                        <p class="card-text"><strong>Harga per Hari:</strong> Rp. {{ number_format($order->product->harga, 0, '.', ',') }}</p>
                        <p class="card-text"><strong>Tanggal Mulai:</strong> {{ $order->mulai }}</p>
                        <p class="card-text"><strong>Tanggal Selesai:</strong> {{ $order->selesai }}</p>
                        <p class="card-text"><strong>Jumlah Pesan:</strong> {{ $order->jumlah }}</p>
                        <p class="card-text"><strong>Lokasi:</strong> {{ $order->lokasi }}</p>
                        <p class="card-text"><strong>Nomor Telepon:</strong> {{ $order->telepon }}</p>
                        <p class="card-text"><strong>Catatan:</strong> {{ $order->catatan ?? 'Tidak Ada Catatan' }}</p>
                        <p class="card-text"><strong>Total:</strong> Rp. {{ number_format($order->total, 0, '.', ',') }}</p>

                        <!-- Status with badge -->
                        <p class="card-text">
                            <strong>Status:</strong>
                            @if($order->status === 'paid')
                                <span class="badge bg-success">Sudah Dibayar</span>
                            @else
                                <span class="badge bg-danger">Belum Dibayar</span>
                            @endif
                        </p>

                        @if(Auth::user()->hasRole('user'))
                            <a id="pay-button" class="btn btn-primary">Bayar</a>
                            <a href="{{ route('order.index') }}" class="btn btn-secondary">Kembali ke Riwayat Pesan</a>
                        @endif
                        @if(Auth::user()->hasRole('seller') || Auth::user()->hasRole('admin'))
                            <a href="{{ route('order.list') }}" class="btn btn-secondary">Kembali ke Daftar Pesanan</a>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
<script type="text/javascript">
  document.getElementById('pay-button').onclick = function(){
    snap.pay('{{ $order->snap_token }}', {
      onSuccess: function(result){
        window.location.href = '{{ route('order.success', $order->id) }}';
      },
      onPending: function(result){
        // Add your code here
      },
      onError: function(result){
        // Add your code here
      }
    });
  };
</script>
