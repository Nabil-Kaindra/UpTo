@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Upload Foto Baru</h2>
    <div class="card shadow-sm p-4">
        <form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="judulFoto" class="form-label">Judul Foto</label>
                <input type="text" name="judulFoto" id="judulFoto" class="form-control" placeholder="Masukkan judul foto" required>
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">Pilih Foto</label>
                <input type="file" name="photo" id="photo" class="form-control" required>
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
@endsection
