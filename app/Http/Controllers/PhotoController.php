<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Photo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class PhotoController extends Controller {

    public function index(Album $album) {
        $photos = Photo::where('albumID', $album->albumID)->paginate(4);
        return view('photos.index', compact('album', 'photos'));    
    }

    public function create() {
        $albums = Album::where('userID', auth()->id())->get();
        return view('photos.create', compact('albums'));
    }

public function store(Request $request)
{
    $request->validate([
        'photos.*' => 'required|image|max:2048',
        'judulFoto.*' => 'required|string|max:255',
        'albumID' => 'required|exists:albums,albumID',
    ]);

    $files = $request->file('photos');
    $judulFotos = $request->judulFoto;

    foreach ($files as $index => $photo) {
        $path = $photo->store('photos', 'public');

        Photo::create([
            'userID' => auth()->id(),
            'lokasiFile' => $path,
            'judulFoto' => $judulFotos[$index],
            'tanggalUnggah' => now(),
            'albumID' => $request->albumID,
        ]);
    }

    return redirect()->route('albums.photos', ['album' => $request->albumID])
        ->with('success', 'Semua foto berhasil diunggah!');
}


    public function show(Photo $photo) {

    }

    public function edit(Photo $photo) {
        if ($photo->userID !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        $albums = Album::where('userID', Auth::id())->get();
        return view('photos.edit', compact('photo', 'albums'));
    }

    public function update(Request $request, Photo $photo) {

        if ($photo->userID !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'judulFoto' => 'required|string|max:255',
        ]);

        if ($request->hasFile('photo')) {
            $request->validate(['photo' =>'image|max:2048']);
            Storage::delete($photo->lokasiFile);
            $path = $request->file('photo')->store('photos', 'public');
            $photo->lokasiFile = $path;
        }

        $photo->judulFoto = $request->judulFoto;
        $photo->save();

        return redirect()->route('albums.photos', $photo->albumID);
    }

    public function destroy(Photo $photo) {

        if ($photo->userID !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        Storage::delete($photo->lokasiFile);
        $photo->delete();

        return redirect()->route('albums.photos', $photo->albumID);
    }

    public function search(Request $request) {
        $query = $request->input('query');

        // Validate the query
        $request->validate([
            'query' => 'required|string|max:255',
        ]);

        // Store the query in the session for later use
        Session::flash('search_query', $query);

        return redirect()->route('home');
    }



}