<x-app-layout>
    <x-nav />
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-5">{{ $page['title'] }}</h2>
            <form action="{{ $page['action'] }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method($page['method'])

                <!-- Gambar (Optional) -->
                <div class="mb-4">
                    <label for="gambar" class="block text-gray-700">Gambar (opsional):</label>
                    <input type="file" name="gambar" id="gambar" class="w-full border-gray-300 rounded-md shadow-sm">
                    @if(isset($user->gambar))
                        <img src="{{ asset($user->gambar) }}" alt="Gambar Produk" style="width:200px;" class="mt-2 max-w-[100px] border border-gray-300 rounded-md">
                    @endif
                    @if ($errors->has('gambar'))
                        <span class="text-red-500 text-sm">{{ $errors->first('gambar') }}</span>
                    @endif
                </div>

                <!-- Nama Jasa/Barang -->
                <div class="mb-4">
                    <label for="nama" class="block text-gray-700">Nama Jasa/Barang:</label>
                    <input type="text" name="nama" id="nama" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ old('nama', $user->name ?? '') }}" required>
                    @if ($errors->has('nama'))
                        <span class="text-red-500 text-sm">{{ $errors->first('nama') }}</span>
                    @endif
                </div>

                <!-- Harga -->
                <div class="mb-4">
                    <label for="harga" class="block text-gray-700">Harga:</label>
                    <input type="number" name="harga" id="harga" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ old('harga', $user->harga ?? '') }}" required>
                    @if ($errors->has('harga'))
                        <span class="text-red-500 text-sm">{{ $errors->first('harga') }}</span>
                    @endif
                </div>

                <!-- Deskripsi -->
                <div class="mb-4">
                    <label for="deskripsi" class="block text-gray-700">Deskripsi:</label>
                    <textarea name="deskripsi" id="deskripsi" class="w-full border-gray-300 rounded-md shadow-sm" rows="4" required>{{ old('deskripsi', $user->deskripsi ?? '') }}</textarea>
                    @if ($errors->has('deskripsi'))
                        <span class="text-red-500 text-sm">{{ $errors->first('deskripsi') }}</span>
                    @endif
                </div>

                <!-- Jumlah -->
                <div class="mb-4">
                    <label for="jumlah" class="block text-gray-700">Jumlah:</label>
                    <input type="number" name="jumlah" id="jumlah" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ old('jumlah', $user->jumlah ?? '') }}" required>
                    @if ($errors->has('jumlah'))
                        <span class="text-red-500 text-sm">{{ $errors->first('jumlah') }}</span>
                    @endif
                </div>

                <!-- Kategori -->
                <div class="mb-4">
                    <label for="kategori" class="block text-gray-700">Kategori:</label>
                    <select name="kategori" id="kategori" class="w-full border-gray-300 rounded-md shadow-sm" required>
                        <option value="jasa" {{ old('kategori', $user->kategori ?? '') == 'jasa' ? 'selected' : '' }}>Jasa</option>
                        <option value="sewa" {{ old('kategori', $user->kategori ?? '') == 'sewa' ? 'selected' : '' }}>Sewa Barang</option>
                    </select>
                    @if ($errors->has('kategori'))
                        <span class="text-red-500 text-sm">{{ $errors->first('kategori') }}</span>
                    @endif
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" class="btn btn-primary">{{ $page['button'] }}</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
