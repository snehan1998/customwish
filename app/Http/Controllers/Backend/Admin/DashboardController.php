<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\CareerForm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index(Request $request){
        return view('admin.dashboard');
    }

    public function changepassword(Request $request)
    {
         $this->validate($request, [
            'password' => 'required|string',
            ]);
            $checkPassword = User::where('id',Auth::user()->id)->first();
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->password);
            $user->save();

            return back()->with('flash_success', 'Profile Password Updated');
    }

    public function applylist(Request $request)
    {
        $data=CareerForm::orderBy('id','DESC')->get();
        return view('admin.careerlist',compact('data'));
    }

    public function applydestroy(Request $request,$id)
    {
        $con = CareerForm::where('id',$id)->delete();
        return back()->with('flash_success','Deleted Successfully');
    }

    public function leavecommentlist(Request $request)
    {
        $data=CareerForm::orderBy('id','DESC')->get();
        return view('admin.leavecomment',compact('data'));
    }

    public function leavecommentdestroy(Request $request,$id)
    {
        $con = CareerForm::where('id',$id)->delete();
        return back()->with('flash_success','Deleted Successfully');
    }

}
