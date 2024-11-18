@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <h2 class="text-center mb-4">Daftar Kegiatan</h2>
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('albums.create') }}" class="btn btn-primary">
            Tambah Kegiatan
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Judul Kegiatan</th>
                    <th>Deskripsi</th>
                    <th>Lokasi</th>
                    <th>Tanggal Kegiatan</th>
                    <th>Waktu Kegiatan</th>
                    <th>Uraian</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($albums as $album)
                <tr>
                    <td>
                        <a href="{{ route('albums.photos', $album->albumID) }}" >
                            {{ $album->namaAlbum }}
                        </a>
                    </td>
                    <td>{{ Str::limit($album->deskripsi, 50) }}</td>
                    <td>{{ $album->lokasi }}</td>
                    <td>{{ $album->tanggalDibuat }}</td>
                    <td>{{ $album->waktu }} WIB</td>
                    <td>{{ Str::limit($album->uraian, 50) }}</td>
                    <td>
                        <div class="d-flex gap-2">
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
