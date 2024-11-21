@extends('layouts.app')
@section('content')



<div class="container mt-5">
    <h2 class="text-center mb-4">Daftar Dokumentasi Kegiatan</h2>
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('albums.create') }}" class="btn btn-primary">
            Tambah Kegiatan
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover"> 
            <thead class="table-dark">
                <tr>
                    <th class="text-center">Foto</th>
                    <th class="text-center">Judul Kegiatan</th>
                    <th class="text-center">Deskripsi</th>
                    <th class="text-center">Lokasi</th>
                    <th class="text-center">Tanggal Kegiatan</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($albums as $album)
                <tr>
            <td class="text-center">
                @if ($album->photos->isNotEmpty() && $album->photos->first()?->lokasiFile)
                    <img src="{{ asset('storage/' . $album->photos->first()->lokasiFile) }}" 
                    alt="{{ $album->judulAlbum }}"
                    style="width: 200px; aspect-ratio: 1/1; object-fit: cover;">
                @else
                <img src="{{ asset('storage/default.jpg') }}"
                    alt="No Photo Has Been Uploaded"
                    style="width: 200px; aspect-ratio: 1/1; object-fit: cover;">
                @endif
            </td>

                    <td class="text-center">
                        <a href="{{ route('albums.photos', $album->albumID) }}">
                            {{ $album->namaAlbum }}
                        </a>
                    </td>
                    <td class="text-center">{{ Str::limit($album->deskripsi, 50) }}</td>
                    <td class="text-center">{{ $album->lokasi }}</td>
                    <td class="text-center">{{ $album->tanggalDibuat }}</td>
                    <td class="text-center">
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="{{ route('albums.edit', $album->albumID) }}" class="btn btn-sm btn-warning">
                                Edit
                            </a>
                            <form action="{{ route('albums.destroy', $album->albumID) }}" method="POST" onsubmit="return confirm('Tindakan ini tidak bisa dibatalkan');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $albums->links() }}
    </div>
</div>

@endsection
