@extends('layouts.app')
@section('content')

<div class="container mt-5">
    <h2 class="text-center mb-4">Edit Album</h2>
    <div class="card shadow-sm p-4">
        <form action="{{ route('albums.update', $album->albumID) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="namaAlbum" class="form-label">Nama Album</label>
                <input type="text" class="form-control" name="namaAlbum" id="namaAlbum" value="{{ $album->namaAlbum }}" required>
            </div>
            <div class="mb-3">
                <label for="lokasi" class="form-label">Lokasi Kegiatan</label>
                <input type="text" class="form-control" name="lokasi" id="lokasi" value="{{ $album->lokasi }}" >
            </div>
            <div class="mb-3">
                <label for="tanggalDibuat" class="form-label">Tanggal</label>
                <input type="date" class="form-control" name="tanggalDibuat" id="tanggalDibuat" value="{{ $album->tanggalDibuat }}" required>
            </div>
            <div class="mb-3">
                <label for="waktu" class="form-label">Jam Kegiatan</label>
                <input type="time" class="form-control" name="waktu" id="waktu" value="{{ $album->waktu }}" >
            </div>
            <div class="mb-3">
                <label for="uraian" class="form-label">Uraian</label>
                <input type="text" class="form-control" name="uraian" id="uraian" value="{{ $album->uraian }}" >
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi Album</label>
                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" maxlength="150">{{ $album->deskripsi }}</textarea>
                <small class="form-text text-muted">Maksimum 150 karakter.</small>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Update Album</button>
            </div>
        </form>
    </div>
</div>
@endsection
