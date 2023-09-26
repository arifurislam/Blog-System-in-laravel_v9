<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FavoriteAuthorController extends Controller
{
    public function index(){
        $favoritePost = Auth::user()->favorite_to_posts;
        return view('backend.author.favorite.index',compact('favoritePost'));
    }
}
