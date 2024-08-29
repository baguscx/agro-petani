<x-app-layout>
    <x-nav/>
    <div class="container py-5">
        <h2 class="mb-4">Daftar Pesanan</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Pelanggan</th>
                    <th scope="col">Produk</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Tanggal Pesanan</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $order->user->name ?? 'Tidak Diketahui' }}</td>
                        <td>{{ $order->product->nama ?? 'Tidak Diketahui' }}</td>
                        <td>Rp. {{ number_format($order->product->harga ?? 0, 0, '.', ',') }}</td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                        <td>
                            @if($order->status == 'paid')
                                <span class="badge bg-success">Sudah Dibayar</span>
                            @else
                                <span class="badge bg-danger">Belum Dibayar</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('order.show', $order->id) }}" class="btn btn-info btn-sm">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada pesanan yang tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
