<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller {

    public function index(Request $request) { 
        $searchQuery = $request->session()->get('search_query');
        
        if ($searchQuery) {
            $albums = Album::with(['photos' => function($query) {
                $query->limit(1);
            }])
            ->where('namaAlbum', 'LIKE', '%' . $searchQuery . '%')
            ->orWhere('deskripsi', 'LIKE', '%' . $searchQuery . '%')
            ->paginate(12);

            $request->session()->forget('search_query');
        } else {
            $albums = Album::with(['photos' => function($query) {
                $query->limit(1);
            }])->paginate(12); 
        }

        $photos = Photo::paginate(16);

        return view('home', compact('photos', 'albums'));
    }
}
