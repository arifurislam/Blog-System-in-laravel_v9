<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    public function index(){
        $user = Auth::user();
        $posts = $user->posts;
        $popular_posts = $user->posts()
            ->withCount('comments')
            ->withCount('favorite_to_users')
            ->orderBy('view_count','DESC')
            ->orderBy('favorite_to_users_count','DESC')
            ->take(5)->get();
        $pending_posts = $posts->where('status',0)->count();
        $total_view = $posts->sum('view_count');
        return view('backend.author.home.index',compact('posts','popular_posts','pending_posts','total_view'));
    }
}
