@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        @foreach($albums as $album)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <a href="{{ route('albums.photos', $album->albumID) }}" class="text-decoration-none text-dark">
                <div class="card fixed-card h-100">
                    <!-- Tampilkan foto pertama dari album -->
                    @if($album->photos->isNotEmpty())
                        <img src="{{ asset('storage/' . $album->photos->first()->lokasiFile) }}" 
                            alt="{{ $album->judulAlbum }}" 
                            class="card-img-top fixed-image">
                    @else
                        <!-- Placeholder jika album tidak memiliki foto -->
                        <img src="{{ asset('images/default-album.png') }}"
                            alt="No image available"
                            class="card-img-top fixed-image">
                    @endif
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $album->namaAlbum }}</h5>
                        <p class="card-text">{{ Str::limit($album->deskripsi, 100) }}</p>
                        <p class="card-text">
                            <small class="text-muted">{{ $album->created_at->format('d M Y') }}</small>
                        </p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $albums->links() }} <!-- Tampilkan pagination -->
    </div>
</div>
@endsection
