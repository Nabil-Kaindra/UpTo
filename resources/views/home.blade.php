@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        @foreach($photos as $photo)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="card fixed-card h-100">
                <img src="{{ asset('storage/' . $photo->lokasiFile) }}" 
                    alt="{{ $photo->judulFoto }}" 
                    class="card-img-top fixed-image">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $photo->judulFoto }}</h5>
                    <p class="card-text">{{ Str::limit($photo->deskripsiFoto, 100) }}</p>
                    <p class="card-text">
                        <small class="text-muted">{{ $photo->created_at->format('d M Y') }}</small>
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $photos->links() }} <!-- Tampilkan pagination -->
    </div>
</div>
@endsection
