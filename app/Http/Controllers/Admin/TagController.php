<?php

namespace App\Http\Controllers\Admin;

use App\Models\tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class TagController extends Controller
{

    public function index()
    {
        $tags = Tag::latest()->get();
        return view('backend.admin.tag.index',compact('tags'));
    }

    public function create()
    {
        return view('backend.admin.tag.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:tags|max:60',
        ],[
            'name.required' => 'Enter your valid tag name',
        ]);

        $tag = new Tag ();
        $tag->name = $request->name;
        $tag->slug = Str::slug($request->name);
        $create = $tag->save();
        
        if($create){
            Toastr::success('New tag has been created', 'Success');
            return redirect()->back();
        }
        else{
            return redirect()->back();
        }

    }

    // public function show(tag $tag)
    // {
        
    // }

    public function edit(tag $tag)
    {
        return view('backend.admin.tag.edit',compact('tag'));
    }

    public function update(Request $request, tag $tag)
    {
        $tag->name = $request->name;
        $tag->slug = Str::slug($request->name);
        $update = $tag->save();
        
        if($update){
            Toastr::success('Tag has been Updated', 'Success');
            return redirect()->back();
        }
        else{
            return redirect()->back();
        }
    }

    public function destroy(tag $tag)
    {
        $delete = $tag->delete();
        if($delete){
            Toastr::success('Tag has been Deleted', 'Success');
        return redirect()->back();
        }
    }
}
