<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthorInfoController extends Controller
{
    public function index(){
        $authors = User::Authors()
            ->withCount('posts')
            ->withCount('comments')
            ->withCount('favorite_to_posts')
            ->get();
        return view('backend.admin.author.index',compact('authors'));
    }
    
    public function trash(){
        
    }
}
