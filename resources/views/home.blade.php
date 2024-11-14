@extends('layouts.app')

@section('content')

<div class="container mt-5">
    @if($albums->isEmpty())
        <div class="alert alert-warning text-center">
            Album yang dicari tidak ditemukan.
        </div>
    @else
        <div class="row">
            @foreach($albums as $album)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                <a href="{{ route('albums.photos', $album->albumID) }}" class="text-decoration-none text-dark">
                    <div class="card fixed-card h-100 shadow-sm">
                        <!-- Tampilkan foto pertama dari album atau placeholder -->
                        @if($album->photos->isNotEmpty())
                            <img src="{{ asset('storage/' . $album->photos->first()->lokasiFile) }}" 
                                alt="{{ $album->judulAlbum }}" 
                                class="card-img-top fixed-image" style="object-fit: cover; height: 200px;">
                        @else
                            <img src="{{ asset('images/default-album.png') }}"
                                alt="No image available"
                                class="card-img-top fixed-image" style="object-fit: cover; height: 200px;">
                        @endif
                        <div class="card-body text-center">
                            <h5 class="card-title font-weight-bold">{{ $album->namaAlbum }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($album->deskripsi, 70) }}</p>
                            <p class="card-text">
                                <small class="text-muted">{{ $album->created_at->format('d M Y') }}</small>
                            </p>
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
