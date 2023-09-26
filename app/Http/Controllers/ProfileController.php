<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index($username){
        $author = User::where('username',$username)->first();
        $posts = $author->posts()->Publish()->get();
        return view('frontend.profile',compact('author','posts'));
    }
}
