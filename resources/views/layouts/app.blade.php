<!DOCTYPE html>
<html lang="en">
<head>
    <title>Snapgram</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <nav class="nav-bar">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('albums.index') }}">Albums</a>
        <a href="{{ route('photos.create') }}">Upload</a>
        <a href="{{ route('profile.index') }}" class="profile-link">
            <i class="fas fa-user"></i>
        </a>
    </nav>
    @yield('content')
</body>
</html>