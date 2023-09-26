<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class AdminComment extends Controller
{
    public function index(){
        $comments = Comment::latest()->get();
        return view('backend.admin.comment.index',compact('comments'));
    }

    public function destroy($id){
        $comment = Comment::findOrFail($id);
        $delete = $comment->delete();
        if($delete){
            Toastr::success('Comment Has Been Deleted', 'Success');
            return redirect()->back();
        }
    }
}
