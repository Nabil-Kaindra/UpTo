@extends('layouts.app')
@section('content')
<div class="container my-5">
    <div class="row g-4">
        <!-- Bagian kiri dengan gambar-gambar album -->
        <div class="col-md-6">
            <h4 class="mb-4 text-center">Foto Kegiatan</h4>
            <div class="row row-cols-2 g-3">
                @foreach($album->photos as $photo)
                    <div class="col">
                        <div class="card shadow-sm">
                            <a href="{{ route('photos.edit', $photo->fotoID) }}">
                                <img src="{{ asset('storage/' . $photo->lokasiFile) }}" 
                                    alt="{{ $photo->judulFoto }}" 
                                    class="card-img-top rounded" 
                                    style="aspect-ratio: 1/1; object-fit: cover;">
                                <div class="card-body p-2 text-center">
                                    <p class="card-text text-muted mb-0">{{ $photo->judulFoto }}</p>
                                </div>
                        </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Bagian kanan dengan keterangan album -->
        <div class="col-md-6 d-flex align-items-center">
            <div class="card shadow-lg p-4 w-100" style="width: 100%; max-width: none;">
                <div class="card-body">
                    <h5 class="card-title text-primary">Informasi Kegiatan</h5>
                    <hr>
                    <p><strong>Nama Kegiatan:</strong> {{ $album->namaAlbum }}</p>
                    <p><strong>Tanggal:</strong> {{ $album->tanggalDibuat }}</p>
                    <p><strong>Jam Kegiatan:</strong> {{ $album->waktu }} WIB </p>
                    <p><strong>Lokasi:</strong> {{ $album->lokasi }}</p>
                    <p><strong>Uraian:</strong> {{ $album->uraian }}</p>
                    <p><strong>Deskripsi:</strong> {{ $album->deskripsi }}</p>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
