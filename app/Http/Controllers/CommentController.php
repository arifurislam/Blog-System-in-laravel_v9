<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use Brian2694\Toastr\Facades\Toastr;

class CommentController extends Controller
{
    public function store(Request $request, $post){

        $validated = $request->validate([
            'comment' => 'required|string',
        ]);

        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->post_id = $post;
        $comment->comment = $request->comment;
        $create = $comment->save();
        if($create){
            Toastr::success('Successfully stored your comment', 'Success');
            return redirect()->back();
        }
        else{
            return redirect()->back();
        }

    }
}
