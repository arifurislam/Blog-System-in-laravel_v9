<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontendPostController extends Controller
{
    public function index(){
        $posts = Post::latest()->Publish()->paginate(3);
        return view('frontend.posts',compact('posts'));
    }

    public function show($slug){
        $post = Post::where('slug',$slug)->first();
        $key = 'blog_'.$post->id;
        if(!Session::has($key)){
            $post->increment('view_count');
            Session::put($key,1);
        }
        // $randomposts = Post::all()->random(3);
        $randomposts = Post::Publish()->take(3)->inRandomOrder()->get();
        return view('frontend/details',compact('post','randomposts'));
    }

    public function relatedTOCategory($slug){
        $category = Category::where('slug',$slug)->first();
        $posts = $category->posts()->Publish()->get();
        return view('frontend.category',compact('category','posts'));
    }

    public function relatedTOTag($slug){
        $tag = Tag::where('slug',$slug)->first();
        $posts = $tag->posts()->Publish()->get();
        return view('frontend.tag',compact('tag','posts'));
    }
}
