<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\GiftCardBuy;
use App\Models\Order;
use App\Models\OrderList;
use App\Models\StoreProductCartImage;
use App\Models\StoreProductCartLogo;
use Illuminate\Http\Request;
use Razorpay\Api\Api;

class OrderController extends Controller
{
    private $razorpayId = "rzp_test_3ebWbgEz4ZuH41";
    private $razorpayKey = "ScUQEBjEc2qZwmIx6tP1wbCm";

    public function orders(Request $request)
    {
    	$orders = Order::orderBy('id','desc')->get();
    	return view('admin.orders.index',compact('orders'));
    }

    public function changeOrderStatus(Request $request)
    {
        $or = Order::where('order_id',$request->orderr_id)->first();
        $ord = OrderList::where('order_id',$request->orderr_id)->first();
        	//dd($or->payment_id);
        if($request->order_status ==  "Refund"){

            //$api = new Api($this->razorpayId, $this->razorpayKey);
           // dd($ord->price);
          $pri= $ord->price * 100;

          //dd($pri);
//            $da =  $api->payment->fetch($or->payment_id);
          //  dd($da);
            //dd( $da[amount]);
  //          $api->payment->fetch($or->payment_id)->refund(array("amount"=> $pri, "speed"=>"normal"));

        }
    	 $request->order_id;
    	 $order = OrderList::where('id',$request->order_id)->first();
    	if ($order) {
    		$order->status = $request->order_status;
    		$order->save();
    		return back()->with('flash_success', 'Status updated successfully');
    	}
    }

    public function orderDetail($order_id)
    {
        $order = Order::where('order_id',$order_id)->first();
        if ($order) {
            $orderitems = OrderList::where('order_id',$order_id)->get();
            return view('admin.orders.order-details',compact('order','orderitems'));
        }
    }

    public function giftpurchased(Request $request)
    {
        $data = GiftCardBuy::orderBy('id','DESC')->get();
        return view('admin.giftvocherpurchased',compact('data'));
    }
    public function deletegiftpurchased(Request $request,$id)
    {
        $dataa = GiftCardBuy::find($id);
        $dataa->delete();
        return back()->with('flash_success', 'Deleted Successfully!');
    }

    public function destroy($id)
    {
        $data = Order::find($id);
        $datt = OrderList::where('order_id',$data->order_id)->delete();
      //  $datt = StoreProductCartLogo::where('product_id',$data->id)->delete();
       // $datt = StoreProductCartImage::where('product_id',$data->id)->delete();
       // @unlink(public_path('uploads/images/'.$data->images));
        $data->delete();
        return back()->with('flash_success', ' Deleted  Successfully!');
    }
}
