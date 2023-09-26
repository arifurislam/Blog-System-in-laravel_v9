<?php

namespace App\Http\Controllers\Author;

use Image;
use Storage;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingAuthorController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
    }

    public function edit(){
        return view('backend.author.settings.create');
    }

    public function update(Request $request){
        $validated = $request->validate([
            'name'     => 'required|max:255|string',
            'email'    => 'required|email|string|max:255',
        ]);

        $user = User::findOrFail(Auth::id());
        
        $slug = Str::slug($request->name);
        if($request->hasFile('profile')){
            $image1 = $request->file('profile');
            $imageName = $slug  .'-'.  Carbon::now()->toDateString(). uniqid() . '.' . $image1->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('profile'))
            {
                Storage::disk('public')->makeDirectory('profile');
            }
            
            // delete old image
            if(Storage::disk('public')->exists('profile/'.$user->image))
            {
                Storage::disk('public')->delete('profile/'.$user->image);
            }
            Image::make($image1)->resize(200, 200)->save(base_path('public/storage/profile/'.$imageName));
        }
        else{
            $imageName = $user->image;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->image = $imageName;
        $user->about = $request->about;
        $update = $user->save();
        if($update){
            Toastr::success('Profile Infos Has Been Updated', 'Success');
            return redirect()->back();
        }
        else{
            return redirect()->back();
        } 

    }

    public function updatePassword(Request $request){

        $validated = $request->validate([
            'oldPassword'     => 'required|max:255|string',
            'password'    => 'required|confirmed',
            'password_confirmation'  => 'required',
        ]);

        $hasedPassword = Auth::user()->password;
        if(Hash::check($request->oldPassword,$hasedPassword)){

            if(!Hash::check($request->password,$hasedPassword)){
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                Toastr::success('Profile Infos Has Been Updated', 'Success');
                Auth::logout();
                return redirect()->back();
                // return redirect('login');
            }
            else{
                Toastr::error('Old password and new password can not be same', 'Error');
                return redirect()->back();
            }

        }
        else{
            Toastr::error('your old password is wrong', 'Error');
            return redirect()->back();
        }
    }
}
