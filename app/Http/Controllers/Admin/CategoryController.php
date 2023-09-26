<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Storage;
use Image;


class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::latest()->get();
        return view('backend.admin.category.index',compact('categories'));
    }

    public function create()
    {
        return view('backend.admin.category.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:categories|max:60',
            'media' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
        ],[
            'name.required' => 'Enter your valid tag name',
            'media.required' => 'Select Category Image',
        ]);

        $slug = Str::slug($request->name);
        if($request->hasFile('media')){
            $image1 = $request->file('media');
            $imageName = $slug  .'-'.  Carbon::now()->toDateString(). uniqid() . '.' . $image1->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('category'))
            {
                Storage::disk('public')->makeDirectory('category');
            }

            Image::make($image1)->resize(270, 270)->save(base_path('public/storage/category/'.$imageName));
        }

        $category = new Category ();
        $category->name = $request->name;
        $category->slug = $slug;
        $category->image = $imageName;
        $create = $category->save();
        if($create){
            Toastr::success('New Category Has Been created', 'Success');
            return redirect()->back();
        }
        else{
            return redirect()->back();
        }
    }

    // public function show(Category $category)
    // {
        
    // }
    public function edit(Category $category)
    {
        return view('backend.admin.category.edit',compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:60',
            'media' => 'image|mimes:jpg,png,jpeg,gif,svg',
        ],[
            'name.required' => 'Enter your valid tag name',
        ]);

        $slug = Str::slug($request->name);
        if($request->hasFile('media')){
            $image1 = $request->file('media');
            $imageName = $slug  .'-'.  Carbon::now()->toDateString(). uniqid() . '.' . $image1->getClientOriginalExtension();

           
            if(!Storage::disk('public')->exists('category'))
            {
                Storage::disk('public')->makeDirectory('category');
            }
            // delete old image
            if(Storage::disk('public')->exists('category/'.$category->image))
            {
                Storage::disk('public')->delete('category/'.$category->image);
            }

            Image::make($image1)->resize(270, 270)->save(base_path('public/storage/category/'.$imageName));
        }
        else{
            $imageName = $category->image;
        }

        $category->name = $request->name;
        $category->slug = $slug;
        $category->image = $imageName;
        $update = $category->save();
        if($update){
            Toastr::success('Category Has Been Updated', 'Success');
            return redirect()->back();
        }
        else{
            return redirect()->back();
        }
    }

    public function destroy(Category $category)
    {
        // delete old image
        if(Storage::disk('public')->exists('category/'.$category->image))
        {
            Storage::disk('public')->delete('category/'.$category->image);
        }
        $delete = $category->delete();
        if($delete){
            Toastr::success('Category Has Been Deleted', 'Success');
            return redirect()->back();
        }
    }
}
