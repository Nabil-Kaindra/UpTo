<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $albums = Album::where('userID' , Auth::id())->get();
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
        $request->validate([
            'namaAlbum' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'waktu' => 'required|date_format:H:i',
            'uraian' => 'required|string|max:255',
        ]);
        Album::create([
            'namaAlbum' => $request->namaAlbum,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'waktu' => $request->waktu,
            'uraian' => $request->uraian,
            'userID' => Auth::id(),
            'tanggalDibuat' => now(),
        ]);
        return redirect()->route('albums.index');

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
