<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DASHBOARD DOKUMENTASI KEGIATAN</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" integrity="sha384-5Z9I5EaJ5lbrrXoC/qPE7nY+nxltipci6LtFwg6aVp1Q2ew2IVwv5by3T7WlXvNf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!-- Add Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>
<!-- Updated Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
        <a class="navbar-brand mx-auto d-flex flex-column align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('images/nav-logo.png') }}" alt="Logo" class="img-fluid" style="max-height: 40px;">
            <span class="mt-1" style="font-size: 17px;">Dokumentasi Kegiatan</span>
        </a>

        <button class="navbar-toggler" id="navbar-toggler" type="button" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id="mobile-menu" class="collapse navbar-collapse">
            <!-- Search form and other menu items -->
            <form class="d-flex mx-auto flex-grow-1 flex-md-nowrap" action="{{ route('photos.search') }}" method="GET" style="max-width: 500px;">
                <input class="form-control me-2" type="search" name="query" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-primary" type="submit">Cari</button>
            </form>

            <ul class="navbar-nav ms-auto">
                @if(Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('albums.index') }}">Tambah Kegiatan</a>
                    </li>
                    <!--<li class="nav-item">
                        <a class="nav-link" href="{{ route('photos.create') }}">Upload</a>
                    </li>-->
                @endif
            </ul>

            <a href="{{ route('profile.index') }}" class="navbar-brand ms-3 d-flex align-items-center">
                <i class="fas fa-user fa-lg"></i>
            </a>
        </div>
    </div>
</nav>

<script>
    // Mobile menu toggle
    document.getElementById('navbar-toggler').addEventListener('click', () => {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('collapse');  // Use Bootstrap's collapse functionality
    });
</script>


<!-- Content area -->
<div class="container my-4">
    @yield('content')
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-ppQ4eRHmWgxWu+0q8uDZ9onhlTuB1h+sq+I2jrPtfCZBFjDOwvfIoOjF+XhhUSn3" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>
</html>
