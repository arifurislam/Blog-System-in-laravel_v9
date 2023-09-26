<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FavoriteAdminController extends Controller
{
    public function index(){
        $favoritePost = Auth::user()->favorite_to_posts;
        return view('backend.admin.favorite.index',compact('favoritePost'));
    }
}
