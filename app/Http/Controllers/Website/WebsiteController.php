<?php

namespace App\Http\Controllers\Website;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Session;

class WebsiteController extends Controller
{
    public function index(){
        $categories = Category::latest()->take(10)->get();
        $posts = Post::latest()->Publish()->take(6)->get();
        return view('frontend/home',compact('categories','posts'));
    }

    public function subscriber(Request $request){

        $validated = $request->validate([
            'email' => 'required|string|email|unique:subscribers|max:255',
        ],[
            'email.required' => 'Plz enter your valid email address',
        ]
    );

        $subscriber = new Subscriber ();
        $subscriber->email = $request->email;
        $create = $subscriber->save();
        if($create){
            Session::flash('success','value');
            return redirect()->back();
        }
        else{
            Session::flash('error','value');
            return redirect()->back();
        } 
    }

    public function search(Request $request){
        $query = $request->search;
        $posts = Post::where('title', 'LIKE', "%$query%")->latest()->publish()->get();
        return view('frontend.search',compact('query','posts'));
    }
}
