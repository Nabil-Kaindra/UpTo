@extends('layouts.app')
@section('content')

<!-- Landing Page -->

<div class="container mt-5">
    <!-- Akan Menampilkan Pesan Dokumentasi Kegiatan Tidak Tersedia Jika Belum Ada Kegiatan Yang Dibuat -->
    @if($albums->isEmpty())
        <div class="alert alert-warning text-center">
            Dokumentasi kegiatan tidak tersedia .
        </div>
    @else

        <div class="row">
            @foreach($albums as $album)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                <!-- Link Ini Membawa User Masuk Ke Page Yang Akan Menampilkan Informasi Lebih Lengkap Dan Dokumentasi Kegiatan -->
                <a href="{{ route('albums.photos', $album->albumID) }}" class="text-decoration-none text-dark">
                    <div class="card fixed-card h-100 shadow-sm">
                        <!-- Menampilkan Foto Pertama Yang Di Upload Pada Kegiatan -->
                        @if($album->photos->isNotEmpty())
                            <img src="{{ asset('storage/' . $album->photos->first()->lokasiFile) }}" 
                                alt="{{ $album->judulAlbum }}" 
                                class="card-img-top fixed-image" style="object-fit: cover; height: 200px;">
                        @else
                        <!-- Akan Menjalankan Perintah Ini jika Belum Ada Foto Yang Di Upload Atau Di Tambahkan Di Kegiatan Tersebut -->
                            <img src="{{ asset('images/default-album.png') }}"
                                alt="No image available"
                                class="card-img-top fixed-image" style="object-fit: cover; height: 200px;">
                        @endif
                        <!-- Menampilkan Info Tentang Kegiatan Seperti Judul Kegiatan, Tanggal Kegiatan, dan Deskripsi Kegiatan -->
                        <div class="card-body text-center">
                            <h5 class="card-title font-weight-bold">{{ $album->namaAlbum }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($album->deskripsi, 70) }}</p>
                            <p><small class="text-muted">
                                {{ $album->tanggalDibuat ? \Carbon\Carbon::parse
                                ($album->tanggalDibuat)->format('d M Y') : 'Tanggal tidak tersedia' }}
                            </small></p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $albums->links() }}
        </div>
    @endif
</div>

@endsection
