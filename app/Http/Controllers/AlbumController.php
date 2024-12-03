<?php

namespace App\Http\Controllers;

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
        $query = $request->input('query');
        $tanggal = $request->input('tanggal');
        $hurufAwal = $request->input('huruf_awal');
        $sortBy = $request->input('sort_by', 'namaAlbum'); // Default sorting by name
        $sortOrder = $request->input('sort_order', 'asc'); // Default sorting order is ascending
    
        $albums = Album::where('userID', Auth::id());
    
        if ($query) {
            $albums->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('namaAlbum', 'like', "%$query%")
                            ->orWhere('deskripsi', 'like', "%$query%")
                            ->orWhere('lokasi', 'like', "%$query%");
            });
        }
    
        if ($tanggal) {
            $albums->whereDate('tanggalDibuat', $tanggal);
        }
    
        if ($hurufAwal) {
            $albums->where('namaAlbum', 'like', "$hurufAwal%");
        }
    
        // Apply sorting
        $albums->orderBy($sortBy, $sortOrder);
    
        $albums = $albums->paginate(10);
    
        return view('albums.index', compact('albums', 'sortBy', 'sortOrder'));
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
        'uraian' => 'required|string|max:255',
        'photos.*' => 'required|image|max:2048', // Validasi foto (jika ada)
        'judulFoto.*' => 'required|string|max:255', // Validasi judul foto (jika ada)
    ]);

    // Membuat album baru
    $album = Album::create([
        'namaAlbum' => $request->namaAlbum,
        'deskripsi' => $request->deskripsi,
        'lokasi' => $request->lokasi,
        'waktu' => $request->waktu,
        'uraian' => $request->uraian,
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
            'uraian' => 'required|string|max:255',
        ]);
        $album->update([
            'namaAlbum' => $request->namaAlbum,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'tanggalDibuat' => $request->tanggalDibuat,
            'waktu' => $request->waktu,
            'uraian' => $request->uraian,
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
