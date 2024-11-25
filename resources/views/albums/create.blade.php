@extends('layouts.app')
@section('content')

<!-- PAGE TAMBAH KEGIATAN, DIMANA USER BISA BERINTERAKSI DENGAN FORM INI UNTUK MENAMBAHKAN KEGIATAN BARU. PAGE INI HANYA BISA DI AKSES OLEH USER YANG SUDAH LOGIN -->

<div class="container mt-5">
    <h2 class="text-center mb-4">Buat Album Baru</h2>
    <div class="card shadow-sm p-4">
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
                <label for="uraian" class="form-label">Uraian</label>
                <input type="text" class="form-control" name="uraian" id="uraian" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi Kegiatan</label>
                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3"  maxlength="150"></textarea>
                <small class="form-text text-muted">Maksimum 150 karakter.</small>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Tambah Album</button>
            </div>
        </form>
    </div>
</div>
@endsection