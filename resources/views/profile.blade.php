@extends('layouts.app')

@section('content')
<h2 style="text-align: center; margin-top: 20px;">Profil Saya</h2>

@if(session('success'))
    <div style="background-color: #d4edda; color: #155724; padding: 10px; 
                margin-bottom: 20px; border: 1px solid #c3e6cb; 
                border-radius: 5px; text-align: center;">
        {{ session('success') }}
    </div>
@endif 

<form action="{{ route('profile.update') }}" method="POST" 
    style="max-width: 600px; margin: 20px auto; padding: 20px; 
            border: 1px solid #ccc; border-radius: 8px; 
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
    @csrf
    @method('PUT')
    <table style="width: 100%; border: none;">
        <tr>
            <td style="padding: 8px;"><label for="username">Username</label></td>
            <td style="padding: 8px;">
                <input type="text" name="username" value="{{ $user->username }}" 
                    style="width: 100%; padding: 8px; 
                            border: 1px solid #ddd; border-radius: 4px;" required>
            </td>
        </tr>
        <tr>
            <td style="padding: 8px;"><label for="namaLengkap">Nama Lengkap</label></td>
            <td style="padding: 8px;">
                <input type="text" name="namaLengkap" value="{{ $user->namalengkap }}" 
                    style="width: 100%; padding: 8px; 
                            border: 1px solid #ddd; border-radius: 4px;" required>
            </td>
        </tr>
        <tr>
            <td style="padding: 8px;"><label for="email">Email</label></td>
            <td style="padding: 8px;">
                <input type="email" name="email" value="{{ $user->email }}" 
                    style="width: 100%; padding: 8px; 
                            border: 1px solid #ddd; border-radius: 4px;" required>
            </td>
        </tr>
        <tr>
            <td style="padding: 8px;"><label for="password">Password</label></td>
            <td style="padding: 8px;">
                <input type="password" name="password" 
                    style="width: 100%; padding: 8px; 
                            border: 1px solid #ddd; border-radius: 4px;">
            </td>
        </tr>
        <tr>
            <td style="padding: 8px;"><label for="password_confirmation">Konfirmasi Password</label></td>
            <td style="padding: 8px;">
                <input type="password" name="password_confirmation" 
                    style="width: 100%; padding: 8px; 
                            border: 1px solid #ddd; border-radius: 4px;">
            </td>
        </tr>
</form>
        <tr>
            <td colspan="2" style="padding: 20px;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                                style="background-color: #f44336; color: white; padding: 7px 20px; 
                                border: none; border-radius: 4px; cursor: pointer; 
                                font-size: 16px;">Logout</button>
                    </form>
                    <button type="submit"
                            style="background-color: #4A90E2; color: white; padding: 7px 20px; 
                            border: none; border-radius: 4px; cursor: pointer; 
                            font-size: 16px;">Simpan</button>
                </div>
            </td>
        </tr>
</table>
@endsection
