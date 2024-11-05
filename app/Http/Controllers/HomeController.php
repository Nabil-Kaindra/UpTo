<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller {

    public function index(Request $request) { 
        $searchQuery = $request->session()->get('search_query');

        if ($searchQuery) {
            $photos = Photo::where('judulFoto', 'LIKE', '%' . $searchQuery . '%')
                ->orWhere('deskripsiFoto', 'LIKE', '%' . $searchQuery . '%')
                ->paginate(8);
            
            $request->session()->forget('search_query');
        } else {
            $photos = Photo::paginate(8);
        }

        return view('home', compact('photos'));
    }
}
