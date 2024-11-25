@extends('layouts.app')
@section('content')

<!-- Form Untuk Menambahkan Foto -->
<div class="container mt-5">
    <h2 class="text-center mb-4">Upload Foto Baru</h2>
    <div class="card shadow-sm p-4">
        <form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="photos" class="form-label">Pilih Foto</label>
                <input type="file" name="photos[]" id="photos" class="form-control" multiple required>
            </div>
            <div id="judul-container">
                <!-- JavaScript akan menambahkan input judul foto di sini -->
            </div>
            <div class="mb-3">
                <label for="albumID" class="form-label">Kegiatan</label>
                <select name="albumID" id="albumID" class="form-select" required>
                    <option value="">Pilih Kegiatan</option>
                    @foreach ($albums as $album)
                    <option value="{{ $album->albumID }}">
                        {{ $album->namaAlbum }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Unggah Foto</button>
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
            label.textContent = `Judul Foto (${file.name}):`;

            const input = document.createElement('input');
            input.type = 'text';
            input.className = 'form-control';
            input.id = `judulFoto-${index}`;
            input.name = 'judulFoto[]';

            div.appendChild(label);
            div.appendChild(input);
            container.appendChild(div);
        });
    });
</script>

@endsection
