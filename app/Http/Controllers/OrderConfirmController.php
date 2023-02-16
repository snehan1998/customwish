<?php

namespace App\Http\Controllers;

use App\Models\AddSubVariation;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCart;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderConfirmController extends Controller
{
    public function confirmorder(Request $request)
    {
        $userid=Auth::user()->id;
        $coooup=Cart::where('user_id',$userid)->first();
        $generateorderid = $this->generateBarcodeNumber(5);
        $data=$request->all();
        $session_id=Session::get('sessionid');
        $orderdate = date('d-m-Y');
        $confirmorder = new  Order();
        $confirmorder->order_id = $generateorderid;
        $confirmorder->order_date = $orderdate;
        $confirmorder->user_id = Auth::user()->id;
        $confirmorder->order_price = $request->input('order_price');
        $confirmorder->payable_price= $request->input('payable_price');
        $confirmorder->coupon_id= $coooup->coupon_id;
        $confirmorder->coupon_amount= $request->input('coupon_amount');
        $confirmorder->delivery_charge= $request->input('delivery_charge');
        $confirmorder->payment_type = $request->payment;
        $confirmorder->firstname =$request->input('shipping_firstname');
        $confirmorder->lastname =$request->input('shipping_lastname');
        $confirmorder->phone =$request->input('shipping_phone');
        $confirmorder->email =$request->input('shipping_email');
        $confirmorder->country =$request->input('shipping_country');
        $confirmorder->state =$request->input('shipping_state');
        $confirmorder->city =$request->input('shipping_city');
        $confirmorder->address =$request->input('shipping_address1');
        $confirmorder->address2 =$request->input('shipping_address2');
        $confirmorder->pincode =$request->input('shipping_pincode');
        $confirmorder->address_type =$request->input('address_type');
        $confirmorder->save();

        $userpro = UserProfile::where('user_id',Auth::user()->id)
        ->update([
            'name' => $request->input('shipping_firstname'),
            'phone' => $request->input('shipping_phone'),
            'country' => $request->input('shipping_country'),
            'state' => $request->input('shipping_state'),
            'city' => $request->input('shipping_city'),
            'address' => $request->input('shipping_address1'),
            'pincode' => $request->input('shipping_pincode'),
        ]);

            $orderid=$confirmorder->id;
            $sellingprice=$confirmorder->order_price;
            $address=$confirmorder->address;
            $pincode=$confirmorder->pincode;
            $firstname=$confirmorder->firstname;
            $phone=$confirmorder->phone;
            $payable_price=$confirmorder->payable_price;
            $items=Cart::where('user_id',$userid)->get();
            foreach($items as $items) {
                $procart = ProductCart::where('id',$items->product_cart_id)->first();
                $pro=Product::where('status','Active')->where('id',$items->product_id)->first();
                if ($pro->is_variation == 0){
                    $price = $pro->price;
                    if ($items->quantity != "undefined") {
                        $quant = $pro->quantity - $items->quantity;
                    }else{
                        $quant = $pro->quantity;
                    }
                }else{
                    $productvariation = AddSubVariation::where('product_id',$items->product_id)->where('id',$items->variation_id)->first();
                    $price = $productvariation->price;
                    if ($items->quantity != "undefined") {
                        $quant = $productvariation->quantity - $items->quantity;
                    }else{
                        $quant = $productvariation->quantity;
                    }
                }
                $query=Product::where('status','Active')->where('id',$items->product_id)->update(['quantity'=>$quant]);
                $productstatus= Product::where('status','Active')->where('id',$items->product_id)->first();
                if($productstatus->quantity <= 0 && $productstatus->quantity != null){
                    $sql=Product::where('status','Active')->where('id',$items->product_id)
                    ->update(['stock_status'=>'outofstock']);
                }
              $product_id= $items->product_id;
              $subvariant_id= $items->variation_id;
              $delivery_charge= $items->delivery_charge;
              $product_price_id= $items->productprice_id;
              $quantity= $items->quantity;

              $input['order_id'] = $generateorderid;
              $input['user_id'] = Auth::user()->id;
              $input['product_id'] = $product_id;
              $input['variation_id'] = $subvariant_id;
              $input['mrp_price'] = $price;
              $input['selling_price'] = $price;
              $input['quantity'] = $quantity;
              $input['egg_type'] = $procart->egg_type;
              $input['product_images_id'] = $items->product_images_id;
              $input['product_logos_id'] = $items->product_logos_id;
              $input['addtext1'] = $procart->addtext1;
              $input['addtext2'] = $procart->addtext2;
              $input['cart_combo_id'] = $procart->cart_combo_id;
              $input['cart_charm_id'] = $procart->cart_charm_id;
              $input['charm_id'] = $procart->charm_id;
              $input['charm_price'] = $procart->charm_price;
              $input['printside'] = $procart->printside;
              $input['colortype'] = $procart->colortype;
              $input['location'] = $procart->location;
              $input['flowerss_type'] = $procart->flowerss_type;
              $input['datee'] = $procart->datee;
              $input['timee'] = $procart->timee;
              $input['pickup_type'] = $procart->pickup_type;
              $input['giftwrap'] = $procart->giftwrap;
              $input['giftwrap_price'] = $procart->giftwrap_price;
              $input['description'] = $procart->description;
              $input['comment'] = $procart->comment;
              DB::table('order_lists')->insert($input);
          }

        $deleteca=Cart::where('user_id',Auth::user()->id)->get();
        foreach($deleteca as $deleteca)
        {
            $deletepro =ProductCart::where('id',$deleteca->product_cart_id)->delete();
            $deleteca->delete();
        }

        return redirect('/orderconfirmed/'.$confirmorder->id);
    }

    public function confirmorderbuy(Request $request,$id)
    {
        $userid=Auth::user()->id;
        $coooup=Cart::where('user_id',$userid)->where('id',$id)->first();
        $generateorderid = $this->generateBarcodeNumber(5);
        $data=$request->all();
        $session_id=Session::get('sessionid');
        $orderdate = date('d-m-Y');
        $confirmorder = new  Order();
        $confirmorder->order_id = $generateorderid;
        $confirmorder->order_date = $orderdate;
        $confirmorder->user_id = Auth::user()->id;
        $confirmorder->order_price = $request->input('order_price');
        $confirmorder->payable_price= $request->input('payable_price');
        $confirmorder->coupon_id= $coooup->coupon_id;
        $confirmorder->coupon_amount= $request->input('coupon_amount');
        $confirmorder->delivery_charge= $request->input('delivery_charge');
        $confirmorder->payment_type = $request->payment;
        $confirmorder->firstname =$request->input('shipping_firstname');
        $confirmorder->lastname =$request->input('shipping_lastname');
        $confirmorder->phone =$request->input('shipping_phone');
        $confirmorder->email =$request->input('shipping_email');
        $confirmorder->country =$request->input('shipping_country');
        $confirmorder->state =$request->input('shipping_state');
        $confirmorder->city =$request->input('shipping_city');
        $confirmorder->address =$request->input('shipping_address1');
        $confirmorder->address2 =$request->input('shipping_address2');
        $confirmorder->pincode =$request->input('shipping_pincode');
        $confirmorder->address_type =$request->input('address_type');
        $confirmorder->save();

        $userpro = UserProfile::where('user_id',Auth::user()->id)
        ->update([
            'name' => $request->input('shipping_firstname'),
            'phone' => $request->input('shipping_phone'),
            'country' => $request->input('shipping_country'),
            'state' => $request->input('shipping_state'),
            'city' => $request->input('shipping_city'),
            'address' => $request->input('shipping_address1'),
            'pincode' => $request->input('shipping_pincode'),
        ]);

            $orderid=$confirmorder->id;
            $sellingprice=$confirmorder->order_price;
            $address=$confirmorder->address;
            $pincode=$confirmorder->pincode;
            $firstname=$confirmorder->firstname;
            $phone=$confirmorder->phone;
            $payable_price=$confirmorder->payable_price;
            $items=Cart::where('user_id',$userid)->where('id',$id)->get();
            foreach($items as $items) {
                $procart = ProductCart::where('id',$items->product_cart_id)->first();
                $pro=Product::where('status','Active')->where('id',$items->product_id)->first();
                if ($pro->is_variation == 0){
                    $price = $pro->price;
                    if ($items->quantity != "undefined") {
                        $quant = $pro->quantity - $items->quantity;
                    }else{
                        $quant = $pro->quantity;
                    }
                }else{
                    $productvariation = AddSubVariation::where('product_id',$items->product_id)->where('id',$items->variation_id)->first();
                    $price = $productvariation->price;
                    if ($items->quantity != "undefined") {
                        $quant = $productvariation->quantity - $items->quantity;
                    }else{
                        $quant = $productvariation->quantity;
                    }
                }
                $query=Product::where('status','Active')->where('id',$items->product_id)->update(['quantity'=>$quant]);
                $productstatus= Product::where('status','Active')->where('id',$items->product_id)->first();
                if($productstatus->quantity <= 0 && $productstatus->quantity != null){
                    $sql=Product::where('status','Active')->where('id',$items->product_id)
                    ->update(['stock_status'=>'outofstock']);
                }
              $product_id= $items->product_id;
              $subvariant_id= $items->variation_id;
              $delivery_charge= $items->delivery_charge;
              $product_price_id= $items->productprice_id;
              $quantity= $items->quantity;

              $input['order_id'] = $generateorderid;
              $input['user_id'] = Auth::user()->id;
              $input['product_id'] = $product_id;
              $input['variation_id'] = $subvariant_id;
              $input['mrp_price'] = $price;
              $input['selling_price'] = $price;
              $input['quantity'] = $quantity;
              $input['egg_type'] = $procart->egg_type;
              $input['product_images_id'] = $items->product_images_id;
              $input['product_logos_id'] = $items->product_logos_id;
              $input['addtext1'] = $procart->addtext1;
              $input['addtext2'] = $procart->addtext2;
              $input['cart_combo_id'] = $procart->cart_combo_id;
              $input['cart_charm_id'] = $procart->cart_charm_id;
              $input['charm_id'] = $procart->charm_id;
              $input['charm_price'] = $procart->charm_price;
              $input['printside'] = $procart->printside;
              $input['colortype'] = $procart->colortype;
              $input['location'] = $procart->location;
              $input['flowerss_type'] = $procart->flowerss_type;
              $input['datee'] = $procart->datee;
              $input['timee'] = $procart->timee;
              $input['pickup_type'] = $procart->pickup_type;
              $input['giftwrap'] = $procart->giftwrap;
              $input['giftwrap_price'] = $procart->giftwrap_price;
              $input['description'] = $procart->description;
              $input['comment'] = $procart->comment;
              DB::table('order_lists')->insert($input);
          }

        $deleteca=Cart::where('user_id',Auth::user()->id)->where('id',$id)->get();
        foreach($deleteca as $deleteca)
        {
            $deletepro =ProductCart::where('id',$deleteca->product_cart_id)->delete();
            $deleteca->delete();
        }

        return redirect('/orderconfirmed/'.$confirmorder->id);
    }

    function generateBarcodeNumber() {
        $number = mt_rand(1000000000, 9999999999); // better than rand()
        return $number;
    }

}
