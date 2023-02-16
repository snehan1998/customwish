<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderList;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserDashboardController extends Controller
{
    public function index()
    {
        return view('user.dashboard');
    }

    public function changepassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required|string',
            'password' => 'required|string',
            ]);
        $hashedPassword = $request->old_password;
        $checkPassword = User::where('id',Auth::user()->id)->first();
        if (Hash::check($hashedPassword,$checkPassword->password)) {
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->password);
            $user->save();
            $user = UserProfile::where('user_id',Auth::user()->id)->update([
                'password' => $request->password,
            ]);
            return back()->with('flash_success', 'Profile Password Updated');
        }
        else{
            return back()->with('flash_error', 'Old Password is incorrect');
        }
    }

    public function profiledetails(Request $request)
    {
        $user = UserProfile::where('user_id',Auth::user()->id)->first();
        return view('user.profiledetails',compact('user'));
    }

    public function updateuserpro(Request $request)
    {
        $id=Auth::user()->id;
        $data = Userprofile::where('user_id',$id)
        ->update([
            'name' => $request->name,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'country' => $request->country,
            'state'=>$request->state,
            'city'=>$request->city,
            'pincode'=>$request->pincode,
        ]);

            $user = User::find($id);
            $user->name = $request->name;
            $user->save();

        return back()->with('flash_success', ' Profile Updated successfully');
    }

    public function orders(){

        $orders = Order::where('user_id',Auth::user()->id)->orderBy('id','DESC')->paginate(10);
        return view('user.orders',compact('orders'));

    }
    public function orderDetail($order_id)
    {
        $order = Order::where('order_id',$order_id)->first();
        if ($order) {
            $orderitems = OrderList::where('order_id',$order_id)->get();
            return view('user.invoice',compact('order','orderitems'));
        }
    }
    public function print($order_id)
    {
        $order = Order::where('order_id', $order_id)->first();
        if ($order) {
            $orderitems = OrderList::where('order_id', $order_id)->get();
            return view('user.print', compact('order', 'orderitems'));
        }
    }
}
