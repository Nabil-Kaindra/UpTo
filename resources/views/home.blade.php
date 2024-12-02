@extends('layouts.app')
@section('content')

<div class="container mt-5">
    <!-- Kontainer untuk daftar album -->
    <div id="album-container">
        @if($albums->isEmpty())
            <div class="alert alert-warning text-center">
                Dokumentasi kegiatan tidak tersedia.
            </div>
        @else
            <div class="row" id="album-list">
                @foreach($albums as $album)
                <div class="col-6 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <a href="{{ route('albums.photos', $album->albumID) }}" class="text-decoration-none text-dark">
                        <div class="card fixed-card h-50 shadow-sm">
                            @if($album->photos->isNotEmpty())
                                <img src="{{ asset('storage/' . $album->photos->first()->lokasiFile) }}" 
                                    alt="{{ $album->judulAlbum }}" 
                                    class="card-img-top fixed-image" style="object-fit: cover; height: 200px;">
                            @else
                                <img src="{{ asset('images/default-album.png') }}"
                                    alt="No image available"
                                    class="card-img-top fixed-image" style="object-fit: cover; height: 200px;">
                            @endif
                            <div class="card-body text-center">
                                <h5 class="card-title font-weight-bold">{{ $album->namaAlbum }}</h5>
                                <p class="card-text text-muted">{{ Str::limit($album->deskripsi, 70) }}</p>
                                <p><small class="text-muted">
                                    {{ $album->tanggalDibuat ? \Carbon\Carbon::parse
                                    ($album->tanggalDibuat)->format('d M Y') : 'Tanggal tidak tersedia' }}
                                </small></p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
let currentPage = 1; // Halaman awal
let lastPage = {{ $albums->lastPage() }}; // Total halaman

// Simpan state awal saat halaman pertama kali dimuat
window.history.replaceState({ page: currentPage }, '', window.location.href);

// Tangani scroll untuk memuat halaman berikutnya
$(window).scroll(function() {
    if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
        if (currentPage < lastPage) {
            if (confirm("Apakah Anda yakin ingin pindah ke halaman berikutnya?")) {
                currentPage++;
                loadNewPage(currentPage);
            }
        }
    }
});

// Tangani tombol back/forward pada browser
window.addEventListener('popstate', function(event) {
    if (event.state && typeof event.state.page !== 'undefined') {
        const page = event.state.page;

        // Reload konten hanya jika state mengarah ke home?page=X
        if (window.location.href.includes("home?page=")) {
            loadPageFromState(page);
        } else {
            // Jika tidak, biarkan navigasi normal berjalan
            window.location.href = window.location.href;
        }
    }
});

// Fungsi untuk memuat halaman baru
function loadNewPage(page) {
    $('#loader').show();

    $.ajax({
        url: "{{ route('home') }}" + "?page=" + page,
        type: "GET",
        success: function(data) {
            // Ganti seluruh konten album dengan halaman baru
            $('#album-container').html($(data).find('#album-container').html());

            // Simpan state halaman ke history
            const newUrl = "{{ route('home') }}" + "?page=" + page;
            window.history.pushState({ page: page }, '', newUrl);

            $('#loader').hide();
            window.scrollTo({ top: 0, behavior: 'smooth' }); // Scroll ke atas
        },
        error: function(xhr, status, error) {
            $('#loader').hide();
            console.error("AJAX error:", xhr.responseText);
            alert('Terjadi kesalahan saat memuat data.');
        }
    });
}

// Fungsi untuk memuat halaman berdasarkan state
function loadPageFromState(page) {
    $('#loader').show();

    $.ajax({
        url: "{{ route('home') }}" + "?page=" + page,
        type: "GET",
        success: function(data) {
            // Ganti seluruh konten album dengan halaman yang sesuai
            $('#album-container').html($(data).find('#album-container').html());
            $('#loader').hide();

            // Gulirkan layar ke bagian atas
            window.scrollTo({ top: 0, behavior: 'smooth' });
        },
        error: function(xhr, status, error) {
            $('#loader').hide();
            console.error("AJAX error:", xhr.responseText);
            alert('Terjadi kesalahan saat memuat data.');
        }
    });
}
</script>




@endsection