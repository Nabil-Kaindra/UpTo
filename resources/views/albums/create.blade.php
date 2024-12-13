@extends('layouts.app')
@section('content')

<!-- PAGE TAMBAH KEGIATAN, DIMANA USER BISA BERINTERAKSI DENGAN FORM INI UNTUK MENAMBAHKAN KEGIATAN BARU. PAGE INI HANYA BISA DI AKSES OLEH USER YANG SUDAH LOGIN -->

<div class="container mt-5">
    <h2 class="text-center mb-4">Buat Album Baru</h2>
    <div class="card shadow-sm p-4">
        <!-- Form untuk Membuat Album -->
        <form action="{{ route('albums.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="namaAlbum" class="form-label">Judul Kegiatan</label>
                <input type="text" class="form-control" name="namaAlbum" id="namaAlbum" required>
            </div>
            <div class="mb-3">
                <label for="lokasi" class="form-label">Lokasi Kegiatan</label>
                <input type="text" class="form-control" name="lokasi" id="lokasi" required>
            </div>
            <div class="mb-3">
                <label for="tanggalDibuat" class="form-label">Tanggal</label>
                <input type="date" class="form-control" name="tanggalDibuat" id="tanggalDibuat" required>
            </div>
            <div class="mb-3">
                <label for="waktu" class="form-label">Jam Kegiatan</label>
                <input type="time" class="form-control" name="waktu" id="waktu" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi Kegiatan</label>
                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" maxlength="150"></textarea>
                <small class="form-text text-muted">Maksimum 150 karakter.</small>
            </div>

            <!-- Foto Upload Form -->
            <h3 class="text-center mb-4">Upload Foto</h3>
            <div class="mb-3">
                <label for="photos" class="form-label">Pilih Foto</label>
                <input type="file" name="photos[]" id="photos" class="form-control" multiple required>
            </div>
            <div id="judul-container">
                <!-- JavaScript akan menambahkan input judul foto di sini -->
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">Tambah Album dan Foto</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('photos').addEventListener('change', function (e) {
        const container = document.getElementById('judul-container');
        container.innerHTML = ''; // Hapus input judul sebelumnya

        Array.from(e.target.files).forEach((file, index) => {
            const div = document.createElement('div');
            div.className = 'mb-3';

            const label = document.createElement('label');
            label.setAttribute('for', `judulFoto-${index}`);
            label.className = 'form-label';

            // Mengambil nama file dan mengubahnya menjadi format yang lebih baik untuk judul
            const fileNameWithoutExt = file.name.split('.').slice(0, -1).join('.'); // Menghapus ekstensi
            label.textContent = `Nama File (${fileNameWithoutExt}):`;

            const input = document.createElement('input');
            input.type = 'text';
            input.className = 'form-control';
            input.id = `judulFoto-${index}`;
            input.name = 'judulFoto[]';
            input.value = fileNameWithoutExt; // Set judul input sesuai dengan nama file

            div.appendChild(label);
            div.appendChild(input);
            container.appendChild(div);
        });
    });
</script>

@endsection
