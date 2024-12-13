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
        <div class="col-lg-6">
            <div class="row row-cols-2 row-cols-sm-2 row-cols-md-2 g-3">
                @forelse($photos as $photo)
                    <div class="col">
                        <div class="card shadow-sm h-10">
                            <a href="{{ Auth::check() ? route('photos.edit', $photo->fotoID) : '#' }}" 
                                data-bs-toggle="{{ Auth::check() ? '' : 'modal' }}" 
                                data-bs-target="{{ Auth::check() ? '' : '#viewPhotoModal' }}" 
                                onclick="showPhotoModal('{{ asset('storage/' . $photo->lokasiFile) }}', '{{ $photo->judulFoto }}', '{{ $photo->deskripsi }}')">
                                <img src="{{ asset('storage/' . $photo->lokasiFile) }}" 
                                    alt="{{ $photo->judulFoto }}" 
                                    class="card-img-top rounded card-img-custom">
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
        <div class="col-lg-6 d-flex">
            <div class="card shadow-lg p-3 w-100 card-info">
                <div class="card-body">
                    <h5 class="card-title text-primary text-center mb-4">Informasi Kegiatan</h5>
                    <div class="mb-3">
                        <strong class="d-block text-muted">Nama Kegiatan:</strong>
                        <span>{{ $album->namaAlbum }}</span>
                    </div>
                    <div class="mb-3">
                        <strong class="d-block text-muted">Tanggal:</strong>
                        <span>{{ $album->tanggalDibuat }}</span>
                    </div>
                    <div class="mb-3">
                        <strong class="d-block text-muted">Jam Kegiatan:</strong>
                        <span>{{ $album->waktu }} WIB</span>
                    </div>
                    <div class="mb-3">
                        <strong class="d-block text-muted">Lokasi:</strong>
                        <span>{{ $album->lokasi }}</span>
                    </div>
                    <div>
                        <strong class="d-block text-muted">Deskripsi:</strong>
                        <span>{{ $album->deskripsi }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol Pagination Jika Foto Di Album Lebih Dari 4 Foto 
    @if($photos->hasPages())
        <div class="d-flex justify-content-center mt-3">
            {{ $photos->links() }}
        </div>
    @endif -->
</div>

<!-- Modal untuk Detail Foto -->
<div class="modal fade" id="viewPhotoModal" tabindex="-1" aria-labelledby="viewPhotoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewPhotoModalLabel">Detail Foto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalPhotoImage" src="" alt="Foto" class="img-fluid mb-3" style="max-height: 400px; object-fit: cover;">
                <h5 id="modalPhotoTitle"></h5>
                <p id="modalPhotoDescription" class="text-muted"></p>
            </div>
        </div>
    </div>
</div>

<script>
    // Fungsi untuk menampilkan modal dengan konten dinamis
    function showPhotoModal(imageSrc = '', title = 'Foto', description = '') {
        document.getElementById('modalPhotoImage').src = imageSrc;
    }
</script>


@endsection
