<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnyQuery;
use App\Models\CareerForm;
use App\Models\ContactForm;
use App\Models\CorporateEnquiry;
use App\Models\LeaveComment;
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
        $data=LeaveComment::orderBy('id','DESC')->get();
        return view('admin.leavecomment',compact('data'));
    }

    public function leavecommentdestroy(Request $request,$id)
    {
        $con = LeaveComment::where('id',$id)->delete();
        return back()->with('flash_success','Deleted Successfully');
    }

    public function changeStatus(Request $request)
    {
    	 $request->leave_id;
    	 $order = LeaveComment::where('id',$request->leave_id)->first();
    	if ($order) {
    		$order->status = $request->status;
    		$order->save();
    		return back()->with('flash_success', 'Status updated successfully');
    	}

    }

    public function contactlist(Request $request)
    {
        $data=ContactForm::orderBy('id','DESC')->get();
        return view('admin.contactformlist',compact('data'));
    }

    public function contactlistdestroy(Request $request,$id)
    {
        $con = ContactForm::where('id',$id)->delete();
        return back()->with('flash_success','Deleted Successfully');
    }

    public function corporatelist(Request $request)
    {
        $data=CorporateEnquiry::orderBy('id','DESC')->get();
        return view('admin.corporateformlist',compact('data'));
    }

    public function corporatedestroy(Request $request,$id)
    {
        $con = CorporateEnquiry::where('id',$id)->delete();
        return back()->with('flash_success','Deleted Successfully');
    }

    public function anyquerylist(Request $request)
    {
        $data=AnyQuery::orderBy('id','DESC')->get();
        return view('admin.anyquerylist',compact('data'));
    }

    public function anyquerylistdestroy(Request $request,$id)
    {
        $con = AnyQuery::where('id',$id)->delete();
        return back()->with('flash_success','Deleted Successfully');
    }

}
