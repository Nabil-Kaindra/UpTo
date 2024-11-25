@extends('layouts.app')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container my-5">
    <div class="row g-4">
        <!--Bagian Kiri Yang Berisi Foto Dari Kegiatan-->
        <div class="col-md-6">
            <div class="row row-cols-2 g-3">
                @forelse($photos as $photo)
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
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">No photos available.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!--Bagian Kanan Yang Berisi Keterangan Dari Kegiatan-->
        <div class="col-md-6">
            <div class="card shadow-lg p-3 w-100">
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

            <!--Tombol Pagination Jika Foto Di Kegiatan Atau Album Lebih Dari 4 Foto-->
            @if($photos->count() > 4)
                <div class="d-flex justify-content-end ">
                    {{ $photos->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection