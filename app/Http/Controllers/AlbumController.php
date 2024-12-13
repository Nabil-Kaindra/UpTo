<?php

namespace App\Http\Controllers;

use Spatie\ImageOptimizer\OptimizerChainFactory;
use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Photo; // Import model Photo
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->query('query');
        $sortBy = $request->query('sort_by');
    
        $albums = Album::query()
            ->when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('namaAlbum', 'like', "%$query%")
                                    ->orWhere('deskripsi', 'like', "%$query%");
            })
            ->when($sortBy, function ($queryBuilder) use ($sortBy) {
                switch ($sortBy) {
                    case 'date_asc':
                        return $queryBuilder->orderBy('tanggalDibuat', 'asc');
                    case 'date_desc':
                        return $queryBuilder->orderBy('tanggalDibuat', 'desc');
                    case 'title_asc':
                        return $queryBuilder->orderBy('namaAlbum', 'asc');
                    case 'title_desc':
                        return $queryBuilder->orderBy('namaAlbum', 'desc');
                }
            })
            ->paginate(16);
    
        return view('albums.index', compact('albums'));
    }
    
    
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('albums.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validasi input album
    $request->validate([
        'namaAlbum' => 'required|string|max:255',
        'deskripsi' => 'required|string|max:255',
        'lokasi' => 'required|string|max:255',
        'tanggalDibuat' => 'required|date',
        'waktu' => 'required|date_format:H:i',
        'photos.*' => 'required|image|max:10240', // Validasi foto (jika ada)
        'judulFoto.*' => 'required|string|max:255', // Validasi judul foto (jika ada)
    ]);

    // Membuat album baru
    $album = Album::create([
        'namaAlbum' => $request->namaAlbum,
        'deskripsi' => $request->deskripsi,
        'lokasi' => $request->lokasi,
        'waktu' => $request->waktu,
        'tanggalDibuat' => $request->tanggalDibuat,
        'userID' => Auth::id(),
    ]);

    // Jika ada foto yang diunggah, proses foto-foto tersebut
    if ($request->hasFile('photos')) {
        $files = $request->file('photos');
        $judulFotos = $request->judulFoto;

        // Loop untuk setiap foto yang diunggah
        foreach ($files as $index => $photo) {
            // Menyimpan foto dan mendapatkan path
            $path = $photo->store('photos', 'public');

            // Optimize the image
            $optimizerChain = OptimizerChainFactory::create();
            $optimizerChain->optimize(storage_path("app/public/{$path}"));

            // Menambahkan foto ke album
            Photo::create([
                'userID' => auth()->id(), // Menyimpan userID
                'lokasiFile' => $path, // Path file yang disimpan
                'judulFoto' => $judulFotos[$index], // Judul foto dari input
                'tanggalUnggah' => now(), // Menyimpan tanggal unggah
                'albumID' => $album->albumID, // Menyimpan albumID dari album yang baru dibuat
            ]);
        }
    }

    // Redirect ke halaman album yang baru dibuat
    return redirect()->route('albums.index', ['album' => $album->albumID]);
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        if ($album->userID !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        return view('albums.edit', compact('album'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album)
    {
        if ($album->userID !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    
        $request->validate([
            'namaAlbum' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:150',
            'lokasi' => 'required|string|max:255',
        ]);
        $album->update([
            'namaAlbum' => $request->namaAlbum,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'tanggalDibuat' => $request->tanggalDibuat,
            'waktu' => $request->waktu,
        ]); 
            return redirect()->route('albums.index');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        if ($album->userID !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        $album->delete();
        return redirect()->route('albums.index');
    }
}
