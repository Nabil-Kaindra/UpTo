@extends('layouts.app')

@section('content')
<h2 style="text-align: center;">Snapgram</h2>
<table>
    <thead>
        <tr>
            <th>Pengguna</th>
            <th>Judul</th>
            <th>Keterangan</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($photos as $photo)
        <tr>
            <td>{{ $photo->user->username }}</td>
            <td>{{ $photo->judulFoto }}</td>
            <td>{{ $photo->deskripsiFoto }}</td>
            <td>
                <img src="{{ asset('storage/' . $photo->lokasiFile) }}" 
                    alt="{{ $photo->judulFoto }}"
                    style="width: 200px; aspect-ratio: 1/1; object-fit: cover;" >
            </td>

            <td>
            <form action="{{ route('photos.like', $photo->fotoID) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit">
                        @if($photo->isLikedByAuthUser())
                            Unlike
                        @else
                            Like
                        @endif
                    </button>
                </form>
                <a href="{{ route('photos.comments', $photo->fotoID) }}" style="margin-left: 10px;">Komentar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection