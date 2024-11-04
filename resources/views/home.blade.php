@extends('layouts.app')

@section('content')
<h2 style="text-align: center;">Snapgram</h2>

<div class="container">
    <div class="row">
        @foreach($photos as $photo)
        <div class="col-md-3 mb-4"> 
            <div class="card">
                <img src="{{ asset('storage/' . $photo->lokasiFile) }}" 
                    alt="{{ $photo->judulFoto }}" 
                    class="card-img-top" 
                    style="height: 200px; object-fit: cover; border-radius: 10px 10px 0 0;">
                <div class="card-body">
                    <h5 class="card-title">{{ $photo->judulFoto }}</h5>
                    <p class="card-text">{{ Str::limit($photo->deskripsiFoto, 50) }}</p>
                    <p class="card-text">
                        <small class="text-muted">Uploaded by {{ $photo->user->username }} on {{ $photo->created_at->format('d M Y') }}</small>
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
