<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    // Al tener el oinvoke el metodo se manda a lalmar automaticamente
    public function __invoke() {

        // Obtener a quienes seguimos 
        // pluck lo que hace es traer ciertos campos 
        $ids = auth()->user()->followings->pluck('id')->toArray();

        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);

        return view ('home', [
            'posts' => $posts
        ]);

        return view('home');
    }
}
