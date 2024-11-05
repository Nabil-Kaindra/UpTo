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
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">

    <a class="navbar-brand mx-auto" href="{{ route('home') }}">Snapgram</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <form class="d-flex mx-auto" action="{{ route('photos.search') }}" method="GET" style="width: 50%;">
                <input class="form-control me-2" type="search" name="query" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>

            <ul class="navbar-nav ms-auto">
                @if(Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('albums.index') }}">Albums</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('photos.create') }}">Upload</a>
                    </li>
                @endif
            </ul>
            
            <a href="{{ route('profile.index') }}" class="navbar-brand ms-3">
                <i class="fas fa-user"></i>
            </a>
        </div>
    </div>
</nav>



<div class="container my-4">
    @yield('content')
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-ppQ4eRHmWgxWu+0q8uDZ9onhlTuB1h+sq+I2jrPtfCZBFjDOwvfIoOjF+XhhUSn3" crossorigin="anonymous"></script>
</body>
</html>
