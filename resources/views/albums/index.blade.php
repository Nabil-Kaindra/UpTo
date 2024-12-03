@extends('layouts.app')
@section('content')

<div class="container mt-5">
    <h2 class="text-center mb-4">Daftar Dokumentasi Kegiatan</h2>
    
    <!-- Top section: Search and Add button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <!-- Search Form -->
        <form action="{{ route('albums.index') }}" method="GET" class="d-flex align-items-center w-25">
            <input type="text" name="query" class="form-control form-control-sm" placeholder="Cari Kegiatan" value="{{ request()->query('query') }}">
            <button type="submit" class="btn btn-outline-secondary btn-sm ms-2">
                Cari
            </button>
        </form>

        <!-- Add New Activity Button -->
        <a href="{{ route('albums.create') }}" class="btn btn-primary btn-lg ms-3">
            Tambah Kegiatan
        </a>
    </div>

    <div class="table-responsive">
    <!-- Sort Dropdown moved to top-right corner of the table -->
    <div class="d-flex justify-content-end mb-3">
        <form action="{{ route('albums.index') }}" method="GET" class="d-flex">
            <select name="sort_by" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="date_asc" {{ request()->query('sort_by') == 'date_asc' ? 'selected' : '' }}>Tanggal (↑)</option>
                <option value="date_desc" {{ request()->query('sort_by') == 'date_desc' ? 'selected' : '' }}>Tanggal (↓)</option>
                <option value="title_asc" {{ request()->query('sort_by') == 'title_asc' ? 'selected' : '' }}>Judul (A-Z)</option>
                <option value="title_desc" {{ request()->query('sort_by') == 'title_desc' ? 'selected' : '' }}>Judul (Z-A)</option>
            </select>
        </form>
    </div>
    <!-- Table to display albums -->
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
                @forelse($albums as $album)
                <tr>
                    <td class="text-center">
                        @if ($album->photos->isNotEmpty() && $album->photos->first()?->lokasiFile)
                            <img src="{{ asset('storage/' . $album->photos->first()->lokasiFile) }}" 
                            alt="{{ $album->judulAlbum }}"
                            class="img-fluid" style="max-width: 150px; height: auto;">
                        @else
                            <img src="{{ asset('storage/default.jpg') }}"
                                alt="No Photo Has Been Uploaded"
                                class="img-fluid" style="max-width: 150px; height: auto;">
                        @endif
                    </td>

                    <td class="text-center">
                        <a href="{{ route('albums.photos', $album->albumID) }}" class="text-decoration-none text-dark">
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
                @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $albums->links() }}
    </div>
</div>

@endsection
