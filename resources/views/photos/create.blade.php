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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#albumID').select2({
            placeholder: "Pilih Kegiatan",
            allowClear: true
        });
    });
</script>

@endsection
