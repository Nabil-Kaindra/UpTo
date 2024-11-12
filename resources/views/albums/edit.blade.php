@extends('layouts.app')
@section('content')
<div style="margin: 20px;">
    <h2  style="text-align: center;">Edit Album</h2>
    <form action="{{ route('albums.update',$album->albumID) }}" method="POST">
        @csrf
        @method('PUT')
        <table>
            <tr>
                <td>
                    <label for="namaAlbum">Nama Album</label>
                </td>
                <td>
                    <input type="text" name="namaAlbum" value="{{ $album->namaAlbum }}" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="lokasi">Lokasi Kegiatan</label>
                </td>
                <td>
                    <input type="text" name="lokasi" value="{{ $album->lokasi }}" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="waktu">Jam Kegiatan</label>
                </td>
                <td>
                    <input type="time" name="waktu" value="{{ $album->waktu }}" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="uraian">Uraian</label>
                </td>
                <td>
                    <input type="text" name="uraian" value="{{ $album->uraian }}" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="deskripsi">Deskripsi Album</label>
                </td>
                <td>
                    <textarea name="deskripsi" maxlength="150">{{ $album->deskripsi }}</textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: right;">
                    <button type="submit">Update Album</button>
                </td>
            </tr>
        </table>
    </form>
</div>
@endsection