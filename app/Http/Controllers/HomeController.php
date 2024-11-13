<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller {

    public function index(Request $request) { 
        $searchQuery = $request->session()->get('search_query');
        // Mengambil data album beserta satu foto dari setiap album
        $albums = Album::with(['photos' => function($query) {
            $query->limit(1);
        }])->paginate(12); // Mengambil 12 album per halaman
        if ($searchQuery) {
            $photos = Photo::where('judulFoto', 'LIKE', '%' . $searchQuery . '%')
                ->orWhere('deskripsiFoto', 'LIKE', '%' . $searchQuery . '%')
                ->paginate(8);
            
            $request->session()->forget('search_query');
        } else {
            $photos = Photo::paginate(16);
        }

        return view('home', compact('photos', 'albums'));
    }
}
