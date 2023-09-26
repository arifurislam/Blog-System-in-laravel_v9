<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
    }

    public function add($post){
        $user = Auth::user();
        $isFavorite = $user->favorite_to_posts()->where('post_id',$post)->count();
        if($isFavorite == 0){
            $user->favorite_to_posts()->attach($post);
            Toastr::success('Successfully Added To Favorite List ', 'Success');
            return redirect()->back();
        }
        else{
            $user->favorite_to_posts()->detach($post);
            Toastr::success('Successfully Removed From Favorite List ', 'Success');
            return redirect()->back();
        }
    }
}
