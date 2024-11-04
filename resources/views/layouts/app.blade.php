<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snapgram</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" integrity="sha384-5Z9I5EaJ5lbrrXoC/qPE7nY+nxltipci6LtFwg6aVp1Q2ew2IVwv5by3T7WlXvNf" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
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
    <div class="container my-4">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-ppQ4eRHmWgxWu+0q8uDZ9onhlTuB1h+sq+I2jrPtfCZBFjDOwvfIoOjF+XhhUSn3" crossorigin="anonymous"></script>
</body>
</html>
