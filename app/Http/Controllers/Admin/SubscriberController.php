<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class SubscriberController extends Controller
{
    public function index(){
        $subscribers = Subscriber::latest()->get();
        return view('backend.admin.subscriber.index',compact('subscribers'));
    }

    public function delete($id){
        $subscriber = Subscriber::find($id);
        $delete = $subscriber->delete();
        if($delete){
            Toastr::success('Subscriber Has Been Deleted', 'Success');
            return redirect()->back();
        }
        else{
            Toastr::error('Something went wrong !!!', 'Error');
            return redirect()->back();
        }
    }
}
