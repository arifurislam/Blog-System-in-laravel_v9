<?php

namespace App\Http\Controllers\Admin;

use Image;
use Storage;
use Notification;
use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use App\Models\Subscriber;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Jobs\ProcessSubscriber;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class Postcontroller extends Controller
{

    public function index()
    {
        $posts = Post::latest()->get();
        return view('backend.admin.post.index',compact('posts'));
    }

    public function create()
    {
        $categories = Category::latest()->get();
        $tags = Tag::latest()->get();
        return view('backend.admin.post.create',compact('categories','tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|unique:posts|max:255',
            'media' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required|string',
        ],[
            'title.required' => 'Enter a valid post title',
            'media.required' => 'Select Category Image',
        ]);

        $slug = Str::slug($request->title);
        if($request->hasFile('media')){
            $image1 = $request->file('media');
            $imageName = $slug  .'-'.  Carbon::now()->toDateString(). uniqid() . '.' . $image1->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('post'))
            {
                Storage::disk('public')->makeDirectory('post');
            }

            Image::make($image1)->resize(270, 270)->save(base_path('public/storage/post/'.$imageName));
        }

        $post = new Post ();
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->image = $imageName;
        $post->body = $request->body;
        $post->view_count = 0;
        $post->status = 1;
        $create = $post->save();
        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);
        $subscribers = Subscriber::all();
        foreach($subscribers as $subscriber){
            Mail::to($subscriber->email)->send(new Subscriber($post));
        }
        if($create){
            Toastr::success('New Post Has Been created', 'Success');
            return redirect()->back();
        }
        else{
            return redirect()->back();
        } 
    }

    public function show(Post $post)
    {
        $categories = Category::latest()->get();
        $tags = Tag::latest()->get();
        return view('backend.admin.post.show',compact('post','categories','tags'));
    }

    public function edit(Post $post)
    {
        $categories = Category::latest()->get();
        $tags = Tag::latest()->get();
        return view('backend.admin.post.edit',compact('categories','tags','post'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:posts,title,'.$post->id,
            'media' => 'image|mimes:jpg,png,jpeg,gif,svg',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required|string',
        ],[
            'media.required' => 'Select Post Image',
        ]);

        $slug = Str::slug($request->title);
        if($request->hasFile('media')){
            $image1 = $request->file('media');
            $imageName = $slug  .'-'.  Carbon::now()->toDateString(). uniqid() . '.' . $image1->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('post'))
            {
                Storage::disk('public')->makeDirectory('post');
            }
             // delete old image
             if(Storage::disk('public')->exists('post/'.$post->image))
             {
                 Storage::disk('public')->delete('post/'.$post->image);
             }

            Image::make($image1)->resize(270, 270)->save(base_path('public/storage/post/'.$imageName));
        }
        else{
            $imageName = $post->image;
        }

        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->image = $imageName;
        $post->body = $request->body;
        $post->view_count = 0;
        $post->status = 1;
        $update = $post->save();
        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);
        if($update){
            Toastr::success('Post Has Been Updated', 'Success');
            return redirect()->back();
        }
        else{
            return redirect()->back();
        } 
    }

    public function destroy(Post $post)
    {
        // delete old image
        if(Storage::disk('public')->exists('post/'.$post->image))
        {
            Storage::disk('public')->delete('post/'.$post->image);
        }
        $delete = $post->delete();
        if($delete){
            Toastr::success('Post Has Been Deleted', 'Success');
            return redirect()->back();
        }
    }

    public function pendingPost(){

        $posts = Post::Pending()->get();
        return view('backend.admin.post.pending.index',compact('posts'));
    }

    public function approvedPost($id){
        $post = Post::find($id);
        $post->status = 1;
        $update = $post->save();

        // Queue and mail
        
        // dispatch(new ProcessSubscriber($post));

        if($update){
            Toastr::success('Post Has Been Approved', 'Success');
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }
}
