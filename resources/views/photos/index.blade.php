@extends('layouts.app')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container my-5">
    <div class="row g-4">
        <!-- Bagian Kiri Yang Berisi Foto Dari Kegiatan -->
        <div class="col-md-6">
            <div class="row row-cols-2 g-3">
                @forelse($photos as $photo)
                    <div class="col">
                        <div class="card shadow-sm h-10">
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
                        <p class="text-muted">Tidak ada foto yang tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Bagian Kanan Yang Berisi Keterangan Dari Kegiatan -->
        <div class="col-md-6 d-flex">
            <div class="card shadow-lg p-3 w-100 card-info">
                <div class="card-body">
                    <h5 class="card-title text-primary text-center mb-4">Informasi Kegiatan</h5>
                    <div class="row mb-3">
                        <div class="col-4 text-muted"><strong>Nama Kegiatan:</strong></div>
                        <div class="col-8">{{ $album->namaAlbum }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4 text-muted"><strong>Tanggal:</strong></div>
                        <div class="col-8">{{ $album->tanggalDibuat }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4 text-muted"><strong>Jam Kegiatan:</strong></div>
                        <div class="col-8">{{ $album->waktu }} WIB</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4 text-muted"><strong>Lokasi:</strong></div>
                        <div class="col-8">{{ $album->lokasi }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4 text-muted"><strong>Uraian:</strong></div>
                        <div class="col-8">{{ $album->uraian }}</div>
                    </div>
                    <div class="row">
                        <div class="col-4 text-muted"><strong>Deskripsi:</strong></div>
                        <div class="col-8">{{ $album->deskripsi }}</div>
                    </div>
                </div>
            </div>
        </div>
        <!--Tombol Pagination Jika Foto Di Album Lebih Dari 4 Foto
        @if($photos->hasPages())
        <div class="d-flex justify-content-end mt-3">
            {{ $photos->links() }}
        </div>
        @endif
        -->
    </div>
</div>
@endsection
