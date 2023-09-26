<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
        $posts = Post::all();
        $popular_posts = Post::withCount('comments')
            ->withCount('favorite_to_users')
            ->orderBy('view_count','DESC')
            ->orderBy('favorite_to_users_count','DESC')
            ->take(5)->get();

        $pending_posts = Post::Pending()->count(); 
        $total_view = Post::sum('view_count');
        $author_count = User::Authors()->count();
        $todays_author = User::Authors()
                            ->whereDate('created_at', Carbon::today())->count();
        $active_authors = User::Authors()
                            ->withCount('posts')
                            ->withCount('comments')
                            ->withCount('favorite_to_posts')
                            ->orderBy('posts_count','DESC')
                            ->orderBy('comments_count','DESC')
                            ->orderBy('favorite_to_posts_count','DESC')
                            ->take(5)->get();
        $category_count = Category::all()->count();             
        return view('backend/admin.home.index',compact('posts','popular_posts','pending_posts','total_view',
            'author_count','todays_author','active_authors','category_count'
    ));
    }
}
