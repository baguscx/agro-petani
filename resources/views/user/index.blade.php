<x-app-layout>
    <x-nav/>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="container py-5">
        <h2 class="mb-4">Daftar Pesanan</h2>
        <div class="mb-3">
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Tambah User</a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Pelanggan</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->getRoleNames()->implode(', ') }}</td>
                        <td>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            {{-- <a href="{{ route('admin.users.delete', $user-x>id) }}" class="btn btn-danger btn-sm">Delete</a> --}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada pengguna yang tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
