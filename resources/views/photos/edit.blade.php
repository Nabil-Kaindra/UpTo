@extends('layouts.app')
@section('content')


<div class="container mt-5">
    <h2 class="text-center mb-4">Edit Foto</h2>
    <div class="card shadow-sm p-4">
        <form action="{{ route('photos.update', $photo->fotoID) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Edit Judul Foto -->
            <div class="mb-3">
                <label for="judulFoto" class="form-label">Judul Foto</label>
                <input type="text" id="judulFoto" name="judulFoto" class="form-control" value="{{ $photo->judulFoto }}" required>
            </div>

            <!-- Ubah Foto -->
            <div class="mb-3">
                <label for="photo" class="form-label">Pilih Foto</label>
                <input type="file" id="photo" name="photo" class="form-control">
                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto.</small>
            </div>

            <!-- Edit Album Foto Yang Ingin Digunakan -->
            <div class="mb-3">
                <label for="albumID" class="form-label">Kegiatan</label>
                <select id="albumID" name="albumID" class="form-select" required>
                    <option value="">Pilih Kegiatan</option>
                    @foreach ($albums as $album)
                        <option value="{{ $album->albumID }}" {{ $photo->albumID == $album->albumID ? 'selected' : '' }}>
                            {{ $album->namaAlbum }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="text-end">
                <!-- Tombol Update Foto -->
                <form action="{{ route('photos.update', $photo->fotoID) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-primary">Update Foto</button>
                </form>
                <!-- Tombol Hapus Foto -->
                <form action="{{ route('photos.destroy', $photo->fotoID) }}" method="POST" class="d-inline" 
                    onsubmit="return confirm('Yakin ingin menghapus foto ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </form>
    </div>
</div>
@endsection
