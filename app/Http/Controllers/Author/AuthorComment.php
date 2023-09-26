<?php

namespace App\Http\Controllers\Author;


use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class AuthorComment extends Controller
{
    public function index(){
        $posts = Auth::user()->posts;
        return view('backend.author.comment.index',compact('posts'));
    }

    public function destroy($id){
        $comment = Comment::findOrFail($id);

        if($comment->post->user->id == Auth::id()){
            $comment->delete();
            Toastr::success('Comment Has Been Deleted', 'Success');
            return redirect()->back();
        }
        else{
            Toastr::error('Access Denied', 'Error');
            return redirect()->back();
        }

    }
}
