@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4 ">Daftar Dokumentasi Kegiatan</h2>

    <div class="table-responsive">
        
        <!-- Top section: Search and Add button -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
            
            <!-- Search and Sort Form -->
            <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center gap-3 w-50">
                <!-- Search Form -->
                <form action="{{ route('albums.index') }}" method="GET" class="d-flex align-items-center w-100 w-md-75 mb-2 mb-md-0">
                    <input type="text" name="query" class="form-control form-control-sm border border-primary rounded-3 shadow-sm" placeholder="Cari Kegiatan" value="{{ request()->query('query') }}">
                    <button type="submit" class="btn btn-outline-primary btn-sm ms-2 rounded-3 shadow-sm">
                        Cari
                    </button>
                </form>

                <!-- Sort Dropdown -->
                <form action="{{ route('albums.index') }}" method="GET" class=" w-30 w-md-auto">
                    <select name="sort_by" class="form-select form-select-sm w-100 w-md-auto border border-primary rounded-3 shadow-sm" onchange="this.form.submit()">
                        <option value="date_asc" {{ request()->query('sort_by') == 'date_asc' ? 'selected' : '' }}>Tanggal (↑)</option>
                        <option value="date_desc" {{ request()->query('sort_by') == 'date_desc' ? 'selected' : '' }}>Tanggal (↓)</option>
                        <option value="title_asc" {{ request()->query('sort_by') == 'title_asc' ? 'selected' : '' }}>Judul (A-Z)</option>
                        <option value="title_desc" {{ request()->query('sort_by') == 'title_desc' ? 'selected' : '' }}>Judul (Z-A)</option>
                    </select>
                </form>
            </div>  
            <!-- Add New Activity Button -->
            <a href="{{ route('albums.create') }}" class="btn btn-primary btn-lg mt-2 mt-md-0">
                <i class="bi bi-plus-circle"></i> Tambah Kegiatan
            </a>
        </div>
    
        <!-- Table to display albums -->
        <table class="table table-striped table-hover table-sm">
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
                            class="img-fluid" style="max-width: 150px; object-fit: cover; aspect-ratio: 1/1;">
                        @else
                            <img src="{{ asset('storage/default.jpg') }}"
                                alt="No Photo Has Been Uploaded"
                                class="img-fluid" style="max-width: 150px; object-fit: cover; aspect-ratio: 1/1;">
                        @endif
                    </td>

                    <td class="text-center">
                        <a href="{{ route('albums.photos', $album->albumID) }}" class="d-block text-truncate" style="max-width: 150px;">
                            {{ Str::limit($album->namaAlbum, 20) }}
                        </a>
                    </td>

                    <td class="text-center" style="max-width: 200px; overflow: hidden; text-overflow: ellipsis;">
                        {{ Str::limit($album->deskripsi, 100) }}
                    </td>
                    <td class="text-center" style="max-width: 150px; overflow: hidden; text-overflow: ellipsis;">
                        {{ Str::limit($album->lokasi, 20) }}
                    </td>
                    <td class="text-center">{{ $album->tanggalDibuat }}</td>
                    <td class="text-center">
                        <div class="d-flex gap-2 flex-column flex-md-row justify-content-center">
                            <a href="{{ route('albums.edit', $album->albumID) }}" class="btn btn-sm btn-warning mb-2 mb-md-0">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('albums.destroy', $album->albumID) }}" method="POST" onsubmit="return confirm('Tindakan ini tidak bisa dibatalkan');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i> Hapus
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
