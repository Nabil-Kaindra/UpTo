@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Buat Album Baru</h2>
    <div class="card shadow-sm p-4">
        <form action="{{ route('albums.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="namaAlbum" class="form-label">Nama Album</label>
                <input type="text" class="form-control" name="namaAlbum" id="namaAlbum" required>
            </div>
            <div class="mb-3">
                <label for="lokasi" class="form-label">Lokasi Kegiatan</label>
                <input type="text" class="form-control" name="lokasi" id="lokasi" required>
            </div>
            <div class="mb-3">
                <label for="waktu" class="form-label">Jam Kegiatan</label>
                <input type="time" class="form-control" name="waktu" id="waktu" required>
            </div>
            <div class="mb-3">
                <label for="uraian" class="form-label">Uraian</label>
                <input type="text" class="form-control" name="uraian" id="uraian" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi Album</label>
                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" required maxlength="150"></textarea>
                <small class="form-text text-muted">Maksimum 150 karakter.</small>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Tambah Album</button>
            </div>
        </form>
    </div>
</div>
@endsection
