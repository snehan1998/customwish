<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use App\Models\Address;
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
            'gender'=>$request->gender,
            'dob'=>$request->dob,
            'anniversary' => $request->anniversary,
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

    public function address(Request $request)
    {
        $data = Address::where('user_id',Auth::user()->id)->get();
        return view('user.address',compact('data'));
    }
    public function addaddress(Request $request)
    {
        $data = new Address();
        $data->user_id = Auth::user()->id;
        $data->name = $request->name;
        $data->email = $request->email;;
        $data->phone = $request->phone;
        $data->country = $request->country;
        $data->state = $request->state;
        $data->city = $request->city;
        $data->address = $request->address;
        $data->pincode = $request->pincode;
        $data->address_type = $request->address_type;
        if($request->default_address ==''){
            $data->default_address = '0';
        }else if($request->default_address == 'on'){
            $data->default_address = '1';
        }
        $data->save();
        if($data->default_address == 1){
            $check = Address::whereNot('id',$data->id)->update(['default_address'=>'0']);
        }
        return back()->with('flash_success', 'Added Successfully');
    }

    public function editaddress(Request $request,$id)
    {
        $data = Address::where('id',$id)->first();
        return view('user.editaddress',compact('data'));
    }
    public function updateaddress(Request $request,$id)
    {
        $data = Address::find($id);
        $data->user_id = Auth::user()->id;
        $data->name = $request->name;
        $data->email = $request->email;;
        $data->phone = $request->phone;
        $data->country = $request->country;
        $data->state = $request->state;
        $data->city = $request->city;
        $data->address = $request->address;
        $data->pincode = $request->pincode;
        $data->address_type = $request->address_type;
        if($request->default_address ==''){
            $data->default_address = '0';
        }else if($request->default_address == 'on'){
            $data->default_address = '1';
        }
        $data->save();
        if($data->default_address == 1){
            $check = Address::whereNot('id',$data->id)->update(['default_address'=>'0']);
        }
        return back()->with('flash_success', 'Updated Successfully');
    }
    public function deleteuseraddress(Request $request,$id)
    {
        $con = Address::where('id',$id)->delete();
        return back()->with('flash_success','Deleted Successfully');
    }

}
