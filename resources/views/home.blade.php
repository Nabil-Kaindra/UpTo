@extends('layouts.app')

@section('content')
<h2 style="text-align: center;">Snapgram</h2>

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
                    <p class="card-text">{{ Str::limit($photo->deskripsiFoto, 50) }}</p>
                    <p class="card-text">
                        <small class="text-muted">{{ $photo->user->username }} on {{ $photo->created_at->format('d M Y') }}</small>
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <form action="{{ route('photos.like', $photo->fotoID) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm">
                                @if($photo->isLikedByAuthUser())
                                    Unlike
                                @else
                                    Like
                                @endif
                            </button>
                        </form>
                        <a href="{{ route('photos.comments', $photo->fotoID) }}" class="btn btn-secondary btn-sm">Komentar</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
