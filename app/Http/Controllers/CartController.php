<?php

namespace App\Http\Controllers;

use App\Models\AddSubVariation;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\GiftCard;
use App\Models\GiftCardBuy;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCart;
use App\Models\ProductCombo;
use App\Models\ProductSelectHeading;
use App\Models\ProductSelectOption;
use App\Models\StoreCartAttribute;
use App\Models\StoreCartCharm;
use App\Models\StoreCartCombo;
use App\Models\StoreProductCartImage;
use App\Models\StoreProductCartLogo;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CartController extends Controller
{
    public function cart(Request $request)
    {
        if(Auth::check()){
            $session_id = Session::getId();
            $carts = Cart::where('user_id',Auth::user()->id)->get();
            $checkoutcart = Cart::where('user_id',Auth::user()->id)->get();
                $isCouponCheck = Cart::where('user_id',Auth::user()->id)->wherenotNull('coupon_id')->first();
                if ($isCouponCheck) {
                    $isCoupon = 1;
                    $coupon = Coupon::find($isCouponCheck->coupon_id);
                }
                else{
                    $isCoupon = 0;
                    $coupon = '';
                }
                $isgiftCheck = Cart::where('user_id',Auth::user()->id)->wherenotNull('giftcard_id')->first();
                if ($isgiftCheck) {
                    $isGiftcard = 1;
                    $gift = GiftCardBuy::where('id',$isgiftCheck->giftcard_id)->first();
                }
                else{
                    $isGiftcard = 0;
                    $gift = '';
                }
                return view('cart',compact('checkoutcart','carts','isCoupon','coupon','isGiftcard','gift'));
        }else{
                return redirect('login');
        }
    }

    public function checkoutaddToCart(Request $request)
    {
        if (!empty($request->imageval)) {
            $allowedfileExtension = ['jpeg','jpg','png'];
            if ($request->imageupload > $request->imageval) {
                return response()->json(['status'=>'error','msg' => 'Sorry! Maximum allowed images are'.$request->imageval]);
            //return 'Sorry! Maximum allowed images are'.$request->imageval;
            } else {
                $len = $request->imageupload;
                for ($i = 0; $i < $len; $i++) {
                    if ($request->hasfile('imageupload'.$i)) {
                        $image = $request->file('imageupload'.$i);
                        $sizeofimg = $request->file('imageupload'.$i)->getSize();
                        $extension = $image->getClientOriginalExtension();
                        $check = in_array($extension, $allowedfileExtension);
                        // Checking the image extension
                        if (!$check) {
                            return response()->json(['status'=>'error','msg' => 'Images must be  jpeg or jpg or png!']);
                            //return 'Images must be  jpeg or jpg or png!';
                        }
                        if ($sizeofimg > $request->imagesiz) {
                            return response()->json(['status'=>'error','msg' => 'Sorry! Maximum allowed size for an image is'.$request->imagesiz.'bytes']);
                            //return 'Sorry! Maximum allowed size for an image is'.$request->imagesiz.'bytes';
                        }
                    }
                }
            }
        }
        if (!empty($request->logoval)) {
            $allowedfileExtensionn = ['jpeg','jpg','png'];
            $request->logoval;
            if ($request->logoupload > $request->logoval) {
                return response()->json(['status'=>'error','msg' => 'Sorry! Maximum allowed images are'.$request->logoval]);
            //return 'Sorry! Maximum allowed images are'.$request->imageval;
            } else {
                $loglen = $request->logoupload;
                for ($j = 0; $j < $loglen; $j++) {
                    if ($request->hasfile('logoupload'.$j)) {
                        $logoo = $request->file('logoupload'.$j);
                        $sizeoflogo = $request->file('logoupload'.$j)->getSize();
                        $extensionlogo = $logoo->getClientOriginalExtension();
                        $checklogo = in_array($extensionlogo, $allowedfileExtensionn);
                        // Checking the image extension
                        if (!$checklogo) {
                            return response()->json(['status'=>'error','msg' => 'Image must be  jpeg or jpg or png!']);
                            //return 'Images must be  jpeg or jpg or png!';
                        }
                        if ($sizeoflogo > $request->logosiz) {
                            return response()->json(['status'=>'error','msg' => 'Sorry! Maximum allowed size for an image is'.$request->logosiz.'bytes']);
                            //return 'Sorry! Maximum allowed size for an image is'.$request->imagesiz.'bytes';
                        }
                    }
                }
            }
        }
        if (Auth::check()) {
            $user = User::where('id',Auth::user()->id)->where('role_id','3')->first();
            if ($user) {
                $prodd = Product::where('status','Active')->where('stock_status', 'outofstock')->where('id', $request->product_id)->first();
                    $proddq = Product::where('status','Active')->where('id', $request->product_id)->first();
                    if($request->quantity != "undefined")
                    {
                        $quant = $request->quantity;
                    }else{
                        $quant = null;
                    }
                    if ($proddq->quantity != null) {
                        if ($proddq->quantity < $quant) {
                            return response()->json(['status'=>'greate','msg' => 'Selected Quantity is greater']);
                        } else {
                            if ($prodd) {
                                return response()->json(['status'=>'out','msg' => 'Selected Product Is outofstock']);
                            } else {
                                $cart = Cart::where('product_id', $request->product_id)->where('user_id', Auth::user()->id)->first();
                                if ($cart) {
                                    if($request->quantity == "undefined"){
                                        $charmprice = 0;
                                        $charmval = StoreCartCharm::where('session_id', Session::getId())->where('product_id', $request->product_id)->get();
                                        if ($charmval->count() > 0) {
                                            foreach ($charmval as $charmval) {
                                                $charmid[] = $charmval->id;
                                                $charmmval[] = $charmval->charm_id;
                                                $charmprice += $charmval->charm_price;
                                            }
                                            $charmidd = implode(',',$charmid);
                                            $charmm = implode(',', $charmmval);
                                        } else {
                                            $charmidd = null;
                                            $charmm = $request->charm;
                                            $charmprice += $request->charm_price;
                                        }
                                        $productcombocart = StoreCartCombo::where('user_id',Auth::user()->id)->where('product_id',$request->product_id)->get();
                                        if ($productcombocart->count() > 0) {
                                            foreach ($productcombocart as $productcombocart) {
                                                $productcombocartval[] = $productcombocart->id;
                                            }
                                            $comval = implode(',', $productcombocartval);
                                        } else {
                                            $comval = null;
                                        }
                                        $procart = ProductCart::find($cart->product_cart_id);
                                        $procart->quantity = $request->quantity;
                                        $procart->addtext1 = $request->addtext1;
                                        $procart->egg_type = $request->eggtype;
                                        $procart->addtext2 = $request->addtext2;
                                        $procart->cart_combo_id = $comval;
                                        $procart->cart_charm_id = $charmidd;
                                        $procart->charm_id = $charmm;
                                        $procart->charm_price = $charmprice;
                                        $procart->printside = $request->printside;
                                        $procart->colortype = $request->colortype;
                                        $procart->location = $request->location;
                                        $procart->flowerss_type = $request->flowerss_type;
                                        $procart->datee = $request->datee;
                                        $procart->timee = $request->timee;
                                        $procart->pickup_type = $request->pickup_type;
                                        $procart->comment = $request->comment;
                                        $procart->giftwrap_price = $request->giftwrap_price;
                                        $procart->description = $request->description;
                                        if ($request->giftwrap == '') {
                                            $procart->giftwrap = '0';
                                        } elseif ($request->giftwrap	== 'on') {
                                            $procart->giftwrap = '1';
                                        }
                                        $request->hasfile('imageupload');
                                        if ($request->hasfile('imageupload')) {
                                            @unlink(public_path('uploads/images/'.$procart->imageupload));
                                            $file = $request->file('imageupload');
                                            $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                            $file->move(public_path('uploads/images'), $filename);
                                            $procart->imageupload = $filename;
                                        }
                                        if ($request->hasfile('logoupload')) {
                                            @unlink(public_path('uploads/images/'.$procart->logoupload));
                                            $file = $request->file('logoupload');
                                            $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                            $file->move(public_path('uploads/images'), $filename1);
                                            $procart->logoupload = $filename1;
                                        }
                                        $procart->save();
                                        $len = $request->imageupload;
                                        for ($i = 0; $i < $len; $i++) {
                                           //return $request->hasfile('imageupload'.$i);
                                           if($request->hasfile('imageupload'.$i))
                                           {
                                            $image = $request->file('imageupload'.$i);
                                             //  return $request->hasfile('imageupload'.$i);
                                             //  foreach(($request->file('imageupload'.$i)) as $image)
                                              // {
                                                   $name=time().uniqid(). '.' . $image->getClientOriginalName();
                                                   $image->move(public_path().'/uploads/images/', $name);
                                                   $data[] = $name;

                                                   $product_images= new StoreProductCartImage();
                                                   $product_images->product_id = $request->product_id;
                                                   $product_images->session_id = Session::getId();
                                                   $product_images->user_id = Auth::user()->id;
                                                   $product_images->product_cart_id = $procart->id;
                                                   $product_images->cart_images = $name;
                                                   $product_images->save();
                                               //}
                                           }
                                        }
                                        $lenlog = $request->logoupload;
                                        for ($x = 0; $x < $lenlog; $x++) {
                                           //return $request->hasfile('imageupload'.$i);
                                           if($request->hasfile('logoupload'.$x))
                                           {
                                            $logo = $request->file('logoupload'.$x);
                                             //  return $request->hasfile('imageupload'.$i);
                                             //  foreach(($request->file('imageupload'.$i)) as $image)
                                              // {
                                                   $name1=time().uniqid(). '.' . $logo->getClientOriginalName();
                                                   $logo->move(public_path().'/uploads/images/', $name1);
                                                   $data1[] = $name1;

                                                   $product_logo= new StoreProductCartLogo();
                                                   $product_logo->product_id = $request->product_id;
                                                   $product_logo->session_id = Session::getId();
                                                   $product_logo->product_cart_id = $procart->id;
                                                   $product_logo->user_id = Auth::user()->id;
                                                   $product_logo->cart_logo = $name1;
                                                   $product_logo->save();
                                               //}
                                           }
                                        }
                                        $checkimage = StoreProductCartImage::where('product_cart_id',$procart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                        ->where('user_id', Auth::user()->id)->get();
                                        if ($checkimage->count() > 0) {
                                            foreach ($checkimage as $checkimage) {
                                                $ckimg[] = $checkimage->id;
                                            }
                                            $ckim = implode(',', $ckimg);
                                        }else{
                                            $ckim = null;
                                        }
                                        $checklogo = StoreProductCartLogo::where('product_cart_id',$procart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                        ->where('user_id', Auth::user()->id)->get();
                                        if ($checklogo->count() > 0) {
                                            foreach ($checklogo as $checklogo) {
                                                $cklog[] = $checklogo->id;
                                            }
                                            $cklo = implode(',', $cklog);
                                        }else{
                                            $cklo = null;
                                        }

                                    }else{
                                        $quant = $cart->quantity + $request->quantity;
                                        $data=Cart::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)
                                            ->update([
                                                'quantity' => $quant,
                                                ]);
                                        $charmprice = 0;
                                        $charmval = StoreCartCharm::where('session_id', Session::getId())->where('product_id', $request->product_id)->get();
                                        if ($charmval->count() > 0) {
                                            foreach ($charmval as $charmval) {
                                                $charmid[] = $charmval->id;
                                                $charmmval[] = $charmval->charm_id;
                                                $charmprice += $charmval->charm_price;
                                            }
                                            $charmidd = implode(',',$charmid);
                                            $charmm = implode(',', $charmmval);
                                        } else {
                                            $charmidd = null;
                                            $charmm = $request->charm;
                                            $charmprice += $request->charm_price;
                                        }
                                        $productcombocart = StoreCartCombo::where('user_id',Auth::user()->id)->where('product_id',$request->product_id)->get();
                                        if ($productcombocart->count() > 0) {
                                            foreach ($productcombocart as $productcombocart) {
                                                $productcombocartval[] = $productcombocart->id;
                                            }
                                            $comval = implode(',', $productcombocartval);
                                        } else {
                                            $comval = null;
                                        }
                                        $procart = ProductCart::find($cart->product_cart_id);
                                        $procart->quantity = $quant;
                                        $procart->addtext1 = $request->addtext1;
                                        $procart->egg_type = $request->eggtype;
                                        $procart->addtext2 = $request->addtext2;
                                        $procart->cart_combo_id = $comval;
                                        $procart->cart_charm_id = $charmidd;
                                        $procart->charm_id = $charmm;
                                        $procart->charm_price = $charmprice;
                                        $procart->printside = $request->printside;
                                        $procart->colortype = $request->colortype;
                                        $procart->location = $request->location;
                                        $procart->flowerss_type = $request->flowerss_type;
                                        $procart->datee = $request->datee;
                                        $procart->timee = $request->timee;
                                        $procart->pickup_type = $request->pickup_type;
                                        $procart->comment = $request->comment;
                                        $procart->giftwrap_price = $request->giftwrap_price;
                                        $procart->description = $request->description;
                                        if ($request->giftwrap == '') {
                                            $procart->giftwrap = '0';
                                        } elseif ($request->giftwrap	== 'on') {
                                            $procart->giftwrap = '1';
                                        }
                                        $request->hasfile('imageupload');
                                        if ($request->hasfile('imageupload')) {
                                            @unlink(public_path('uploads/images/'.$procart->imageupload));
                                            $file = $request->file('imageupload');
                                            $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                            $file->move(public_path('uploads/images'), $filename);
                                            $procart->imageupload = $filename;
                                        }
                                        if ($request->hasfile('logoupload')) {
                                            @unlink(public_path('uploads/images/'.$procart->logoupload));
                                            $file = $request->file('logoupload');
                                            $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                            $file->move(public_path('uploads/images'), $filename1);
                                            $procart->logoupload = $filename1;
                                        }
                                        $procart->save();
                                        $len = $request->imageupload;
                                        for ($i = 0; $i < $len; $i++) {
                                           //return $request->hasfile('imageupload'.$i);
                                           if($request->hasfile('imageupload'.$i))
                                           {
                                            $image = $request->file('imageupload'.$i);
                                             //  return $request->hasfile('imageupload'.$i);
                                             //  foreach(($request->file('imageupload'.$i)) as $image)
                                              // {
                                                   $name=time().uniqid(). '.' . $image->getClientOriginalName();
                                                   $image->move(public_path().'/uploads/images/', $name);
                                                   $data[] = $name;

                                                   $product_images= new StoreProductCartImage();
                                                   $product_images->product_id = $request->product_id;
                                                   $product_images->session_id = Session::getId();
                                                   $product_images->product_cart_id = $procart->id;
                                                   $product_images->user_id = Auth::user()->id;
                                                   $product_images->cart_images = $name;
                                                   $product_images->save();
                                               //}
                                           }
                                        }
                                        $lenlog = $request->logoupload;
                                        for ($x = 0; $x < $lenlog; $x++) {
                                           //return $request->hasfile('imageupload'.$i);
                                           if($request->hasfile('logoupload'.$x))
                                           {
                                            $logo = $request->file('logoupload'.$x);
                                             //  return $request->hasfile('imageupload'.$i);
                                             //  foreach(($request->file('imageupload'.$i)) as $image)
                                              // {
                                                   $name1=time().uniqid(). '.' . $logo->getClientOriginalName();
                                                   $logo->move(public_path().'/uploads/images/', $name1);
                                                   $data1[] = $name1;

                                                   $product_logo= new StoreProductCartLogo();
                                                   $product_logo->product_id = $request->product_id;
                                                   $product_logo->session_id = Session::getId();
                                                   $product_logo->user_id = Auth::user()->id;
                                                   $product_logo->product_cart_id = $procart->id;
                                                   $product_logo->cart_logo = $name1;
                                                   $product_logo->save();
                                               //}
                                           }
                                        }
                                        $checkimage = StoreProductCartImage::where('product_cart_id',$procart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                        ->where('user_id', Auth::user()->id)->get();
                                        if ($checkimage->count() > 0) {
                                            foreach ($checkimage as $checkimage) {
                                                $ckimg[] = $checkimage->id;
                                            }
                                            $ckim = implode(',', $ckimg);
                                        }else{
                                            $ckim = null;
                                        }
                                        $checklogo = StoreProductCartLogo::where('product_cart_id',$procart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                        ->where('user_id', Auth::user()->id)->get();
                                        if ($checklogo->count() > 0) {
                                            foreach ($checklogo as $checklogo) {
                                                $cklog[] = $checklogo->id;
                                            }
                                            $cklo = implode(',', $cklog);
                                        }else{
                                            $cklo = null;
                                        }
                                        }
                                } else {
                                    $request->all();
                                    $charmprice = 0;
                                    $charmval = StoreCartCharm::where('session_id', Session::getId())->where('product_id', $request->product_id)->get();
                                    if ($charmval->count() > 0) {
                                        foreach ($charmval as $charmval) {
                                            $charmid[] = $charmval->id;
                                            $charmmval[] = $charmval->charm_id;
                                            $charmprice += $charmval->charm_price;
                                        }
                                        $charmidd = implode(',',$charmid);
                                        $charmm = implode(',', $charmmval);
                                    } else {
                                        $charmidd = null;
                                        $charmm = $request->charm;
                                        $charmprice += $request->charm_price;
                                    }
                                    $productcombocart = StoreCartCombo::where('user_id',Auth::user()->id)->where('product_id',$request->product_id)->get();
                                    if ($productcombocart->count() > 0) {
                                        foreach ($productcombocart as $productcombocart) {
                                            $productcombocartval[] = $productcombocart->id;
                                        }
                                        $comval = implode(',', $productcombocartval);
                                    } else {
                                        $comval = null;
                                    }
                                    $productcart = new ProductCart();
                                    $productcart->egg_type = $request->eggtype;
                                    $productcart->quantity = $request->quantity;
                                    $productcart->addtext1 = $request->addtext1;
                                    $productcart->addtext2 = $request->addtext2;
                                    $productcart->cart_combo_id = $comval;
                                    $productcart->cart_charm_id = $charmidd;
                                    $productcart->charm_id = $charmm;
                                    $productcart->charm_price = $charmprice;
                                    $productcart->printside = $request->printside;
                                    $productcart->colortype = $request->colortype;
                                    $productcart->location = $request->location;
                                    $productcart->flowerss_type = $request->flowerss_type;
                                    $productcart->datee = $request->datee;
                                    $productcart->timee = $request->timee;
                                    $productcart->pickup_type = $request->pickup_type;
                                    $productcart->giftwrap_price = $request->giftwrap_price;
                                    $productcart->description = $request->description;
                                    $productcart->comment = $request->comment;
                                    if ($request->giftwrap == '') {
                                        $productcart->giftwrap = '0';
                                    } elseif ($request->giftwrap	== 'on') {
                                        $productcart->giftwrap = '1';
                                    }
                                    $request->hasfile('imageupload');
                                    if ($request->hasfile('imageupload')) {
                                        $file = $request->file('imageupload');
                                        $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                        $file->move(public_path('uploads/images'), $filename1);
                                        $productcart->imageupload = $filename1;
                                    }
                                    if ($request->hasfile('logoupload')) {
                                        $file = $request->file('logoupload');
                                        $filename2 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                        $file->move(public_path('uploads/images'), $filename2);
                                        $productcart->logoupload = $filename2;
                                    }
                                    $productcart->save();
                                    $productcombocart = StoreCartCombo::where('user_id',Auth::user()->id)->where('product_id',$request->product_id)->get();
                                    if ($productcombocart->count() > 0) {
                                        foreach ($productcombocart as $productcombocart) {
                                            $productcombocartval[] = $productcombocart->id;
                                        }
                                        $comval = implode(',', $productcombocartval);
                                    } else {
                                        $comval = null;
                                    }
                                    $len = $request->imageupload;
                                        for ($i = 0; $i < $len; $i++) {
                                        //return $request->hasfile('imageupload'.$i);
                                        if($request->hasfile('imageupload'.$i))
                                        {
                                            $image = $request->file('imageupload'.$i);
                                            //  return $request->hasfile('imageupload'.$i);
                                            //  foreach(($request->file('imageupload'.$i)) as $image)
                                            // {
                                                $name=time().uniqid(). '.' . $image->getClientOriginalName();
                                                $image->move(public_path().'/uploads/images/', $name);
                                                $data[] = $name;

                                                $product_images= new StoreProductCartImage();
                                                $product_images->product_id = $request->product_id;
                                                $product_images->session_id = Session::getId();
                                                $product_images->user_id = Auth::user()->id;
                                                $product_images->cart_images = $name;
                                                $product_images->product_cart_id = $productcart->id;
                                                $product_images->save();
                                            //}
                                        }
                                        }
                                        $lenlog = $request->logoupload;
                                        for ($x = 0; $x < $lenlog; $x++) {
                                        //return $request->hasfile('imageupload'.$i);
                                        if($request->hasfile('logoupload'.$x))
                                        {
                                            $logo = $request->file('logoupload'.$x);
                                            //  return $request->hasfile('imageupload'.$i);
                                            //  foreach(($request->file('imageupload'.$i)) as $image)
                                            // {
                                                $name1=time().uniqid(). '.' . $logo->getClientOriginalName();
                                                $logo->move(public_path().'/uploads/images/', $name1);
                                                $data1[] = $name1;

                                                $product_logo= new StoreProductCartLogo();
                                                $product_logo->product_id = $request->product_id;
                                                $product_logo->session_id = Session::getId();
                                                $product_logo->user_id = Auth::user()->id;
                                                $product_logo->product_cart_id = $productcart->id;
                                                $product_logo->cart_logo = $name1;
                                                $product_logo->save();
                                            //}
                                        }
                                        }
                                        $checkimage = StoreProductCartImage::where('product_cart_id',$productcart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                        ->where('user_id', Auth::user()->id)->get();
                                        if($checkimage->count() > 0){
                                            foreach ($checkimage as $checkimage)
                                            {
                                                $ckimg[] = $checkimage->id;
                                            }
                                            $ckim = implode(',',$ckimg);
                                        }else{
                                            $ckim = null;
                                        }
                                        $checklogo = StoreProductCartLogo::where('product_cart_id',$productcart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                        ->where('user_id', Auth::user()->id)->get();
                                        if ($checklogo->count() > 0) {
                                            foreach ($checklogo as $checklogo) {
                                                $cklog[] = $checklogo->id;
                                            }
                                            $cklo = implode(',', $cklog);
                                        }else{
                                            $cklo = null;
                                        }
                                    $cart = new Cart();
                                    $cart->session_id = $request->session_id;
                                    $cart->user_id = Auth::user()->id;
                                    $cart->product_id = $request->product_id;
                                    $cart->price = $request->price;
                                    $cart->quantity = $request->quantity;
                                    $cart->product_cart_id = $productcart->id;
                                    $cart->product_combo_id =$comval;
                                    $cart->product_images_id = $ckim;
                                    $cart->product_logos_id = $cklo;
                                }
                                $cart->save();


                                $cart_counter = Cart::where('user_id', Auth::user()->id)->count('id');
                               // $desch = StoreCartCharm::where('session_id', Session::getId())->where('product_id', $request->product_id)->delete();
                                return response()->json(['status'=>'success','msg' => 'Product Added successfully','cart_id'=>$cart->id,'cart_counter' => $cart_counter]);
                            }
                        }
                    }else{
                        if ($prodd) {
                            return response()->json(['status'=>'out','msg' => 'Selected Product Is outofstock']);
                        } else {
                            $cart = Cart::where('product_id', $request->product_id)->where('user_id', Auth::user()->id)->first();
                            if ($cart) {
                                if($request->quantity =="undefined"){
                                    $charmprice = 0;
                                    $charmval = StoreCartCharm::where('session_id', Session::getId())->where('product_id', $request->product_id)->get();
                                    if ($charmval->count() > 0) {
                                        foreach ($charmval as $charmval) {
                                            $charmid[] = $charmval->id;
                                            $charmmval[] = $charmval->charm_id;
                                            $charmprice += $charmval->charm_price;
                                        }
                                            $charmidd = implode(',',$charmid);
                                            $charmm = implode(',', $charmmval);
                                    } else {
                                        $charmidd = null;
                                        $charmm = $request->charm;
                                        $charmprice += $request->charm_price;
                                    }
                                    $productcombocart = StoreCartCombo::where('user_id',Auth::user()->id)->where('product_id',$request->product_id)->get();
                                    if ($productcombocart->count() > 0) {
                                        foreach ($productcombocart as $productcombocart) {
                                            $productcombocartval[] = $productcombocart->id;
                                        }
                                        $comval = implode(',', $productcombocartval);
                                    } else {
                                        $comval = null;
                                    }
                                    $procart = ProductCart::find($cart->product_cart_id);
                                    $procart->quantity = $request->quantity;
                                    $procart->addtext1 = $request->addtext1;
                                    $procart->egg_type = $request->eggtype;
                                    $procart->addtext2 = $request->addtext2;
                                    $procart->cart_combo_id = $comval;
                                    $procart->cart_charm_id = $charmidd;
                                    $procart->charm_id = $charmm;
                                    $procart->charm_price = $charmprice;
                                    $procart->printside = $request->printside;
                                    $procart->colortype = $request->colortype;
                                    $procart->location = $request->location;
                                    $procart->flowerss_type = $request->flowerss_type;
                                    $procart->datee = $request->datee;
                                    $procart->timee = $request->timee;
                                    $procart->pickup_type = $request->pickup_type;
                                    $procart->comment = $request->comment;
                                    $procart->giftwrap_price = $request->giftwrap_price;
                                    $procart->description = $request->description;
                                    if ($request->giftwrap == '') {
                                        $procart->giftwrap = '0';
                                    } elseif ($request->giftwrap	== 'on') {
                                        $procart->giftwrap = '1';
                                    }
                                    $request->hasfile('imageupload');
                                    if ($request->hasfile('imageupload')) {
                                        @unlink(public_path('uploads/images/'.$procart->imageupload));
                                        $file = $request->file('imageupload');
                                        $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                        $file->move(public_path('uploads/images'), $filename);
                                        $procart->imageupload = $filename;
                                    }
                                    if ($request->hasfile('logoupload')) {
                                        @unlink(public_path('uploads/images/'.$procart->logoupload));
                                        $file = $request->file('logoupload');
                                        $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                        $file->move(public_path('uploads/images'), $filename1);
                                        $procart->logoupload = $filename1;
                                    }
                                    $procart->save();
                                    $len = $request->imageupload;
                                    for ($i = 0; $i < $len; $i++) {
                                       //return $request->hasfile('imageupload'.$i);
                                       if($request->hasfile('imageupload'.$i))
                                       {
                                        $image = $request->file('imageupload'.$i);
                                         //  return $request->hasfile('imageupload'.$i);
                                         //  foreach(($request->file('imageupload'.$i)) as $image)
                                          // {
                                               $name=time().uniqid(). '.' . $image->getClientOriginalName();
                                               $image->move(public_path().'/uploads/images/', $name);
                                               $data[] = $name;

                                               $product_images= new StoreProductCartImage();
                                               $product_images->product_id = $request->product_id;
                                               $product_images->session_id = Session::getId();
                                               $product_images->product_cart_id = $procart->id;
                                               $product_images->user_id = Auth::user()->id;
                                               $product_images->cart_images = $name;
                                               $product_images->save();
                                           //}
                                       }
                                    }
                                    $lenlog = $request->logoupload;
                                    for ($x = 0; $x < $lenlog; $x++) {
                                       //return $request->hasfile('imageupload'.$i);
                                       if($request->hasfile('logoupload'.$x))
                                       {
                                        $logo = $request->file('logoupload'.$x);
                                         //  return $request->hasfile('imageupload'.$i);
                                         //  foreach(($request->file('imageupload'.$i)) as $image)
                                          // {
                                               $name1=time().uniqid(). '.' . $logo->getClientOriginalName();
                                               $logo->move(public_path().'/uploads/images/', $name1);
                                               $data1[] = $name1;

                                               $product_logo= new StoreProductCartLogo();
                                               $product_logo->product_id = $request->product_id;
                                               $product_logo->session_id = Session::getId();
                                               $product_logo->user_id = Auth::user()->id;
                                               $product_logo->cart_logo = $name1;
                                               $product_logo->product_cart_id = $procart->id;
                                               $product_logo->save();
                                           //}
                                       }
                                    }
                                    $checkimage = StoreProductCartImage::where('product_cart_id',$procart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                    ->where('user_id', Auth::user()->id)->get();
                                    if ($checkimage->count() > 0) {
                                        foreach ($checkimage as $checkimage) {
                                            $ckimg[] = $checkimage->id;
                                        }
                                        $ckim = implode(',', $ckimg);
                                    }else{
                                        $ckim = null;
                                    }
                                    $checklogo = StoreProductCartLogo::where('product_cart_id',$procart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                    ->where('user_id', Auth::user()->id)->get();
                                    if ($checklogo->count() > 0) {
                                        foreach ($checklogo as $checklogo) {
                                            $cklog[] = $checklogo->id;
                                        }
                                        $cklo = implode(',', $cklog);
                                    }else{
                                        $cklo = null;
                                    }

                                }else{
                                    $quant = $cart->quantity + $request->quantity;
                                    $data=Cart::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)
                                        ->update([
                                            'quantity' => $quant,
                                            ]);
                                    $charmprice = 0;
                                    $charmval = StoreCartCharm::where('session_id', Session::getId())->where('product_id', $request->product_id)->get();
                                    if ($charmval->count() > 0) {
                                        foreach ($charmval as $charmval) {
                                            $charmid[] = $charmval->id;
                                            $charmmval[] = $charmval->charm_id;
                                            $charmprice += $charmval->charm_price;
                                        }
                                        $charmidd = implode(',',$charmid);
                                        $charmm = implode(',', $charmmval);
                                    } else {
                                            $charmidd = null;
                                            $charmm = $request->charm;
                                        $charmprice += $request->charm_price;
                                    }
                                    $productcombocart = StoreCartCombo::where('user_id',Auth::user()->id)->where('product_id',$request->product_id)->get();
                                    if ($productcombocart->count() > 0) {
                                        foreach ($productcombocart as $productcombocart) {
                                            $productcombocartval[] = $productcombocart->id;
                                        }
                                        $comval = implode(',', $productcombocartval);
                                    } else {
                                        $comval = null;
                                    }
                                    $procart = ProductCart::find($cart->product_cart_id);
                                    $procart->quantity = $quant;
                                    $procart->addtext1 = $request->addtext1;
                                    $procart->egg_type = $request->eggtype;
                                    $procart->addtext2 = $request->addtext2;
                                    $procart->cart_combo_id = $comval;
                                    $procart->cart_charm_id = $charmidd;
                                    $procart->charm_id = $charmm;
                                    $procart->charm_price = $charmprice;
                                    $procart->printside = $request->printside;
                                    $procart->colortype = $request->colortype;
                                    $procart->location = $request->location;
                                    $procart->flowerss_type = $request->flowerss_type;
                                    $procart->datee = $request->datee;
                                    $procart->timee = $request->timee;
                                    $procart->pickup_type = $request->pickup_type;
                                    $procart->comment = $request->comment;
                                    $procart->giftwrap_price = $request->giftwrap_price;
                                    $procart->description = $request->description;
                                    if ($request->giftwrap == '') {
                                        $procart->giftwrap = '0';
                                    } elseif ($request->giftwrap	== 'on') {
                                        $procart->giftwrap = '1';
                                    }
                                    $request->hasfile('imageupload');
                                    if ($request->hasfile('imageupload')) {
                                        @unlink(public_path('uploads/images/'.$procart->imageupload));
                                        $file = $request->file('imageupload');
                                        $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                        $file->move(public_path('uploads/images'), $filename);
                                        $procart->imageupload = $filename;
                                    }
                                    if ($request->hasfile('logoupload')) {
                                        @unlink(public_path('uploads/images/'.$procart->logoupload));
                                        $file = $request->file('logoupload');
                                        $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                        $file->move(public_path('uploads/images'), $filename1);
                                        $procart->logoupload = $filename1;
                                    }
                                    $procart->save();
                                    $len = $request->imageupload;
                                        for ($i = 0; $i < $len; $i++) {
                                        //return $request->hasfile('imageupload'.$i);
                                        if($request->hasfile('imageupload'.$i))
                                        {
                                            $image = $request->file('imageupload'.$i);
                                            //  return $request->hasfile('imageupload'.$i);
                                            //  foreach(($request->file('imageupload'.$i)) as $image)
                                            // {
                                                $name=time().uniqid(). '.' . $image->getClientOriginalName();
                                                $image->move(public_path().'/uploads/images/', $name);
                                                $data[] = $name;

                                                $product_images= new StoreProductCartImage();
                                                $product_images->product_id = $request->product_id;
                                                $product_images->session_id = Session::getId();
                                                $product_images->user_id = Auth::user()->id;
                                                $product_images->cart_images = $name;
                                                $product_images->product_cart_id = $procart->id;
                                                $product_images->save();
                                            //}
                                        }
                                        }
                                        $lenlog = $request->logoupload;
                                        for ($x = 0; $x < $lenlog; $x++) {
                                        //return $request->hasfile('imageupload'.$i);
                                        if($request->hasfile('logoupload'.$x))
                                        {
                                            $logo = $request->file('logoupload'.$x);
                                            //  return $request->hasfile('imageupload'.$i);
                                            //  foreach(($request->file('imageupload'.$i)) as $image)
                                            // {
                                                $name1=time().uniqid(). '.' . $logo->getClientOriginalName();
                                                $logo->move(public_path().'/uploads/images/', $name1);
                                                $data1[] = $name1;

                                                $product_logo= new StoreProductCartLogo();
                                                $product_logo->product_id = $request->product_id;
                                                $product_logo->session_id = Session::getId();
                                                $product_logo->product_cart_id = $procart->id;
                                                $product_logo->user_id = Auth::user()->id;
                                                $product_logo->cart_logo = $name1;
                                                $product_logo->save();
                                            //}
                                        }
                                        }
                                        $checkimage = StoreProductCartImage::where('product_cart_id',$procart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                        ->where('user_id', Auth::user()->id)->get();
                                        if ($checkimage->count() > 0) {
                                            foreach ($checkimage as $checkimage) {
                                                $ckimg[] = $checkimage->id;
                                            }
                                            $ckim = implode(',',$ckimg);

                                        }else{
                                            $ckim=null;
                                        }
                                        $checklogo = StoreProductCartLogo::where('product_cart_id',$procart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                        ->where('user_id', Auth::user()->id)->get();
                                        if ($checklogo->count() > 0) {
                                            foreach ($checklogo as $checklogo) {
                                                $cklog[] = $checklogo->id;
                                            }
                                            $cklo = implode(',', $cklog);
                                        }else{
                                            $cklo = null;
                                        }
                                }
                            } else {
                                $request->all();
                                $charmprice = 0;
                                $charmval = StoreCartCharm::where('session_id', Session::getId())->where('product_id', $request->product_id)->get();
                                if ($charmval->count() > 0) {
                                    foreach ($charmval as $charmval) {
                                        $charmid[] = $charmval->id;
                                        $charmmval[] = $charmval->charm_id;
                                        $charmprice += $charmval->charm_price;
                                    }
                                    $charmidd = implode(',',$charmid);
                                    $charmm = implode(',', $charmmval);
                                } else {
                                    $charmidd = null;
                                    $charmm = $request->charm;
                                    $charmprice += $request->charm_price;
                                }
                                $productcombocart = StoreCartCombo::where('user_id',Auth::user()->id)->where('product_id',$request->product_id)->get();
                                if ($productcombocart->count() > 0) {
                                    foreach ($productcombocart as $productcombocart) {
                                        $productcombocartval[] = $productcombocart->id;
                                    }
                                    $comval = implode(',', $productcombocartval);
                                } else {
                                    $comval = null;
                                }
                                $productcart = new ProductCart();
                                $productcart->egg_type = $request->eggtype;
                                $productcart->quantity = $request->quantity;
                                $productcart->addtext1 = $request->addtext1;
                                $productcart->addtext2 = $request->addtext2;
                                $productcart->cart_combo_id = $comval;
                                $productcart->cart_charm_id = $charmidd;
                                $productcart->charm_id = $charmm;
                                $productcart->charm_price = $charmprice;
                                $productcart->printside = $request->printside;
                                $productcart->colortype = $request->colortype;
                                $productcart->location = $request->location;
                                $productcart->flowerss_type = $request->flowerss_type;
                                $productcart->datee = $request->datee;
                                $productcart->timee = $request->timee;
                                $productcart->pickup_type = $request->pickup_type;
                                $productcart->giftwrap_price = $request->giftwrap_price;
                                $productcart->description = $request->description;
                                $productcart->comment = $request->comment;
                                if ($request->giftwrap == '') {
                                    $productcart->giftwrap = '0';
                                } elseif ($request->giftwrap	== 'on') {
                                    $productcart->giftwrap = '1';
                                }
                                $request->hasfile('imageupload');
                                if ($request->hasfile('imageupload')) {
                                    $file = $request->file('imageupload');
                                    $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                    $file->move(public_path('uploads/images'), $filename1);
                                    $productcart->imageupload = $filename1;
                                }
                                if ($request->hasfile('logoupload')) {
                                    $file = $request->file('logoupload');
                                    $filename2 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                    $file->move(public_path('uploads/images'), $filename2);
                                    $productcart->logoupload = $filename2;
                                }
                                $productcart->save();
                                $productcombocart = StoreCartCombo::where('user_id',Auth::user()->id)->where('product_id',$request->product_id)->get();
                                if ($productcombocart->count() > 0) {
                                    foreach ($productcombocart as $productcombocart) {
                                        $productcombocartval[] = $productcombocart->id;
                                    }
                                    $comval = implode(',', $productcombocartval);
                                } else {
                                    $comval = null;
                                }
                                $len = $request->imageupload;
                                for ($i = 0; $i < $len; $i++) {
                                   //return $request->hasfile('imageupload'.$i);
                                   if($request->hasfile('imageupload'.$i))
                                   {
                                    $image = $request->file('imageupload'.$i);
                                     //  return $request->hasfile('imageupload'.$i);
                                     //  foreach(($request->file('imageupload'.$i)) as $image)
                                      // {
                                           $name=time().uniqid(). '.' . $image->getClientOriginalName();
                                           $image->move(public_path().'/uploads/images/', $name);
                                           $data[] = $name;

                                           $product_images= new StoreProductCartImage();
                                           $product_images->product_id = $request->product_id;
                                           $product_images->session_id = Session::getId();
                                           $product_images->user_id = Auth::user()->id;
                                           $product_images->product_cart_id = $productcart->id;
                                           $product_images->cart_images = $name;
                                           $product_images->save();
                                       //}
                                   }
                                }
                                $lenlog = $request->logoupload;
                                for ($x = 0; $x < $lenlog; $x++) {
                                   //return $request->hasfile('imageupload'.$i);
                                   if($request->hasfile('logoupload'.$x))
                                   {
                                    $logo = $request->file('logoupload'.$x);
                                     //  return $request->hasfile('imageupload'.$i);
                                     //  foreach(($request->file('imageupload'.$i)) as $image)
                                      // {
                                           $name1=time().uniqid(). '.' . $logo->getClientOriginalName();
                                           $logo->move(public_path().'/uploads/images/', $name1);
                                           $data1[] = $name1;

                                           $product_logo= new StoreProductCartLogo();
                                           $product_logo->product_id = $request->product_id;
                                           $product_logo->session_id = Session::getId();
                                           $product_logo->user_id = Auth::user()->id;
                                           $product_logo->product_cart_id = $productcart->id;
                                           $product_logo->cart_logo = $name1;
                                           $product_logo->save();
                                       //}
                                   }
                                }
                                $checkimage = StoreProductCartImage::where('product_cart_id',$productcart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                ->where('user_id', Auth::user()->id)->get();
                                if ($checkimage->count() > 0) {
                                    foreach ($checkimage as $checkimage) {
                                        $ckimg[] = $checkimage->id;
                                    }
                                    $ckim = implode(',',$ckimg);
                                }else{
                                    $ckim = null;
                                }
                                $checklogo = StoreProductCartLogo::where('product_cart_id',$productcart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                ->where('user_id', Auth::user()->id)->get();
                                if ($checklogo->count() > 0) {
                                    foreach ($checklogo as $checklogo) {
                                        $cklog[] = $checklogo->id;
                                    }
                                $cklo = implode(',',$cklog);
                                }else{
                                    $cklo = null;
                                }
                                $cart = new Cart();
                                $cart->session_id = $request->session_id;
                                $cart->user_id = Auth::user()->id;
                                $cart->product_id = $request->product_id;
                                $cart->price = $request->price;
                                $cart->quantity = $request->quantity;
                                $cart->product_cart_id = $productcart->id;
                                $cart->product_combo_id =$comval;
                                $cart->product_images_id = $ckim;
                                $cart->product_logos_id = $cklo;
                            }
                            $cart->save();
                            $cart_counter = Cart::where('user_id', Auth::user()->id)->count('id');
                            //$desch = StoreCartCharm::where('session_id', Session::getId())->where('product_id', $request->product_id)->delete();
                            return response()->json(['status'=>'success','msg' => 'Product Added successfully','cart_id'=>$cart->id,'cart_counter' => $cart_counter]);
                        }

                    }
                }else{
                    return response()->json(['status'=>'selected','msg' => 'Please Login As User To Add More Products']);
                }
        } else {
            return response()->json(['status'=>'failure','msg' => 'Please Login']);
        }
    }

    public function checkoutvaraddToCart(Request $request)
    {

        if (!empty($request->imageval)) {
            $allowedfileExtension = ['jpeg','jpg','png'];
            if ($request->imageupload > $request->imageval) {
                return response()->json(['status'=>'error','msg' => 'Sorry! Maximum allowed images are'.$request->imageval]);
            //return 'Sorry! Maximum allowed images are'.$request->imageval;
            } else {
                $len = $request->imageupload;
                for ($i = 0; $i < $len; $i++) {
                    if ($request->hasfile('imageupload'.$i)) {
                        $image = $request->file('imageupload'.$i);
                        $sizeofimg = $request->file('imageupload'.$i)->getSize();
                        $extension = $image->getClientOriginalExtension();
                        $check = in_array($extension, $allowedfileExtension);
                        // Checking the image extension
                        if (!$check) {
                            return response()->json(['status'=>'error','msg' => 'Images must be  jpeg or jpg or png!']);
                            //return 'Images must be  jpeg or jpg or png!';
                        }
                        if ($sizeofimg > $request->imagesiz) {
                            return response()->json(['status'=>'error','msg' => 'Sorry! Maximum allowed size for an image is'.$request->imagesiz.'bytes']);
                            //return 'Sorry! Maximum allowed size for an image is'.$request->imagesiz.'bytes';
                        }
                    }
                }
            }
        }
        if (!empty($request->logoval)) {
            $allowedfileExtensionn = ['jpeg','jpg','png'];
            $request->logoval;
            if ($request->logoupload > $request->logoval) {
                return response()->json(['status'=>'error','msg' => 'Sorry! Maximum allowed images are'.$request->logoval]);
            //return 'Sorry! Maximum allowed images are'.$request->imageval;
            } else {
                $loglen = $request->logoupload;
                for ($j = 0; $j < $loglen; $j++) {
                    if ($request->hasfile('logoupload'.$j)) {
                        $logoo = $request->file('logoupload'.$j);
                        $sizeoflogo = $request->file('logoupload'.$j)->getSize();
                        $extensionlogo = $logoo->getClientOriginalExtension();
                        $checklogo = in_array($extensionlogo, $allowedfileExtensionn);
                        // Checking the image extension
                        if (!$checklogo) {
                            return response()->json(['status'=>'error','msg' => 'Image must be  jpeg or jpg or png!']);
                            //return 'Images must be  jpeg or jpg or png!';
                        }
                        if ($sizeoflogo > $request->logosiz) {
                            return response()->json(['status'=>'error','msg' => 'Sorry! Maximum allowed size for an image is'.$request->logosiz.'bytes']);
                            //return 'Sorry! Maximum allowed size for an image is'.$request->imagesiz.'bytes';
                        }
                    }
                }
            }
        }

        if (Auth::check()) {
            $user = User::where('id',Auth::user()->id)->where('role_id','3')->first();
            if ($user) {
                $prodd = Product::where('status','Active')->where('stock_status', 'outofstock')->where('id', $request->product_id)->first();

                $varr3 = StoreCartAttribute::where('session_id',Session::getId())->where('product_id',$request->product_id)->get();
                if($varr3->count() <= 0) {
                    return response()->json(['status'=>'attribute','msg' => 'Please select attribute']);
                }
                foreach($varr3 as $varr3){
                    $vari[] = $varr3->att_id;
                }
                $tags = implode(',',$vari);
                $var = AddSubVariation::where('main_attr_value', $tags)->where('product_id',$request->product_id)->first();
                if($var != null)
                {
                        $proddq = AddSubVariation::where('product_id', $request->product_id)->where('id',$var->id)->first();
                        if($request->quantity != "undefined")
                        {
                            $quant = $request->quantity;
                        }else{
                            $quant = null;
                        }
                        if ($proddq->quantity != null) {
                            if ($proddq->quantity < $quant) {
                                return response()->json(['status'=>'greate','msg' => 'Selected Quantity is greater']);
                            } else {
                                if ($prodd) {
                                    return response()->json(['status'=>'out','msg' => 'Selected Product Is outofstock']);
                                } else {
                                    $var2 = StoreCartAttribute::where('session_id', Session::getId())->where('product_id', $request->product_id)->get();
                                    if($var2->count() <= 0) {
                                        return response()->json(['status'=>'attribute','msg' => 'Please select attribute']);
                                    }
                                    foreach ($var2 as $var2) {
                                        $vari2[] = $var2->att_id;
                                    }
                                    $tags2 = implode(',', $vari2);
                                    $var12= AddSubVariation::where('main_attr_value', $tags2)->where('product_id', $request->product_id)->first();
                                    $cart = Cart::where('product_id', $request->product_id)->where('variation_id', $var12->id)->where('user_id', Auth::user()->id)->first();
                                    if ($cart) {
                                        if($request->quantity == "undefined")
                                        {
                                            $charmprice = 0;
                                            $charmval = StoreCartCharm::where('session_id', Session::getId())->where('product_id', $request->product_id)->get();

                                            if ($charmval->count() > 0) {
                                                foreach ($charmval as $charmval) {
                                                    $charmid[] = $charmval->id;
                                                    $charmmval[] = $charmval->charm_id;
                                                    $charmprice += $charmval->charm_price;
                                                }
                                                $charmidd = implode(',',$charmid);
                                                $charmm = implode(',', $charmmval);
                                            } else {
                                                $charmidd = null;
                                                $charmm = $request->charm;
                                                $charmprice += $request->charm_price;
                                            }
                                            $productcombocart = StoreCartCombo::where('user_id',Auth::user()->id)->where('product_id',$request->product_id)->get();
                                            if ($productcombocart->count() > 0) {
                                                foreach ($productcombocart as $productcombocart) {
                                                    $productcombocartval[] = $productcombocart->id;
                                                }
                                                $comval = implode(',', $productcombocartval);
                                            } else {
                                                $comval = null;
                                            }

                                            $procart = ProductCart::find($cart->product_cart_id);
                                            $procart->quantity = $request->quantity;
                                            $procart->addtext1 = $request->addtext1;
                                            $procart->egg_type = $request->eggtype;
                                            $procart->addtext2 = $request->addtext2;
                                            $procart->cart_combo_id = $comval;
                                            $procart->cart_charm_id = $charmidd;
                                            $procart->charm_id = $charmm;
                                            $procart->charm_price = $charmprice;
                                            $procart->printside = $request->printside;
                                            $procart->colortype = $request->colortype;
                                            $procart->location = $request->location;
                                            $procart->flowerss_type = $request->flowerss_type;
                                            $procart->datee = $request->datee;
                                            $procart->timee = $request->timee;
                                            $procart->pickup_type = $request->pickup_type;
                                            $procart->comment = $request->comment;
                                            $procart->giftwrap_price = $request->giftwrap_price;
                                            $procart->description = $request->description;
                                            if ($request->giftwrap == '') {
                                                $procart->giftwrap = '0';
                                            } elseif ($request->giftwrap	== 'on') {
                                                $procart->giftwrap = '1';
                                            }
                                            if ($request->hasfile('imageupload')) {
                                                @unlink(public_path('uploads/images/'.$procart->imageupload));
                                                $file = $request->file('imageupload');
                                                $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                                $file->move(public_path('uploads/images'), $filename);
                                                $procart->imageupload = $filename;
                                            }
                                            if ($request->hasfile('logoupload')) {
                                                @unlink(public_path('uploads/images/'.$procart->logoupload));
                                                $file = $request->file('logoupload');
                                                $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                                $file->move(public_path('uploads/images'), $filename1);
                                                $procart->logoupload = $filename1;
                                            }
                                            $procart->save();
                                            $len = $request->imageupload;
                                            for ($i = 0; $i < $len; $i++) {
                                               //return $request->hasfile('imageupload'.$i);
                                               if($request->hasfile('imageupload'.$i))
                                               {
                                                $image = $request->file('imageupload'.$i);
                                                 //  return $request->hasfile('imageupload'.$i);
                                                 //  foreach(($request->file('imageupload'.$i)) as $image)
                                                  // {
                                                       $name=time().uniqid(). '.' . $image->getClientOriginalName();
                                                       $image->move(public_path().'/uploads/images/', $name);
                                                       $data[] = $name;

                                                       $product_images= new StoreProductCartImage();
                                                       $product_images->product_id = $request->product_id;
                                                       $product_images->session_id = Session::getId();
                                                       $product_images->user_id = Auth::user()->id;
                                                       $product_images->cart_images = $name;
                                                       $product_images->product_cart_id = $procart->id;
                                                       $product_images->save();
                                                   //}
                                               }
                                            }
                                            $lenlog = $request->logoupload;
                                            for ($x = 0; $x < $lenlog; $x++) {
                                               //return $request->hasfile('imageupload'.$i);
                                               if($request->hasfile('logoupload'.$x))
                                               {
                                                $logo = $request->file('logoupload'.$x);
                                                 //  return $request->hasfile('imageupload'.$i);
                                                 //  foreach(($request->file('imageupload'.$i)) as $image)
                                                  // {
                                                       $name1=time().uniqid(). '.' . $logo->getClientOriginalName();
                                                       $logo->move(public_path().'/uploads/images/', $name1);
                                                       $data1[] = $name1;

                                                       $product_logo= new StoreProductCartLogo();
                                                       $product_logo->product_id = $request->product_id;
                                                       $product_logo->session_id = Session::getId();
                                                       $product_logo->user_id = Auth::user()->id;
                                                       $product_logo->product_cart_id = $procart->id;
                                                       $product_logo->cart_logo = $name1;
                                                       $product_logo->save();
                                                   //}
                                               }
                                            }
                                            $checkimage = StoreProductCartImage::where('product_cart_id',$procart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                            ->where('user_id', Auth::user()->id)->get();
                                            if ($checkimage->count() > 0) {
                                                foreach ($checkimage as $checkimage)
                                                {
                                                    $ckimg[] = $checkimage->id;
                                                }
                                                $ckim = implode(',',$ckimg);
                                            }else{
                                                $ckim = null;
                                            }
                                            $checklogo = StoreProductCartLogo::where('product_cart_id',$procart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                            ->where('user_id', Auth::user()->id)->get();
                                            if ($checklogo->count() > 0) {
                                                foreach ($checklogo as $checklogo) {
                                                    $cklog[] = $checklogo->id;
                                                }
                                                $cklo = implode(',', $cklog);
                                            }else{
                                                $cklo = null;
                                            }
                                        }else{
                                            $quant2 = $cart->quantity + $request->quantity;
                                            $data=Cart::where('user_id', Auth::user()->id)->where('variation_id', $var12->id)->where('product_id', $request->product_id)
                                                    ->update([
                                                        'quantity' => $quant2,
                                                        ]);
                                            $charmprice = 0;
                                            $charmval = StoreCartCharm::where('session_id', Session::getId())->where('product_id', $request->product_id)->get();

                                            if ($charmval->count() > 0) {
                                                foreach ($charmval as $charmval) {
                                                    $charmid[] = $charmval->id;
                                                    $charmmval[] = $charmval->charm_id;
                                                    $charmprice += $charmval->charm_price;
                                                }
                                                $charmidd = implode(',',$charmid);
                                                $charmm = implode(',', $charmmval);
                                            } else {
                                                $charmidd = null;
                                                $charmm = $request->charm;
                                                $charmprice += $request->charm_price;
                                            }
                                            $productcombocart = StoreCartCombo::where('user_id',Auth::user()->id)->where('product_id',$request->product_id)->get();
                                            if ($productcombocart->count() > 0) {
                                                foreach ($productcombocart as $productcombocart) {
                                                    $productcombocartval[] = $productcombocart->id;
                                                }
                                                $comval = implode(',', $productcombocartval);
                                            } else {
                                                $comval = null;
                                            }
                                            $procart = ProductCart::find($cart->product_cart_id);
                                            $procart->quantity = $quant2;
                                            $procart->addtext1 = $request->addtext1;
                                            $procart->egg_type = $request->eggtype;
                                            $procart->addtext2 = $request->addtext2;
                                            $procart->cart_combo_id = $comval;
                                            $procart->cart_charm_id = $charmidd;
                                            $procart->charm_id = $charmm;
                                            $procart->charm_price = $charmprice;
                                            $procart->printside = $request->printside;
                                            $procart->colortype = $request->colortype;
                                            $procart->location = $request->location;
                                            $procart->flowerss_type = $request->flowerss_type;
                                            $procart->datee = $request->datee;
                                            $procart->timee = $request->timee;
                                            $procart->pickup_type = $request->pickup_type;
                                            $procart->comment = $request->comment;
                                            $procart->giftwrap_price = $request->giftwrap_price;
                                            $procart->description = $request->description;
                                            if ($request->giftwrap == '') {
                                                $procart->giftwrap = '0';
                                            } elseif ($request->giftwrap	== 'on') {
                                                $procart->giftwrap = '1';
                                            }
                                            if ($request->hasfile('imageupload')) {
                                                @unlink(public_path('uploads/images/'.$procart->imageupload));
                                                $file = $request->file('imageupload');
                                                $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                                $file->move(public_path('uploads/images'), $filename);
                                                $procart->imageupload = $filename;
                                            }
                                            if ($request->hasfile('logoupload')) {
                                                @unlink(public_path('uploads/images/'.$procart->logoupload));
                                                $file = $request->file('logoupload');
                                                $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                                $file->move(public_path('uploads/images'), $filename1);
                                                $procart->logoupload = $filename1;
                                            }
                                            $procart->save();
                                            $len = $request->imageupload;
                                            for ($i = 0; $i < $len; $i++) {
                                               //return $request->hasfile('imageupload'.$i);
                                               if($request->hasfile('imageupload'.$i))
                                               {
                                                $image = $request->file('imageupload'.$i);
                                                 //  return $request->hasfile('imageupload'.$i);
                                                 //  foreach(($request->file('imageupload'.$i)) as $image)
                                                  // {
                                                       $name=time().uniqid(). '.' . $image->getClientOriginalName();
                                                       $image->move(public_path().'/uploads/images/', $name);
                                                       $data[] = $name;

                                                       $product_images= new StoreProductCartImage();
                                                       $product_images->product_id = $request->product_id;
                                                       $product_images->session_id = Session::getId();
                                                       $product_images->user_id = Auth::user()->id;
                                                       $product_images->product_cart_id = $procart->id;
                                                       $product_images->cart_images = $name;
                                                       $product_images->save();
                                                   //}
                                               }
                                            }
                                            $lenlog = $request->logoupload;
                                            for ($x = 0; $x < $lenlog; $x++) {
                                               //return $request->hasfile('imageupload'.$i);
                                               if($request->hasfile('logoupload'.$x))
                                               {
                                                $logo = $request->file('logoupload'.$x);
                                                 //  return $request->hasfile('imageupload'.$i);
                                                 //  foreach(($request->file('imageupload'.$i)) as $image)
                                                  // {
                                                       $name1=time().uniqid(). '.' . $logo->getClientOriginalName();
                                                       $logo->move(public_path().'/uploads/images/', $name1);
                                                       $data1[] = $name1;

                                                       $product_logo= new StoreProductCartLogo();
                                                       $product_logo->product_id = $request->product_id;
                                                       $product_logo->session_id = Session::getId();
                                                       $product_logo->user_id = Auth::user()->id;
                                                       $product_logo->product_cart_id = $procart->id;
                                                       $product_logo->cart_logo = $name1;
                                                       $product_logo->save();
                                                   //}
                                               }
                                            }
                                            $checkimage = StoreProductCartImage::where('product_cart_id',$procart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                            ->where('user_id', Auth::user()->id)->get();
                                            if ($checkimage->count() > 0) {
                                                foreach ($checkimage as $checkimage) {
                                                    $ckimg[] = $checkimage->id;
                                                }
                                                $ckim = implode(',', $ckimg);
                                            }else{
                                                $ckim = null;
                                            }
                                            $checklogo = StoreProductCartLogo::where('product_cart_id',$procart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                            ->where('user_id', Auth::user()->id)->get();
                                            if ($checklogo->count() > 0) {
                                                foreach ($checklogo as $checklogo) {
                                                    $cklog[] = $checklogo->id;
                                                }
                                                $cklo = implode(',', $cklog);
                                            }else{
                                                $cklo = null;
                                            }

                                        }
                                        $des = StoreCartAttribute::where('session_id', Session::getId())->where('product_id', $request->product_id)->delete();
                                    } else {
                                        $charmprice = 0;
                                        $charmval = StoreCartCharm::where('session_id', Session::getId())->where('product_id', $request->product_id)->get();
                                        if ($charmval->count() > 0) {
                                            foreach ($charmval as $charmval) {
                                                $charmid[] = $charmval->id;
                                                $charmmval[] = $charmval->charm_id;
                                                $charmprice += $charmval->charm_price;
                                            }
                                            $charmidd = implode(',',$charmid);
                                            $charmm = implode(',', $charmmval);
                                        } else {
                                            $charmidd = null;
                                            $charmm = $request->charm;
                                            $charmprice += $request->charm_price;
                                        }
                                        $productcombocart = StoreCartCombo::where('user_id',Auth::user()->id)->where('product_id',$request->product_id)->get();
                                        if ($productcombocart->count() > 0) {
                                            foreach ($productcombocart as $productcombocart) {
                                                $productcombocartval[] = $productcombocart->id;
                                            }
                                            $comval = implode(',', $productcombocartval);
                                        } else {
                                            $comval = null;
                                        }
                                        $productcart = new ProductCart();
                                        $productcart->egg_type = $request->eggtype;
                                        $productcart->quantity = $request->quantity;
                                        $productcart->addtext1 = $request->addtext1;
                                        $productcart->addtext2 = $request->addtext2;
                                        $productcart->cart_combo_id = $comval;
                                        $productcart->cart_charm_id = $charmidd;
                                        $productcart->charm_id = $charmm;
                                        $productcart->charm_price = $charmprice;
                                        $productcart->printside = $request->printside;
                                        $productcart->colortype = $request->colortype;
                                        $productcart->location = $request->location;
                                        $productcart->flowerss_type = $request->flowerss_type;
                                        $productcart->datee = $request->datee;
                                        $productcart->timee = $request->timee;
                                        $productcart->pickup_type = $request->pickup_type;
                                        $productcart->giftwrap_price = $request->giftwrap_price;
                                        $productcart->description = $request->description;
                                        $productcart->comment = $request->comment;
                                        if ($request->giftwrap == '') {
                                            $productcart->giftwrap = '0';
                                        } elseif ($request->giftwrap	== 'on') {
                                            $productcart->giftwrap = '1';
                                        }
                                        if ($request->hasfile('imageupload')) {
                                            $file = $request->file('imageupload');
                                            $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                            $file->move(public_path('uploads/images'), $filename1);
                                            $productcart->imageupload = $filename1;
                                        }
                                        if ($request->hasfile('logoupload')) {
                                            $file = $request->file('logoupload');
                                            $filename2 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                            $file->move(public_path('uploads/images'), $filename2);
                                            $productcart->logoupload = $filename2;
                                        }
                                        $productcart->save();
                                        $productcombocart = StoreCartCombo::where('user_id',Auth::user()->id)->where('product_id',$request->product_id)->get();
                                        if ($productcombocart->count() > 0) {
                                            foreach ($productcombocart as $productcombocart) {
                                                $productcombocartval[] = $productcombocart->id;
                                            }
                                            $comval = implode(',', $productcombocartval);
                                        } else {
                                            $comval = null;
                                        }
                                        $len = $request->imageupload;
                                        for ($i = 0; $i < $len; $i++) {
                                           //return $request->hasfile('imageupload'.$i);
                                           if($request->hasfile('imageupload'.$i))
                                           {
                                            $image = $request->file('imageupload'.$i);
                                             //  return $request->hasfile('imageupload'.$i);
                                             //  foreach(($request->file('imageupload'.$i)) as $image)
                                              // {
                                                   $name=time().uniqid(). '.' . $image->getClientOriginalName();
                                                   $image->move(public_path().'/uploads/images/', $name);
                                                   $data[] = $name;

                                                   $product_images= new StoreProductCartImage();
                                                   $product_images->product_id = $request->product_id;
                                                   $product_images->session_id = Session::getId();
                                                   $product_images->user_id = Auth::user()->id;
                                                   $product_images->product_cart_id = $productcart->id;
                                                   $product_images->cart_images = $name;
                                                   $product_images->save();
                                               //}
                                           }
                                        }
                                        $lenlog = $request->logoupload;
                                        for ($x = 0; $x < $lenlog; $x++) {
                                           //return $request->hasfile('imageupload'.$i);
                                           if($request->hasfile('logoupload'.$x))
                                           {
                                            $logo = $request->file('logoupload'.$x);
                                             //  return $request->hasfile('imageupload'.$i);
                                             //  foreach(($request->file('imageupload'.$i)) as $image)
                                              // {
                                                   $name1=time().uniqid(). '.' . $logo->getClientOriginalName();
                                                   $logo->move(public_path().'/uploads/images/', $name1);
                                                   $data1[] = $name1;

                                                   $product_logo= new StoreProductCartLogo();
                                                   $product_logo->product_id = $request->product_id;
                                                   $product_logo->session_id = Session::getId();
                                                   $product_logo->user_id = Auth::user()->id;
                                                   $product_images->product_cart_id = $productcart->id;
                                                   $product_logo->cart_logo = $name1;
                                                   $product_logo->save();
                                               //}
                                           }
                                        }
                                        $checkimage = StoreProductCartImage::where('product_cart_id',$productcart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                        ->where('user_id', Auth::user()->id)->get();
                                        if ($checkimage->count() > 0) {
                                            foreach ($checkimage as $checkimage) {
                                                $ckimg[] = $checkimage->id;
                                            }
                                            $ckim = implode(',', $ckimg);
                                        }else{
                                            $ckim = null;
                                        }
                                        $checklogo = StoreProductCartLogo::where('product_cart_id',$productcart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                        ->where('user_id', Auth::user()->id)->get();
                                        if ($checklogo->count() > 0) {
                                            foreach ($checklogo as $checklogo) {
                                                $cklog[] = $checklogo->id;
                                            }
                                            $cklo = implode(',', $cklog);
                                        }else{
                                            $cklo = null;
                                        }
                                        $cart = new Cart();
                                        $cart->session_id = $request->session_id;
                                        $cart->user_id = Auth::user()->id;
                                        $cart->product_id = $request->product_id;
                                        $cart->variation_id = $request->variation_id;
                                        $cart->price = $request->price;
                                        $cart->quantity = $request->quantity;
                                        $cart->product_cart_id = $productcart->id;
                                        $cart->product_combo_id =$comval;
                                        $cart->product_images_id = $ckim;
                                        $cart->product_logos_id = $cklo;

                                    }
                                    $cart->save();

                                    $cart_counter = Cart::where('user_id', Auth::user()->id)->count('id');
                                  //  $desch = StoreCartCharm::where('session_id', Session::getId())->where('product_id', $request->product_id)->delete();
                                    $des = StoreCartAttribute::where('session_id', Session::getId())->where('product_id', $request->product_id)->delete();
                                    return response()->json(['status'=>'success','msg' => 'Product Added successfully','cart_id'=>$cart->id,'cart_counter' => $cart_counter]);

                                }
                            }
                        }else{
                            if ($prodd) {
                                return response()->json(['status'=>'out','msg' => 'Selected Product Is outofstock']);
                            } else {
                                $var2 = StoreCartAttribute::where('session_id', Session::getId())->where('product_id', $request->product_id)->get();
                                if($var2->count() <= 0) {
                                    return response()->json(['status'=>'attribute','msg' => 'Please select attribute']);
                                }
                                foreach ($var2 as $var2) {
                                    $vari2[] = $var2->att_id;
                                }
                                $tags2 = implode(',', $vari2);
                                $var12= AddSubVariation::where('main_attr_value', $tags2)->where('product_id', $request->product_id)->first();
                                $cart = Cart::where('product_id', $request->product_id)->where('variation_id', $var12->id)->where('user_id', Auth::user()->id)->first();
                                if ($cart) {
                                    if($request->quantity == "undefined"){
                                        $charmprice = 0;
                                        $charmval = StoreCartCharm::where('session_id', Session::getId())->where('product_id', $request->product_id)->get();
                                        if ($charmval->count() > 0) {
                                            foreach ($charmval as $charmval) {
                                                $charmid[] = $charmval->id;
                                                $charmmval[] = $charmval->charm_id;
                                                $charmprice += $charmval->charm_price;
                                            }
                                            $charmidd = implode(',',$charmid);
                                            $charmm = implode(',', $charmmval);
                                        } else {
                                            $charmidd = null;
                                            $charmm = $request->charm;
                                            $charmprice += $request->charm_price;
                                        }
                                        $productcombocart = StoreCartCombo::where('user_id',Auth::user()->id)->where('product_id',$request->product_id)->get();
                                        if ($productcombocart->count() > 0) {
                                            foreach ($productcombocart as $productcombocart) {
                                                $productcombocartval[] = $productcombocart->id;
                                            }
                                            $comval = implode(',', $productcombocartval);
                                        } else {
                                            $comval = null;
                                        }
                                        $procart = ProductCart::find($cart->product_cart_id);
                                        $procart->quantity = $request->quantity;
                                        $procart->addtext1 = $request->addtext1;
                                        $procart->egg_type = $request->eggtype;
                                        $procart->addtext2 = $request->addtext2;
                                        $procart->cart_combo_id = $comval;
                                        $procart->cart_charm_id = $charmidd;
                                        $procart->charm_id = $charmm;
                                        $procart->charm_price = $charmprice;
                                        $procart->printside = $request->printside;
                                        $procart->colortype = $request->colortype;
                                        $procart->location = $request->location;
                                        $procart->flowerss_type = $request->flowerss_type;
                                        $procart->datee = $request->datee;
                                        $procart->timee = $request->timee;
                                        $procart->pickup_type = $request->pickup_type;
                                        $procart->comment = $request->comment;
                                        $procart->giftwrap_price = $request->giftwrap_price;
                                        $procart->description = $request->description;
                                        if ($request->giftwrap == '') {
                                            $procart->giftwrap = '0';
                                        } elseif ($request->giftwrap	== 'on') {
                                            $procart->giftwrap = '1';
                                        }
                                        if ($request->hasfile('imageupload')) {
                                            @unlink(public_path('uploads/images/'.$procart->imageupload));
                                            $file = $request->file('imageupload');
                                            $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                            $file->move(public_path('uploads/images'), $filename);
                                            $procart->imageupload = $filename;
                                        }
                                        if ($request->hasfile('logoupload')) {
                                            @unlink(public_path('uploads/images/'.$procart->logoupload));
                                            $file = $request->file('logoupload');
                                            $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                            $file->move(public_path('uploads/images'), $filename1);
                                            $procart->logoupload = $filename1;
                                        }
                                        $procart->save();
                                        $len = $request->imageupload;
                                        for ($i = 0; $i < $len; $i++) {
                                           //return $request->hasfile('imageupload'.$i);
                                           if($request->hasfile('imageupload'.$i))
                                           {
                                            $image = $request->file('imageupload'.$i);
                                             //  return $request->hasfile('imageupload'.$i);
                                             //  foreach(($request->file('imageupload'.$i)) as $image)
                                              // {
                                                   $name=time().uniqid(). '.' . $image->getClientOriginalName();
                                                   $image->move(public_path().'/uploads/images/', $name);
                                                   $data[] = $name;

                                                   $product_images= new StoreProductCartImage();
                                                   $product_images->product_id = $request->product_id;
                                                   $product_images->session_id = Session::getId();
                                                   $product_images->user_id = Auth::user()->id;
                                                   $product_images->cart_images = $name;
                                                   $product_images->product_cart_id = $procart->id;
                                                   $product_images->save();
                                               //}
                                           }
                                        }
                                        $lenlog = $request->logoupload;
                                        for ($x = 0; $x < $lenlog; $x++) {
                                           //return $request->hasfile('imageupload'.$i);
                                           if($request->hasfile('logoupload'.$x))
                                           {
                                            $logo = $request->file('logoupload'.$x);
                                             //  return $request->hasfile('imageupload'.$i);
                                             //  foreach(($request->file('imageupload'.$i)) as $image)
                                              // {
                                                   $name1=time().uniqid(). '.' . $logo->getClientOriginalName();
                                                   $logo->move(public_path().'/uploads/images/', $name1);
                                                   $data1[] = $name1;

                                                   $product_logo= new StoreProductCartLogo();
                                                   $product_logo->product_id = $request->product_id;
                                                   $product_logo->session_id = Session::getId();
                                                   $product_logo->product_cart_id = $procart->id;
                                                   $product_logo->user_id = Auth::user()->id;
                                                   $product_logo->cart_logo = $name1;
                                                   $product_logo->save();
                                               //}
                                           }
                                        }
                                        $checkimage = StoreProductCartImage::where('product_cart_id',$procart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                        ->where('user_id', Auth::user()->id)->get();
                                        if ($checkimage->count() > 0) {
                                            foreach ($checkimage as $checkimage) {
                                                $ckimg[] = $checkimage->id;
                                            }
                                            $ckim = implode(',', $ckimg);
                                        }else{
                                            $ckim = null;
                                        }
                                        $checklogo = StoreProductCartLogo::where('product_cart_id',$procart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                        ->where('user_id', Auth::user()->id)->get();
                                        if ($checklogo->count() > 0) {
                                            foreach ($checklogo as $checklogo) {
                                                $cklog[] = $checklogo->id;
                                            }
                                            $cklo = implode(',', $cklog);
                                        }else{
                                            $cklo = null;
                                        }
                                    }else{
                                        $quant2 = $cart->quantity + $request->quantity;
                                        $data=Cart::where('user_id', Auth::user()->id)->where('variation_id', $var12->id)->where('product_id', $request->product_id)
                                                ->update([
                                                    'quantity' => $quant2,
                                                    ]);
                                        $charmprice = 0;
                                        $charmval = StoreCartCharm::where('session_id', Session::getId())->where('product_id', $request->product_id)->get();
                                        if ($charmval->count() > 0) {
                                            foreach ($charmval as $charmval) {
                                                $charmid[] = $charmval->id;
                                                $charmmval[] = $charmval->charm_id;
                                                $charmprice += $charmval->charm_price;
                                            }
                                            $charmidd = implode(',',$charmid);
                                            $charmm = implode(',', $charmmval);
                                        } else {
                                            $charmidd = null;
                                            $charmm = $request->charm;
                                            $charmprice += $request->charm_price;
                                        }
                                        $productcombocart = StoreCartCombo::where('user_id',Auth::user()->id)->where('product_id',$request->product_id)->get();
                                        if ($productcombocart->count() > 0) {
                                            foreach ($productcombocart as $productcombocart) {
                                                $productcombocartval[] = $productcombocart->id;
                                            }
                                            $comval = implode(',', $productcombocartval);
                                        } else {
                                            $comval = null;
                                        }
                                        $procart = ProductCart::find($cart->product_cart_id);
                                        $procart->quantity = $quant2;
                                        $procart->addtext1 = $request->addtext1;
                                        $procart->egg_type = $request->eggtype;
                                        $procart->addtext2 = $request->addtext2;
                                        $procart->cart_combo_id = $comval;
                                        $procart->cart_charm_id = $charmidd;
                                        $procart->charm_id = $charmm;
                                        $procart->charm_price = $charmprice;
                                        $procart->printside = $request->printside;
                                        $procart->colortype = $request->colortype;
                                        $procart->location = $request->location;
                                        $procart->flowerss_type = $request->flowerss_type;
                                        $procart->datee = $request->datee;
                                        $procart->timee = $request->timee;
                                        $procart->pickup_type = $request->pickup_type;
                                        $procart->comment = $request->comment;
                                        $procart->giftwrap_price = $request->giftwrap_price;
                                        $procart->description = $request->description;
                                        if ($request->giftwrap == '') {
                                            $procart->giftwrap = '0';
                                        } elseif ($request->giftwrap	== 'on') {
                                            $procart->giftwrap = '1';
                                        }
                                        if ($request->hasfile('imageupload')) {
                                            @unlink(public_path('uploads/images/'.$procart->imageupload));
                                            $file = $request->file('imageupload');
                                            $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                            $file->move(public_path('uploads/images'), $filename);
                                            $procart->imageupload = $filename;
                                        }
                                        if ($request->hasfile('logoupload')) {
                                            @unlink(public_path('uploads/images/'.$procart->logoupload));
                                            $file = $request->file('logoupload');
                                            $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                            $file->move(public_path('uploads/images'), $filename1);
                                            $procart->logoupload = $filename1;
                                        }
                                        $procart->save();
                                        $len = $request->imageupload;
                                        for ($i = 0; $i < $len; $i++) {
                                           //return $request->hasfile('imageupload'.$i);
                                           if($request->hasfile('imageupload'.$i))
                                           {
                                            $image = $request->file('imageupload'.$i);
                                             //  return $request->hasfile('imageupload'.$i);
                                             //  foreach(($request->file('imageupload'.$i)) as $image)
                                              // {
                                                   $name=time().uniqid(). '.' . $image->getClientOriginalName();
                                                   $image->move(public_path().'/uploads/images/', $name);
                                                   $data[] = $name;

                                                   $product_images= new StoreProductCartImage();
                                                   $product_images->product_id = $request->product_id;
                                                   $product_images->session_id = Session::getId();
                                                   $product_images->user_id = Auth::user()->id;
                                                   $product_images->cart_images = $name;
                                                   $product_images->product_cart_id = $procart->id;
                                                   $product_images->save();
                                               //}
                                           }
                                        }
                                        $lenlog = $request->logoupload;
                                        for ($x = 0; $x < $lenlog; $x++) {
                                           //return $request->hasfile('imageupload'.$i);
                                           if($request->hasfile('logoupload'.$x))
                                           {
                                            $logo = $request->file('logoupload'.$x);
                                             //  return $request->hasfile('imageupload'.$i);
                                             //  foreach(($request->file('imageupload'.$i)) as $image)
                                              // {
                                                   $name1=time().uniqid(). '.' . $logo->getClientOriginalName();
                                                   $logo->move(public_path().'/uploads/images/', $name1);
                                                   $data1[] = $name1;

                                                   $product_logo= new StoreProductCartLogo();
                                                   $product_logo->product_id = $request->product_id;
                                                   $product_logo->session_id = Session::getId();
                                                   $product_logo->user_id = Auth::user()->id;
                                                   $product_logo->product_cart_id = $procart->id;
                                                   $product_logo->cart_logo = $name1;
                                                   $product_logo->save();
                                               //}
                                           }
                                        }
                                        $checkimage = StoreProductCartImage::where('product_cart_id',$procart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                        ->where('user_id', Auth::user()->id)->get();
                                        if ($checkimage->count() > 0) {
                                            foreach ($checkimage as $checkimage) {
                                                $ckimg[] = $checkimage->id;
                                            }
                                            $ckim = implode(',', $ckimg);
                                        }else{
                                            $ckim = null;
                                        }
                                        $checklogo = StoreProductCartLogo::where('product_cart_id',$procart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                        ->where('user_id', Auth::user()->id)->get();
                                        if ($checklogo->count() > 0) {
                                            foreach ($checklogo as $checklogo) {
                                                $cklog[] = $checklogo->id;
                                            }
                                            $cklo = implode(',', $cklog);
                                        }else{
                                            $cklo = null;
                                        }

                                    }
                                    $des = StoreCartAttribute::where('session_id', Session::getId())->where('product_id', $request->product_id)->delete();
                                } else {
                                    $charmprice = 0;
                                    $charmval = StoreCartCharm::where('session_id', Session::getId())->where('product_id', $request->product_id)->get();
                                    if ($charmval->count() > 0) {
                                        foreach ($charmval as $charmval) {
                                            $charmid[] = $charmval->id;
                                            $charmmval[] = $charmval->charm_id;
                                            $charmprice += $charmval->charm_price;
                                        }
                                        $charmidd = implode(',',$charmid);
                                        $charmm = implode(',', $charmmval);
                                    } else {
                                        $charmidd = null;
                                        $charmm = $request->charm;
                                        $charmprice += $request->charm_price;
                                    }
                                    $productcombocart = StoreCartCombo::where('user_id',Auth::user()->id)->where('product_id',$request->product_id)->get();
                                    if ($productcombocart->count() > 0) {
                                        foreach ($productcombocart as $productcombocart) {
                                            $productcombocartval[] = $productcombocart->id;
                                        }
                                        $comval = implode(',', $productcombocartval);
                                    } else {
                                        $comval = null;
                                    }
                                    $productcart = new ProductCart();
                                    $productcart->egg_type = $request->eggtype;
                                    $productcart->quantity = $request->quantity;
                                    $productcart->addtext1 = $request->addtext1;
                                    $productcart->addtext2 = $request->addtext2;
                                    $productcart->cart_combo_id = $comval;
                                    $productcart->cart_charm_id = $charmidd;
                                    $productcart->charm_id = $charmm;
                                    $productcart->charm_price = $charmprice;
                                    $productcart->printside = $request->printside;
                                    $productcart->colortype = $request->colortype;
                                    $productcart->location = $request->location;
                                    $productcart->flowerss_type = $request->flowerss_type;
                                    $productcart->datee = $request->datee;
                                    $productcart->timee = $request->timee;
                                    $productcart->pickup_type = $request->pickup_type;
                                    $productcart->giftwrap_price = $request->giftwrap_price;
                                    $productcart->description = $request->description;
                                    $productcart->comment = $request->comment;
                                    if ($request->giftwrap == '') {
                                        $productcart->giftwrap = '0';
                                    } elseif ($request->giftwrap	== 'on') {
                                        $productcart->giftwrap = '1';
                                    }
                                    if ($request->hasfile('imageupload')) {
                                        $file = $request->file('imageupload');
                                        $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                        $file->move(public_path('uploads/images'), $filename1);
                                        $productcart->imageupload = $filename1;
                                    }
                                    if ($request->hasfile('logoupload')) {
                                        $file = $request->file('logoupload');
                                        $filename2 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                        $file->move(public_path('uploads/images'), $filename2);
                                        $productcart->logoupload = $filename2;
                                    }
                                    $productcart->save();
                                    $productcombocart = StoreCartCombo::where('user_id',Auth::user()->id)->where('product_id',$request->product_id)->get();
                                    if ($productcombocart->count() > 0) {
                                        foreach ($productcombocart as $productcombocart) {
                                            $productcombocartval[] = $productcombocart->id;
                                        }
                                        $comval = implode(',', $productcombocartval);
                                    } else {
                                        $comval = null;
                                    }
                                    $len = $request->imageupload;
                                        for ($i = 0; $i < $len; $i++) {
                                        //return $request->hasfile('imageupload'.$i);
                                        if($request->hasfile('imageupload'.$i))
                                        {
                                            $image = $request->file('imageupload'.$i);
                                            //  return $request->hasfile('imageupload'.$i);
                                            //  foreach(($request->file('imageupload'.$i)) as $image)
                                            // {
                                                $name=time().uniqid(). '.' . $image->getClientOriginalName();
                                                $image->move(public_path().'/uploads/images/', $name);
                                                $data[] = $name;

                                                $product_images= new StoreProductCartImage();
                                                $product_images->product_id = $request->product_id;
                                                $product_images->session_id = Session::getId();
                                                $product_images->user_id = Auth::user()->id;
                                                $product_images->cart_images = $name;
                                                $product_images->product_cart_id = $productcart->id;
                                                $product_images->save();
                                            //}
                                        }
                                        }
                                        $lenlog = $request->logoupload;
                                        for ($x = 0; $x < $lenlog; $x++) {
                                        //return $request->hasfile('imageupload'.$i);
                                        if($request->hasfile('logoupload'.$x))
                                        {
                                            $logo = $request->file('logoupload'.$x);
                                            //  return $request->hasfile('imageupload'.$i);
                                            //  foreach(($request->file('imageupload'.$i)) as $image)
                                            // {
                                                $name1=time().uniqid(). '.' . $logo->getClientOriginalName();
                                                $logo->move(public_path().'/uploads/images/', $name1);
                                                $data1[] = $name1;

                                                $product_logo= new StoreProductCartLogo();
                                                $product_logo->product_id = $request->product_id;
                                                $product_logo->session_id = Session::getId();
                                                $product_logo->user_id = Auth::user()->id;
                                                $product_logo->cart_logo = $name1;
                                                $product_logo->product_cart_id = $productcart->id;
                                                $product_logo->save();
                                            //}
                                        }
                                        }
                                        $checkimage = StoreProductCartImage::where('product_cart_id',$productcart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                        ->where('user_id', Auth::user()->id)->get();
                                        if ($checkimage->count() > 0) {
                                            foreach ($checkimage as $checkimage) {
                                                $ckimg[] = $checkimage->id;
                                            }
                                            $ckim = implode(',', $ckimg);
                                        }else{
                                            $ckim = null;
                                        }
                                        $checklogo = StoreProductCartLogo::where('product_cart_id',$productcart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                        ->where('user_id', Auth::user()->id)->get();
                                        if ($checklogo->count() > 0) {
                                            foreach ($checklogo as $checklogo) {
                                                $cklog[] = $checklogo->id;
                                            }
                                            $cklo = implode(',', $cklog);
                                        }else{
                                            $cklo = null;
                                        }
                                    $cart = new Cart();
                                    $cart->session_id = $request->session_id;
                                    $cart->user_id = Auth::user()->id;
                                    $cart->product_id = $request->product_id;
                                    $cart->variation_id = $request->variation_id;
                                    $cart->price = $request->price;
                                    $cart->quantity = $request->quantity;
                                    $cart->product_cart_id = $productcart->id;
                                    $cart->product_combo_id =$comval;
                                    $cart->product_images_id = $ckim;
                                    $cart->product_logos_id = $cklo;
                                }
                                $cart->save();

                                $cart_counter = Cart::where('user_id', Auth::user()->id)->count('id');
                                //$desch = StoreCartCharm::where('session_id', Session::getId())->where('product_id', $request->product_id)->delete();
                                $des = StoreCartAttribute::where('session_id', Session::getId())->where('product_id', $request->product_id)->delete();
                                return response()->json(['status'=>'success','msg' => 'Product Added successfully','cart_id'=>$cart->id,'cart_counter' => $cart_counter]);
                            }
                        }
                }else{
                    return response()->json(['status'=>'attribute','msg' => "Selected Atrribute Doesn't Exisits"]);
                }
            }else{
                return response()->json(['status'=>'selected','msg' => 'Please Login As User To Add More Products']);
            }
        }else{
            return response()->json(['status'=>'failure','msg' => 'Please Login']);
        }
    }

















    public function varaddToCart(Request $request)
    {
        //return $request->all();
        //$validator = Validator::make($request->all(), [
          //  'datee' => 'requiredIf:$request->datee_required,1',
           // 'timee' => 'requiredIf:$request->timee_required,1',
           // 'eggtypee' => 'requiredIf:$request->eggoreggless_required,1'
       // ]);

       //return $request->imageval;
       /*if($request->location_required == 1){

        $validated = $request->validate([
            'location' => 'required',
        ]);
        return back()->with(['error'=>'errors','msg' => 'Location fieldis required']);

    }

    if($request->datee_required == 1){
        dd('df');
        $validated = $request->validate([
            'datee' => 'required',
        ]);
        return back()->with(['error'=>'errors','msg' => 'Date fieldis required']);
    }*/

        if (!empty($request->imageval)) {
            $allowedfileExtension = ['jpeg','jpg','png'];
            if ($request->imageupload > $request->imageval) {
                return response()->json(['status'=>'error','msg' => 'Sorry! Maximum allowed images are'.$request->imageval]);
            //return 'Sorry! Maximum allowed images are'.$request->imageval;
            } else {
                $len = $request->imageupload;
                for ($i = 0; $i < $len; $i++) {
                    if ($request->hasfile('imageupload'.$i)) {
                        $image = $request->file('imageupload'.$i);
                        $sizeofimg = $request->file('imageupload'.$i)->getSize();
                        $extension = $image->getClientOriginalExtension();
                        $check = in_array($extension, $allowedfileExtension);
                        // Checking the image extension
                        if (!$check) {
                            return response()->json(['status'=>'error','msg' => 'Images must be  jpeg or jpg or png!']);
                            //return 'Images must be  jpeg or jpg or png!';
                        }
                        if ($sizeofimg > $request->imagesiz) {
                            return response()->json(['status'=>'error','msg' => 'Sorry! Maximum allowed size for an image is'.$request->imagesiz.'bytes']);
                            //return 'Sorry! Maximum allowed size for an image is'.$request->imagesiz.'bytes';
                        }
                    }
                }
            }
        }
        if (!empty($request->logoval)) {
            $allowedfileExtensionn = ['jpeg','jpg','png'];
            $request->logoval;
            if ($request->logoupload > $request->logoval) {
                return response()->json(['status'=>'error','msg' => 'Sorry! Maximum allowed images are'.$request->logoval]);
            //return 'Sorry! Maximum allowed images are'.$request->imageval;
            } else {
                $loglen = $request->logoupload;
                for ($j = 0; $j < $loglen; $j++) {
                    if ($request->hasfile('logoupload'.$j)) {
                        $logoo = $request->file('logoupload'.$j);
                        $sizeoflogo = $request->file('logoupload'.$j)->getSize();
                        $extensionlogo = $logoo->getClientOriginalExtension();
                        $checklogo = in_array($extensionlogo, $allowedfileExtensionn);
                        // Checking the image extension
                        if (!$checklogo) {
                            return response()->json(['status'=>'error','msg' => 'Image must be  jpeg or jpg or png!']);
                            //return 'Images must be  jpeg or jpg or png!';
                        }
                        if ($sizeoflogo > $request->logosiz) {
                            return response()->json(['status'=>'error','msg' => 'Sorry! Maximum allowed size for an image is'.$request->logosiz.'bytes']);
                            //return 'Sorry! Maximum allowed size for an image is'.$request->imagesiz.'bytes';
                        }
                    }
                }
            }
        }
        if (Auth::check()) {
            $user = User::where('id',Auth::user()->id)->where('role_id','3')->first();
            if ($user) {
                $prodd = Product::where('status','Active')->where('stock_status', 'outofstock')->where('id', $request->product_id)->first();
                 $varr3 = StoreCartAttribute::where('session_id',Session::getId())->where('product_id',$request->product_id)->get();
                if($varr3->count() <= 0) {
                    return response()->json(['status'=>'attribute','msg' => 'Please select attribute']);
                }
                foreach($varr3 as $varr3){
                    $vari[] = $varr3->att_id;
                }
                $tags = implode(',',$vari);
                $var = AddSubVariation::where('main_attr_value', $tags)->where('product_id',$request->product_id)->first();
                if($var != null)
                {
                        $proddq = AddSubVariation::where('product_id', $request->product_id)->where('id',$var->id)->first();
                        if($request->quantity != "undefined")
                        {
                            $quant = $request->quantity;
                        }else{
                            $quant = null;
                        }
                        if ($proddq->quantity != null) {
                            if ($proddq->quantity < $quant) {
                                return response()->json(['status'=>'greate','msg' => 'Selected Quantity is greater']);
                            } else {
                                if ($prodd) {
                                    return response()->json(['status'=>'out','msg' => 'Selected Product Is outofstock']);
                                } else {
                                    $var2 = StoreCartAttribute::where('session_id', Session::getId())->where('product_id', $request->product_id)->get();
                                    if($var2->count() <= 0) {
                                        return response()->json(['status'=>'attribute','msg' => 'Please select attribute']);
                                    }
                                    foreach ($var2 as $var2) {
                                        $vari2[] = $var2->att_id;
                                    }
                                    $tags2 = implode(',', $vari2);
                                    $var12= AddSubVariation::where('main_attr_value', $tags2)->where('product_id', $request->product_id)->first();
                                    $cart = Cart::where('product_id', $request->product_id)->where('variation_id', $var12->id)->where('user_id', Auth::user()->id)->first();
                                    if ($cart) {
                                        if($request->quantity == "undefined")
                                        {
                                            $charmprice = 0;
                                            $charmval = StoreCartCharm::where('session_id', Session::getId())->where('product_id', $request->product_id)->get();

                                            if ($charmval->count() > 0) {
                                                foreach ($charmval as $charmval) {
                                                    $charmid[] = $charmval->id;
                                                    $charmmval[] = $charmval->charm_id;
                                                    $charmprice += $charmval->charm_price;
                                                }
                                                $charmidd = implode(',',$charmid);
                                                $charmm = implode(',', $charmmval);
                                            } else {
                                                $charmidd = null;
                                                $charmm = $request->charm;
                                                $charmprice += $request->charm_price;
                                            }
                                            $productcombocart = StoreCartCombo::where('user_id',Auth::user()->id)->where('product_id',$request->product_id)->get();
                                            if ($productcombocart->count() > 0) {
                                                foreach ($productcombocart as $productcombocart) {
                                                    $productcombocartval[] = $productcombocart->id;
                                                }
                                                $comval = implode(',', $productcombocartval);
                                            } else {
                                                $comval = null;
                                            }

                                            $procart = ProductCart::find($cart->product_cart_id);
                                            $procart->quantity = $request->quantity;
                                            $procart->addtext1 = $request->addtext1;
                                            $procart->egg_type = $request->eggtype;
                                            $procart->addtext2 = $request->addtext2;
                                            $procart->cart_combo_id = $comval;
                                            $procart->cart_charm_id = $charmidd;
                                            $procart->charm_id = $charmm;
                                            $procart->charm_price = $charmprice;
                                            $procart->printside = $request->printside;
                                            $procart->colortype = $request->colortype;
                                            $procart->location = $request->location;
                                            $procart->flowerss_type = $request->flowerss_type;
                                            $procart->datee = $request->datee;
                                            $procart->timee = $request->timee;
                                            $procart->pickup_type = $request->pickup_type;
                                            $procart->comment = $request->comment;
                                            $procart->giftwrap_price = $request->giftwrap_price;
                                            $procart->description = $request->description;
                                            if ($request->giftwrap == '') {
                                                $procart->giftwrap = '0';
                                            } elseif ($request->giftwrap	== 'on') {
                                                $procart->giftwrap = '1';
                                            }
                                            if ($request->hasfile('imageupload')) {
                                                @unlink(public_path('uploads/images/'.$procart->imageupload));
                                                $file = $request->file('imageupload');
                                                $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                                $file->move(public_path('uploads/images'), $filename);
                                                $procart->imageupload = $filename;
                                            }
                                            if ($request->hasfile('logoupload')) {
                                                @unlink(public_path('uploads/images/'.$procart->logoupload));
                                                $file = $request->file('logoupload');
                                                $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                                $file->move(public_path('uploads/images'), $filename1);
                                                $procart->logoupload = $filename1;
                                            }
                                            $procart->save();
                                            $len = $request->imageupload;
                                            for ($i = 0; $i < $len; $i++) {
                                               //return $request->hasfile('imageupload'.$i);
                                               if($request->hasfile('imageupload'.$i))
                                               {
                                                $image = $request->file('imageupload'.$i);
                                                 //  return $request->hasfile('imageupload'.$i);
                                                 //  foreach(($request->file('imageupload'.$i)) as $image)
                                                  // {
                                                       $name=time().uniqid(). '.' . $image->getClientOriginalName();
                                                       $image->move(public_path().'/uploads/images/', $name);
                                                       $data[] = $name;

                                                       $product_images= new StoreProductCartImage();
                                                       $product_images->product_id = $request->product_id;
                                                       $product_images->session_id = Session::getId();
                                                       $product_images->user_id = Auth::user()->id;
                                                       $product_images->cart_images = $name;
                                                       $product_images->product_cart_id = $procart->id;
                                                       $product_images->save();
                                                   //}
                                               }
                                            }
                                            $lenlog = $request->logoupload;
                                            for ($x = 0; $x < $lenlog; $x++) {
                                               //return $request->hasfile('imageupload'.$i);
                                               if($request->hasfile('logoupload'.$x))
                                               {
                                                $logo = $request->file('logoupload'.$x);
                                                 //  return $request->hasfile('imageupload'.$i);
                                                 //  foreach(($request->file('imageupload'.$i)) as $image)
                                                  // {
                                                       $name1=time().uniqid(). '.' . $logo->getClientOriginalName();
                                                       $logo->move(public_path().'/uploads/images/', $name1);
                                                       $data1[] = $name1;

                                                       $product_logo= new StoreProductCartLogo();
                                                       $product_logo->product_id = $request->product_id;
                                                       $product_logo->session_id = Session::getId();
                                                       $product_logo->user_id = Auth::user()->id;
                                                       $product_logo->product_cart_id = $procart->id;
                                                       $product_logo->cart_logo = $name1;
                                                       $product_logo->save();
                                                   //}
                                               }
                                            }
                                            $checkimage = StoreProductCartImage::where('product_cart_id',$procart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                            ->where('user_id', Auth::user()->id)->get();
                                            if ($checkimage->count() > 0) {
                                                foreach ($checkimage as $checkimage)
                                                {
                                                    $ckimg[] = $checkimage->id;
                                                }
                                                $ckim = implode(',',$ckimg);
                                            }else{
                                                $ckim = null;
                                            }
                                            $checklogo = StoreProductCartLogo::where('product_cart_id',$procart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                            ->where('user_id', Auth::user()->id)->get();
                                            if ($checklogo->count() > 0) {
                                                foreach ($checklogo as $checklogo) {
                                                    $cklog[] = $checklogo->id;
                                                }
                                                $cklo = implode(',', $cklog);
                                            }else{
                                                $cklo = null;
                                            }
                                        }else{
                                            $quant2 = $cart->quantity + $request->quantity;
                                            $data=Cart::where('user_id', Auth::user()->id)->where('variation_id', $var12->id)->where('product_id', $request->product_id)
                                                    ->update([
                                                        'quantity' => $quant2,
                                                        ]);
                                            $charmprice = 0;
                                            $charmval = StoreCartCharm::where('session_id', Session::getId())->where('product_id', $request->product_id)->get();

                                            if ($charmval->count() > 0) {
                                                foreach ($charmval as $charmval) {
                                                    $charmid[] = $charmval->id;
                                                    $charmmval[] = $charmval->charm_id;
                                                    $charmprice += $charmval->charm_price;
                                                }
                                                $charmidd = implode(',',$charmid);
                                                $charmm = implode(',', $charmmval);
                                            } else {
                                                $charmidd = null;
                                                $charmm = $request->charm;
                                                $charmprice += $request->charm_price;
                                            }
                                            $productcombocart = StoreCartCombo::where('user_id',Auth::user()->id)->where('product_id',$request->product_id)->get();
                                            if ($productcombocart->count() > 0) {
                                                foreach ($productcombocart as $productcombocart) {
                                                    $productcombocartval[] = $productcombocart->id;
                                                }
                                                $comval = implode(',', $productcombocartval);
                                            } else {
                                                $comval = null;
                                            }
                                            $procart = ProductCart::find($cart->product_cart_id);
                                            $procart->quantity = $quant2;
                                            $procart->addtext1 = $request->addtext1;
                                            $procart->egg_type = $request->eggtype;
                                            $procart->addtext2 = $request->addtext2;
                                            $procart->cart_combo_id = $comval;
                                            $procart->cart_charm_id = $charmidd;
                                            $procart->charm_id = $charmm;
                                            $procart->charm_price = $charmprice;
                                            $procart->printside = $request->printside;
                                            $procart->colortype = $request->colortype;
                                            $procart->location = $request->location;
                                            $procart->flowerss_type = $request->flowerss_type;
                                            $procart->datee = $request->datee;
                                            $procart->timee = $request->timee;
                                            $procart->pickup_type = $request->pickup_type;
                                            $procart->comment = $request->comment;
                                            $procart->giftwrap_price = $request->giftwrap_price;
                                            $procart->description = $request->description;
                                            if ($request->giftwrap == '') {
                                                $procart->giftwrap = '0';
                                            } elseif ($request->giftwrap	== 'on') {
                                                $procart->giftwrap = '1';
                                            }
                                            if ($request->hasfile('imageupload')) {
                                                @unlink(public_path('uploads/images/'.$procart->imageupload));
                                                $file = $request->file('imageupload');
                                                $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                                $file->move(public_path('uploads/images'), $filename);
                                                $procart->imageupload = $filename;
                                            }
                                            if ($request->hasfile('logoupload')) {
                                                @unlink(public_path('uploads/images/'.$procart->logoupload));
                                                $file = $request->file('logoupload');
                                                $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                                $file->move(public_path('uploads/images'), $filename1);
                                                $procart->logoupload = $filename1;
                                            }
                                            $procart->save();
                                            $len = $request->imageupload;
                                            for ($i = 0; $i < $len; $i++) {
                                               //return $request->hasfile('imageupload'.$i);
                                               if($request->hasfile('imageupload'.$i))
                                               {
                                                $image = $request->file('imageupload'.$i);
                                                 //  return $request->hasfile('imageupload'.$i);
                                                 //  foreach(($request->file('imageupload'.$i)) as $image)
                                                  // {
                                                       $name=time().uniqid(). '.' . $image->getClientOriginalName();
                                                       $image->move(public_path().'/uploads/images/', $name);
                                                       $data[] = $name;

                                                       $product_images= new StoreProductCartImage();
                                                       $product_images->product_id = $request->product_id;
                                                       $product_images->session_id = Session::getId();
                                                       $product_images->user_id = Auth::user()->id;
                                                       $product_images->product_cart_id = $procart->id;
                                                       $product_images->cart_images = $name;
                                                       $product_images->save();
                                                   //}
                                               }
                                            }
                                            $lenlog = $request->logoupload;
                                            for ($x = 0; $x < $lenlog; $x++) {
                                               //return $request->hasfile('imageupload'.$i);
                                               if($request->hasfile('logoupload'.$x))
                                               {
                                                $logo = $request->file('logoupload'.$x);
                                                 //  return $request->hasfile('imageupload'.$i);
                                                 //  foreach(($request->file('imageupload'.$i)) as $image)
                                                  // {
                                                       $name1=time().uniqid(). '.' . $logo->getClientOriginalName();
                                                       $logo->move(public_path().'/uploads/images/', $name1);
                                                       $data1[] = $name1;

                                                       $product_logo= new StoreProductCartLogo();
                                                       $product_logo->product_id = $request->product_id;
                                                       $product_logo->session_id = Session::getId();
                                                       $product_logo->user_id = Auth::user()->id;
                                                       $product_logo->product_cart_id = $procart->id;
                                                       $product_logo->cart_logo = $name1;
                                                       $product_logo->save();
                                                   //}
                                               }
                                            }
                                            $checkimage = StoreProductCartImage::where('product_cart_id',$procart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                            ->where('user_id', Auth::user()->id)->get();
                                            if ($checkimage->count() > 0) {
                                                foreach ($checkimage as $checkimage) {
                                                    $ckimg[] = $checkimage->id;
                                                }
                                                $ckim = implode(',', $ckimg);
                                            }else{
                                                $ckim = null;
                                            }
                                            $checklogo = StoreProductCartLogo::where('product_cart_id',$procart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                            ->where('user_id', Auth::user()->id)->get();
                                            if ($checklogo->count() > 0) {
                                                foreach ($checklogo as $checklogo) {
                                                    $cklog[] = $checklogo->id;
                                                }
                                                $cklo = implode(',', $cklog);
                                            }else{
                                                $cklo = null;
                                            }

                                        }
                                        $des = StoreCartAttribute::where('session_id', Session::getId())->where('product_id', $request->product_id)->delete();
                                    } else {
                                        $charmprice = 0;
                                        $charmval = StoreCartCharm::where('session_id', Session::getId())->where('product_id', $request->product_id)->get();
                                        if ($charmval->count() > 0) {
                                            foreach ($charmval as $charmval) {
                                                $charmid[] = $charmval->id;
                                                $charmmval[] = $charmval->charm_id;
                                                $charmprice += $charmval->charm_price;
                                            }
                                            $charmidd = implode(',',$charmid);
                                            $charmm = implode(',', $charmmval);
                                        } else {
                                            $charmidd = null;
                                            $charmm = $request->charm;
                                            $charmprice += $request->charm_price;
                                        }
                                        $productcombocart = StoreCartCombo::where('user_id',Auth::user()->id)->where('product_id',$request->product_id)->get();
                                        if ($productcombocart->count() > 0) {
                                            foreach ($productcombocart as $productcombocart) {
                                                $productcombocartval[] = $productcombocart->id;
                                            }
                                            $comval = implode(',', $productcombocartval);
                                        } else {
                                            $comval = null;
                                        }
                                        $productcart = new ProductCart();
                                        $productcart->egg_type = $request->eggtype;
                                        $productcart->quantity = $request->quantity;
                                        $productcart->addtext1 = $request->addtext1;
                                        $productcart->addtext2 = $request->addtext2;
                                        $productcart->cart_combo_id = $comval;
                                        $productcart->cart_charm_id = $charmidd;
                                        $productcart->charm_id = $charmm;
                                        $productcart->charm_price = $charmprice;
                                        $productcart->printside = $request->printside;
                                        $productcart->colortype = $request->colortype;
                                        $productcart->location = $request->location;
                                        $productcart->flowerss_type = $request->flowerss_type;
                                        $productcart->datee = $request->datee;
                                        $productcart->timee = $request->timee;
                                        $productcart->pickup_type = $request->pickup_type;
                                        $productcart->giftwrap_price = $request->giftwrap_price;
                                        $productcart->description = $request->description;
                                        $productcart->comment = $request->comment;
                                        if ($request->giftwrap == '') {
                                            $productcart->giftwrap = '0';
                                        } elseif ($request->giftwrap	== 'on') {
                                            $productcart->giftwrap = '1';
                                        }
                                        if ($request->hasfile('imageupload')) {
                                            $file = $request->file('imageupload');
                                            $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                            $file->move(public_path('uploads/images'), $filename1);
                                            $productcart->imageupload = $filename1;
                                        }
                                        if ($request->hasfile('logoupload')) {
                                            $file = $request->file('logoupload');
                                            $filename2 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                            $file->move(public_path('uploads/images'), $filename2);
                                            $productcart->logoupload = $filename2;
                                        }
                                        $productcart->save();
                                        $productcombocart = StoreCartCombo::where('user_id',Auth::user()->id)->where('product_id',$request->product_id)->get();
                                        if ($productcombocart->count() > 0) {
                                            foreach ($productcombocart as $productcombocart) {
                                                $productcombocartval[] = $productcombocart->id;
                                            }
                                            $comval = implode(',', $productcombocartval);
                                        } else {
                                            $comval = null;
                                        }
                                        $len = $request->imageupload;
                                        for ($i = 0; $i < $len; $i++) {
                                           //return $request->hasfile('imageupload'.$i);
                                           if($request->hasfile('imageupload'.$i))
                                           {
                                            $image = $request->file('imageupload'.$i);
                                             //  return $request->hasfile('imageupload'.$i);
                                             //  foreach(($request->file('imageupload'.$i)) as $image)
                                              // {
                                                   $name=time().uniqid(). '.' . $image->getClientOriginalName();
                                                   $image->move(public_path().'/uploads/images/', $name);
                                                   $data[] = $name;

                                                   $product_images= new StoreProductCartImage();
                                                   $product_images->product_id = $request->product_id;
                                                   $product_images->session_id = Session::getId();
                                                   $product_images->user_id = Auth::user()->id;
                                                   $product_images->product_cart_id = $productcart->id;
                                                   $product_images->cart_images = $name;
                                                   $product_images->save();
                                               //}
                                           }
                                        }
                                        $lenlog = $request->logoupload;
                                        for ($x = 0; $x < $lenlog; $x++) {
                                           //return $request->hasfile('imageupload'.$i);
                                           if($request->hasfile('logoupload'.$x))
                                           {
                                            $logo = $request->file('logoupload'.$x);
                                             //  return $request->hasfile('imageupload'.$i);
                                             //  foreach(($request->file('imageupload'.$i)) as $image)
                                              // {
                                                   $name1=time().uniqid(). '.' . $logo->getClientOriginalName();
                                                   $logo->move(public_path().'/uploads/images/', $name1);
                                                   $data1[] = $name1;

                                                   $product_logo= new StoreProductCartLogo();
                                                   $product_logo->product_id = $request->product_id;
                                                   $product_logo->session_id = Session::getId();
                                                   $product_logo->user_id = Auth::user()->id;
                                                   $product_images->product_cart_id = $productcart->id;
                                                   $product_logo->cart_logo = $name1;
                                                   $product_logo->save();
                                               //}
                                           }
                                        }
                                        $checkimage = StoreProductCartImage::where('product_cart_id',$productcart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                        ->where('user_id', Auth::user()->id)->get();
                                        if ($checkimage->count() > 0) {
                                            foreach ($checkimage as $checkimage) {
                                                $ckimg[] = $checkimage->id;
                                            }
                                            $ckim = implode(',', $ckimg);
                                        }else{
                                            $ckim = null;
                                        }
                                        $checklogo = StoreProductCartLogo::where('product_cart_id',$productcart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                        ->where('user_id', Auth::user()->id)->get();
                                        if ($checklogo->count() > 0) {
                                            foreach ($checklogo as $checklogo) {
                                                $cklog[] = $checklogo->id;
                                            }
                                            $cklo = implode(',', $cklog);
                                        }else{
                                            $cklo = null;
                                        }
                                        $cart = new Cart();
                                        $cart->session_id = $request->session_id;
                                        $cart->user_id = Auth::user()->id;
                                        $cart->product_id = $request->product_id;
                                        $cart->variation_id = $request->variation_id;
                                        $cart->price = $request->price;
                                        $cart->quantity = $request->quantity;
                                        $cart->product_cart_id = $productcart->id;
                                        $cart->product_combo_id =$comval;
                                        $cart->product_images_id = $ckim;
                                        $cart->product_logos_id = $cklo;

                                    }
                                    $cart->save();

                                    $cart_counter = Cart::where('user_id', Auth::user()->id)->count('id');
                                  //  $desch = StoreCartCharm::where('session_id', Session::getId())->where('product_id', $request->product_id)->delete();
                                    $des = StoreCartAttribute::where('session_id', Session::getId())->where('product_id', $request->product_id)->delete();
                                    return response()->json(['status'=>'success','msg' => 'Product Added successfully','cart_counter' => $cart_counter]);
                                }
                            }
                        }else{
                            if ($prodd) {
                                return response()->json(['status'=>'out','msg' => 'Selected Product Is outofstock']);
                            } else {
                                $var2 = StoreCartAttribute::where('session_id', Session::getId())->where('product_id', $request->product_id)->get();
                                if($var2->count() <= 0) {
                                    return response()->json(['status'=>'attribute','msg' => 'Please select attribute']);
                                }
                                foreach ($var2 as $var2) {
                                    $vari2[] = $var2->att_id;
                                }
                                $tags2 = implode(',', $vari2);
                                $var12= AddSubVariation::where('main_attr_value', $tags2)->where('product_id', $request->product_id)->first();
                                $cart = Cart::where('product_id', $request->product_id)->where('variation_id', $var12->id)->where('user_id', Auth::user()->id)->first();
                                if ($cart) {
                                    if($request->quantity == "undefined"){
                                        $charmprice = 0;
                                        $charmval = StoreCartCharm::where('session_id', Session::getId())->where('product_id', $request->product_id)->get();
                                        if ($charmval->count() > 0) {
                                            foreach ($charmval as $charmval) {
                                                $charmid[] = $charmval->id;
                                                $charmmval[] = $charmval->charm_id;
                                                $charmprice += $charmval->charm_price;
                                            }
                                            $charmidd = implode(',',$charmid);
                                            $charmm = implode(',', $charmmval);
                                        } else {
                                            $charmidd = null;
                                            $charmm = $request->charm;
                                            $charmprice += $request->charm_price;
                                        }
                                        $productcombocart = StoreCartCombo::where('user_id',Auth::user()->id)->where('product_id',$request->product_id)->get();
                                        if ($productcombocart->count() > 0) {
                                            foreach ($productcombocart as $productcombocart) {
                                                $productcombocartval[] = $productcombocart->id;
                                            }
                                            $comval = implode(',', $productcombocartval);
                                        } else {
                                            $comval = null;
                                        }
                                        $procart = ProductCart::find($cart->product_cart_id);
                                        $procart->quantity = $request->quantity;
                                        $procart->addtext1 = $request->addtext1;
                                        $procart->egg_type = $request->eggtype;
                                        $procart->addtext2 = $request->addtext2;
                                        $procart->cart_combo_id = $comval;
                                        $procart->cart_charm_id = $charmidd;
                                        $procart->charm_id = $charmm;
                                        $procart->charm_price = $charmprice;
                                        $procart->printside = $request->printside;
                                        $procart->colortype = $request->colortype;
                                        $procart->location = $request->location;
                                        $procart->flowerss_type = $request->flowerss_type;
                                        $procart->datee = $request->datee;
                                        $procart->timee = $request->timee;
                                        $procart->pickup_type = $request->pickup_type;
                                        $procart->comment = $request->comment;
                                        $procart->giftwrap_price = $request->giftwrap_price;
                                        $procart->description = $request->description;
                                        if ($request->giftwrap == '') {
                                            $procart->giftwrap = '0';
                                        } elseif ($request->giftwrap	== 'on') {
                                            $procart->giftwrap = '1';
                                        }
                                        if ($request->hasfile('imageupload')) {
                                            @unlink(public_path('uploads/images/'.$procart->imageupload));
                                            $file = $request->file('imageupload');
                                            $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                            $file->move(public_path('uploads/images'), $filename);
                                            $procart->imageupload = $filename;
                                        }
                                        if ($request->hasfile('logoupload')) {
                                            @unlink(public_path('uploads/images/'.$procart->logoupload));
                                            $file = $request->file('logoupload');
                                            $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                            $file->move(public_path('uploads/images'), $filename1);
                                            $procart->logoupload = $filename1;
                                        }
                                        $procart->save();
                                        $len = $request->imageupload;
                                        for ($i = 0; $i < $len; $i++) {
                                           //return $request->hasfile('imageupload'.$i);
                                           if($request->hasfile('imageupload'.$i))
                                           {
                                            $image = $request->file('imageupload'.$i);
                                             //  return $request->hasfile('imageupload'.$i);
                                             //  foreach(($request->file('imageupload'.$i)) as $image)
                                              // {
                                                   $name=time().uniqid(). '.' . $image->getClientOriginalName();
                                                   $image->move(public_path().'/uploads/images/', $name);
                                                   $data[] = $name;

                                                   $product_images= new StoreProductCartImage();
                                                   $product_images->product_id = $request->product_id;
                                                   $product_images->session_id = Session::getId();
                                                   $product_images->user_id = Auth::user()->id;
                                                   $product_images->cart_images = $name;
                                                   $product_images->product_cart_id = $procart->id;
                                                   $product_images->save();
                                               //}
                                           }
                                        }
                                        $lenlog = $request->logoupload;
                                        for ($x = 0; $x < $lenlog; $x++) {
                                           //return $request->hasfile('imageupload'.$i);
                                           if($request->hasfile('logoupload'.$x))
                                           {
                                            $logo = $request->file('logoupload'.$x);
                                             //  return $request->hasfile('imageupload'.$i);
                                             //  foreach(($request->file('imageupload'.$i)) as $image)
                                              // {
                                                   $name1=time().uniqid(). '.' . $logo->getClientOriginalName();
                                                   $logo->move(public_path().'/uploads/images/', $name1);
                                                   $data1[] = $name1;

                                                   $product_logo= new StoreProductCartLogo();
                                                   $product_logo->product_id = $request->product_id;
                                                   $product_logo->session_id = Session::getId();
                                                   $product_logo->product_cart_id = $procart->id;
                                                   $product_logo->user_id = Auth::user()->id;
                                                   $product_logo->cart_logo = $name1;
                                                   $product_logo->save();
                                               //}
                                           }
                                        }
                                        $checkimage = StoreProductCartImage::where('product_cart_id',$procart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                        ->where('user_id', Auth::user()->id)->get();
                                        if ($checkimage->count() > 0) {
                                            foreach ($checkimage as $checkimage) {
                                                $ckimg[] = $checkimage->id;
                                            }
                                            $ckim = implode(',', $ckimg);
                                        }else{
                                            $ckim = null;
                                        }
                                        $checklogo = StoreProductCartLogo::where('product_cart_id',$procart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                        ->where('user_id', Auth::user()->id)->get();
                                        if ($checklogo->count() > 0) {
                                            foreach ($checklogo as $checklogo) {
                                                $cklog[] = $checklogo->id;
                                            }
                                            $cklo = implode(',', $cklog);
                                        }else{
                                            $cklo = null;
                                        }
                                    }else{
                                        $quant2 = $cart->quantity + $request->quantity;
                                        $data=Cart::where('user_id', Auth::user()->id)->where('variation_id', $var12->id)->where('product_id', $request->product_id)
                                                ->update([
                                                    'quantity' => $quant2,
                                                    ]);
                                        $charmprice = 0;
                                        $charmval = StoreCartCharm::where('session_id', Session::getId())->where('product_id', $request->product_id)->get();
                                        if ($charmval->count() > 0) {
                                            foreach ($charmval as $charmval) {
                                                $charmid[] = $charmval->id;
                                                $charmmval[] = $charmval->charm_id;
                                                $charmprice += $charmval->charm_price;
                                            }
                                            $charmidd = implode(',',$charmid);
                                            $charmm = implode(',', $charmmval);
                                        } else {
                                            $charmidd = null;
                                            $charmm = $request->charm;
                                            $charmprice += $request->charm_price;
                                        }
                                        $productcombocart = StoreCartCombo::where('user_id',Auth::user()->id)->where('product_id',$request->product_id)->get();
                                        if ($productcombocart->count() > 0) {
                                            foreach ($productcombocart as $productcombocart) {
                                                $productcombocartval[] = $productcombocart->id;
                                            }
                                            $comval = implode(',', $productcombocartval);
                                        } else {
                                            $comval = null;
                                        }
                                        $procart = ProductCart::find($cart->product_cart_id);
                                        $procart->quantity = $quant2;
                                        $procart->addtext1 = $request->addtext1;
                                        $procart->egg_type = $request->eggtype;
                                        $procart->addtext2 = $request->addtext2;
                                        $procart->cart_combo_id = $comval;
                                        $procart->cart_charm_id = $charmidd;
                                        $procart->charm_id = $charmm;
                                        $procart->charm_price = $charmprice;
                                        $procart->printside = $request->printside;
                                        $procart->colortype = $request->colortype;
                                        $procart->location = $request->location;
                                        $procart->flowerss_type = $request->flowerss_type;
                                        $procart->datee = $request->datee;
                                        $procart->timee = $request->timee;
                                        $procart->pickup_type = $request->pickup_type;
                                        $procart->comment = $request->comment;
                                        $procart->giftwrap_price = $request->giftwrap_price;
                                        $procart->description = $request->description;
                                        if ($request->giftwrap == '') {
                                            $procart->giftwrap = '0';
                                        } elseif ($request->giftwrap	== 'on') {
                                            $procart->giftwrap = '1';
                                        }
                                        if ($request->hasfile('imageupload')) {
                                            @unlink(public_path('uploads/images/'.$procart->imageupload));
                                            $file = $request->file('imageupload');
                                            $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                            $file->move(public_path('uploads/images'), $filename);
                                            $procart->imageupload = $filename;
                                        }
                                        if ($request->hasfile('logoupload')) {
                                            @unlink(public_path('uploads/images/'.$procart->logoupload));
                                            $file = $request->file('logoupload');
                                            $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                            $file->move(public_path('uploads/images'), $filename1);
                                            $procart->logoupload = $filename1;
                                        }
                                        $procart->save();
                                        $len = $request->imageupload;
                                        for ($i = 0; $i < $len; $i++) {
                                           //return $request->hasfile('imageupload'.$i);
                                           if($request->hasfile('imageupload'.$i))
                                           {
                                            $image = $request->file('imageupload'.$i);
                                             //  return $request->hasfile('imageupload'.$i);
                                             //  foreach(($request->file('imageupload'.$i)) as $image)
                                              // {
                                                   $name=time().uniqid(). '.' . $image->getClientOriginalName();
                                                   $image->move(public_path().'/uploads/images/', $name);
                                                   $data[] = $name;

                                                   $product_images= new StoreProductCartImage();
                                                   $product_images->product_id = $request->product_id;
                                                   $product_images->session_id = Session::getId();
                                                   $product_images->user_id = Auth::user()->id;
                                                   $product_images->cart_images = $name;
                                                   $product_images->product_cart_id = $procart->id;
                                                   $product_images->save();
                                               //}
                                           }
                                        }
                                        $lenlog = $request->logoupload;
                                        for ($x = 0; $x < $lenlog; $x++) {
                                           //return $request->hasfile('imageupload'.$i);
                                           if($request->hasfile('logoupload'.$x))
                                           {
                                            $logo = $request->file('logoupload'.$x);
                                             //  return $request->hasfile('imageupload'.$i);
                                             //  foreach(($request->file('imageupload'.$i)) as $image)
                                              // {
                                                   $name1=time().uniqid(). '.' . $logo->getClientOriginalName();
                                                   $logo->move(public_path().'/uploads/images/', $name1);
                                                   $data1[] = $name1;

                                                   $product_logo= new StoreProductCartLogo();
                                                   $product_logo->product_id = $request->product_id;
                                                   $product_logo->session_id = Session::getId();
                                                   $product_logo->user_id = Auth::user()->id;
                                                   $product_logo->product_cart_id = $procart->id;
                                                   $product_logo->cart_logo = $name1;
                                                   $product_logo->save();
                                               //}
                                           }
                                        }
                                        $checkimage = StoreProductCartImage::where('product_cart_id',$procart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                        ->where('user_id', Auth::user()->id)->get();
                                        if ($checkimage->count() > 0) {
                                            foreach ($checkimage as $checkimage) {
                                                $ckimg[] = $checkimage->id;
                                            }
                                            $ckim = implode(',', $ckimg);
                                        }else{
                                            $ckim = null;
                                        }
                                        $checklogo = StoreProductCartLogo::where('product_cart_id',$procart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                        ->where('user_id', Auth::user()->id)->get();
                                        if ($checklogo->count() > 0) {
                                            foreach ($checklogo as $checklogo) {
                                                $cklog[] = $checklogo->id;
                                            }
                                            $cklo = implode(',', $cklog);
                                        }else{
                                            $cklo = null;
                                        }

                                    }
                                    $des = StoreCartAttribute::where('session_id', Session::getId())->where('product_id', $request->product_id)->delete();
                                } else {
                                    $charmprice = 0;
                                    $charmval = StoreCartCharm::where('session_id', Session::getId())->where('product_id', $request->product_id)->get();
                                    if ($charmval->count() > 0) {
                                        foreach ($charmval as $charmval) {
                                            $charmid[] = $charmval->id;
                                            $charmmval[] = $charmval->charm_id;
                                            $charmprice += $charmval->charm_price;
                                        }
                                        $charmidd = implode(',',$charmid);
                                        $charmm = implode(',', $charmmval);
                                    } else {
                                        $charmidd = null;
                                        $charmm = $request->charm;
                                        $charmprice += $request->charm_price;
                                    }
                                    $productcombocart = StoreCartCombo::where('user_id',Auth::user()->id)->where('product_id',$request->product_id)->get();
                                    if ($productcombocart->count() > 0) {
                                        foreach ($productcombocart as $productcombocart) {
                                            $productcombocartval[] = $productcombocart->id;
                                        }
                                        $comval = implode(',', $productcombocartval);
                                    } else {
                                        $comval = null;
                                    }
                                    $productcart = new ProductCart();
                                    $productcart->egg_type = $request->eggtype;
                                    $productcart->quantity = $request->quantity;
                                    $productcart->addtext1 = $request->addtext1;
                                    $productcart->addtext2 = $request->addtext2;
                                    $productcart->cart_combo_id = $comval;
                                    $productcart->cart_charm_id = $charmidd;
                                    $productcart->charm_id = $charmm;
                                    $productcart->charm_price = $charmprice;
                                    $productcart->printside = $request->printside;
                                    $productcart->colortype = $request->colortype;
                                    $productcart->location = $request->location;
                                    $productcart->flowerss_type = $request->flowerss_type;
                                    $productcart->datee = $request->datee;
                                    $productcart->timee = $request->timee;
                                    $productcart->pickup_type = $request->pickup_type;
                                    $productcart->giftwrap_price = $request->giftwrap_price;
                                    $productcart->description = $request->description;
                                    $productcart->comment = $request->comment;
                                    if ($request->giftwrap == '') {
                                        $productcart->giftwrap = '0';
                                    } elseif ($request->giftwrap	== 'on') {
                                        $productcart->giftwrap = '1';
                                    }
                                    if ($request->hasfile('imageupload')) {
                                        $file = $request->file('imageupload');
                                        $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                        $file->move(public_path('uploads/images'), $filename1);
                                        $productcart->imageupload = $filename1;
                                    }
                                    if ($request->hasfile('logoupload')) {
                                        $file = $request->file('logoupload');
                                        $filename2 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                        $file->move(public_path('uploads/images'), $filename2);
                                        $productcart->logoupload = $filename2;
                                    }
                                    $productcart->save();
                                    $productcombocart = StoreCartCombo::where('user_id',Auth::user()->id)->where('product_id',$request->product_id)->get();
                                    if ($productcombocart->count() > 0) {
                                        foreach ($productcombocart as $productcombocart) {
                                            $productcombocartval[] = $productcombocart->id;
                                        }
                                        $comval = implode(',', $productcombocartval);
                                    } else {
                                        $comval = null;
                                    }
                                    $len = $request->imageupload;
                                        for ($i = 0; $i < $len; $i++) {
                                        //return $request->hasfile('imageupload'.$i);
                                        if($request->hasfile('imageupload'.$i))
                                        {
                                            $image = $request->file('imageupload'.$i);
                                            //  return $request->hasfile('imageupload'.$i);
                                            //  foreach(($request->file('imageupload'.$i)) as $image)
                                            // {
                                                $name=time().uniqid(). '.' . $image->getClientOriginalName();
                                                $image->move(public_path().'/uploads/images/', $name);
                                                $data[] = $name;

                                                $product_images= new StoreProductCartImage();
                                                $product_images->product_id = $request->product_id;
                                                $product_images->session_id = Session::getId();
                                                $product_images->user_id = Auth::user()->id;
                                                $product_images->cart_images = $name;
                                                $product_images->product_cart_id = $productcart->id;
                                                $product_images->save();
                                            //}
                                        }
                                        }
                                        $lenlog = $request->logoupload;
                                        for ($x = 0; $x < $lenlog; $x++) {
                                        //return $request->hasfile('imageupload'.$i);
                                        if($request->hasfile('logoupload'.$x))
                                        {
                                            $logo = $request->file('logoupload'.$x);
                                            //  return $request->hasfile('imageupload'.$i);
                                            //  foreach(($request->file('imageupload'.$i)) as $image)
                                            // {
                                                $name1=time().uniqid(). '.' . $logo->getClientOriginalName();
                                                $logo->move(public_path().'/uploads/images/', $name1);
                                                $data1[] = $name1;

                                                $product_logo= new StoreProductCartLogo();
                                                $product_logo->product_id = $request->product_id;
                                                $product_logo->session_id = Session::getId();
                                                $product_logo->user_id = Auth::user()->id;
                                                $product_logo->cart_logo = $name1;
                                                $product_logo->product_cart_id = $productcart->id;
                                                $product_logo->save();
                                            //}
                                        }
                                        }
                                        $checkimage = StoreProductCartImage::where('product_cart_id',$productcart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                        ->where('user_id', Auth::user()->id)->get();
                                        if ($checkimage->count() > 0) {
                                            foreach ($checkimage as $checkimage) {
                                                $ckimg[] = $checkimage->id;
                                            }
                                            $ckim = implode(',', $ckimg);
                                        }else{
                                            $ckim = null;
                                        }
                                        $checklogo = StoreProductCartLogo::where('product_cart_id',$productcart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                        ->where('user_id', Auth::user()->id)->get();
                                        if ($checklogo->count() > 0) {
                                            foreach ($checklogo as $checklogo) {
                                                $cklog[] = $checklogo->id;
                                            }
                                            $cklo = implode(',', $cklog);
                                        }else{
                                            $cklo = null;
                                        }
                                    $cart = new Cart();
                                    $cart->session_id = $request->session_id;
                                    $cart->user_id = Auth::user()->id;
                                    $cart->product_id = $request->product_id;
                                    $cart->variation_id = $request->variation_id;
                                    $cart->price = $request->price;
                                    $cart->quantity = $request->quantity;
                                    $cart->product_cart_id = $productcart->id;
                                    $cart->product_combo_id =$comval;
                                    $cart->product_images_id = $ckim;
                                    $cart->product_logos_id = $cklo;
                                }
                                $cart->save();
                                $cart_counter = Cart::where('user_id', Auth::user()->id)->count('id');
                                //$desch = StoreCartCharm::where('session_id', Session::getId())->where('product_id', $request->product_id)->delete();
                                $des = StoreCartAttribute::where('session_id', Session::getId())->where('product_id', $request->product_id)->delete();
                                return response()->json(['status'=>'success','msg' => 'Product Added successfully','cart_counter' => $cart_counter]);
                            }
                        }
                }else{
                    return response()->json(['status'=>'attribute','msg' => "Selected Atrribute Doesn't Exisits"]);
                }
            }else{
                return response()->json(['status'=>'selected','msg' => 'Please Login As User To Add More Products']);
            }
        }else{
            return response()->json(['status'=>'failure','msg' => 'Please Login']);
        }
    }


// Simple Product Add to Cart
    public function addToCart(Request $request)
    {
        if (!empty($request->imageval)) {
            $allowedfileExtension = ['jpeg','jpg','png'];
            if ($request->imageupload > $request->imageval) {
                return response()->json(['status'=>'error','msg' => 'Sorry! Maximum allowed images are'.$request->imageval]);
            //return 'Sorry! Maximum allowed images are'.$request->imageval;
            } else {
                $len = $request->imageupload;
                for ($i = 0; $i < $len; $i++) {
                    if ($request->hasfile('imageupload'.$i)) {
                        $image = $request->file('imageupload'.$i);
                        $sizeofimg = $request->file('imageupload'.$i)->getSize();
                        $extension = $image->getClientOriginalExtension();
                        $check = in_array($extension, $allowedfileExtension);
                        // Checking the image extension
                        if (!$check) {
                            return response()->json(['status'=>'error','msg' => 'Images must be  jpeg or jpg or png!']);
                            //return 'Images must be  jpeg or jpg or png!';
                        }
                        if ($sizeofimg > $request->imagesiz) {
                            return response()->json(['status'=>'error','msg' => 'Sorry! Maximum allowed size for an image is'.$request->imagesiz.'bytes']);
                            //return 'Sorry! Maximum allowed size for an image is'.$request->imagesiz.'bytes';
                        }
                    }
                }
            }
        }
        if (!empty($request->logoval)) {
            $allowedfileExtensionn = ['jpeg','jpg','png'];
            $request->logoval;
            if ($request->logoupload > $request->logoval) {
                return response()->json(['status'=>'error','msg' => 'Sorry! Maximum allowed images are'.$request->logoval]);
            //return 'Sorry! Maximum allowed images are'.$request->imageval;
            } else {
                $loglen = $request->logoupload;
                for ($j = 0; $j < $loglen; $j++) {
                    if ($request->hasfile('logoupload'.$j)) {
                        $logoo = $request->file('logoupload'.$j);
                        $sizeoflogo = $request->file('logoupload'.$j)->getSize();
                        $extensionlogo = $logoo->getClientOriginalExtension();
                        $checklogo = in_array($extensionlogo, $allowedfileExtensionn);
                        // Checking the image extension
                        if (!$checklogo) {
                            return response()->json(['status'=>'error','msg' => 'Image must be  jpeg or jpg or png!']);
                            //return 'Images must be  jpeg or jpg or png!';
                        }
                        if ($sizeoflogo > $request->logosiz) {
                            return response()->json(['status'=>'error','msg' => 'Sorry! Maximum allowed size for an image is'.$request->logosiz.'bytes']);
                            //return 'Sorry! Maximum allowed size for an image is'.$request->imagesiz.'bytes';
                        }
                    }
                }
            }
        }

         if (Auth::check()) {
            $user = User::where('id',Auth::user()->id)->where('role_id','3')->first();
            if ($user) {
                    $prodd = Product::where('status','Active')->where('stock_status', 'outofstock')->where('id', $request->product_id)->first();
                    $proddq = Product::where('status','Active')->where('id', $request->product_id)->first();
                    if($request->quantity != "undefined")
                    {
                        $quant = $request->quantity;
                    }else{
                        $quant = null;
                    }
                    if ($proddq->quantity != null) {
                        if ($proddq->quantity < $quant) {
                            return response()->json(['status'=>'greate','msg' => 'Selected Quantity is greater']);
                        } else {
                            if ($prodd) {
                                return response()->json(['status'=>'out','msg' => 'Selected Product Is outofstock']);
                            } else {
                                $cart = Cart::where('product_id', $request->product_id)->where('user_id', Auth::user()->id)->first();
                                if ($cart) {
                                    if($request->quantity == "undefined"){
                                        $charmprice = 0;
                                        $charmval = StoreCartCharm::where('session_id', Session::getId())->where('product_id', $request->product_id)->get();
                                        if ($charmval->count() > 0) {
                                            foreach ($charmval as $charmval) {
                                                $charmmval[] = $charmval->charm_id;
                                                $charmprice += $charmval->charm_price;
                                            }
                                            $charmm = implode(',', $charmmval);
                                        } else {
                                            $charmm = $request->charm;
                                            $charmprice += $request->charm_price;
                                        }
                                        $procart = ProductCart::find($cart->product_cart_id);
                                        $procart->quantity = $request->quantity;
                                        $procart->addtext1 = $request->addtext1;
                                        $procart->egg_type = $request->eggtype;
                                        $procart->addtext2 = $request->addtext2;
                                        $procart->charm_id = $charmm;
                                        $procart->charm_price = $charmprice;
                                        $procart->printside = $request->printside;
                                        $procart->colortype = $request->colortype;
                                        $procart->location = $request->location;
                                        $procart->flowerss_type = $request->flowerss_type;
                                        $procart->datee = $request->datee;
                                        $procart->timee = $request->timee;
                                        $procart->pickup_type = $request->pickup_type;
                                        $procart->comment = $request->comment;
                                        $procart->giftwrap_price = $request->giftwrap_price;
                                        $procart->description = $request->description;
                                        if ($request->giftwrap == '') {
                                            $procart->giftwrap = '0';
                                        } elseif ($request->giftwrap	== 'on') {
                                            $procart->giftwrap = '1';
                                        }
                                        $request->hasfile('imageupload');
                                        if ($request->hasfile('imageupload')) {
                                            @unlink(public_path('uploads/images/'.$procart->imageupload));
                                            $file = $request->file('imageupload');
                                            $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                            $file->move(public_path('uploads/images'), $filename);
                                            $procart->imageupload = $filename;
                                        }
                                        if ($request->hasfile('logoupload')) {
                                            @unlink(public_path('uploads/images/'.$procart->logoupload));
                                            $file = $request->file('logoupload');
                                            $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                            $file->move(public_path('uploads/images'), $filename1);
                                            $procart->logoupload = $filename1;
                                        }
                                        $procart->save();
                                        $len = $request->imageupload;
                                            for ($i = 0; $i < $len; $i++) {
                                            //return $request->hasfile('imageupload'.$i);
                                            if($request->hasfile('imageupload'.$i))
                                            {
                                                $image = $request->file('imageupload'.$i);
                                                //  return $request->hasfile('imageupload'.$i);
                                                //  foreach(($request->file('imageupload'.$i)) as $image)
                                                // {
                                                    $name=time().uniqid(). '.' . $image->getClientOriginalName();
                                                    $image->move(public_path().'/uploads/images/', $name);
                                                    $data[] = $name;

                                                    $product_images= new StoreProductCartImage();
                                                    $product_images->product_id = $request->product_id;
                                                    $product_images->session_id = Session::getId();
                                                    $product_images->product_cart_id = $procart->id;
                                                    $product_images->user_id = Auth::user()->id;
                                                    $product_images->cart_images = $name;
                                                    $product_images->save();
                                                //}
                                            }
                                            }
                                            $lenlog = $request->logoupload;
                                            for ($x = 0; $x < $lenlog; $x++) {
                                            //return $request->hasfile('imageupload'.$i);
                                            if($request->hasfile('logoupload'.$x))
                                            {
                                                $logo = $request->file('logoupload'.$x);
                                                //  return $request->hasfile('imageupload'.$i);
                                                //  foreach(($request->file('imageupload'.$i)) as $image)
                                                // {
                                                    $name1=time().uniqid(). '.' . $logo->getClientOriginalName();
                                                    $logo->move(public_path().'/uploads/images/', $name1);
                                                    $data1[] = $name1;

                                                    $product_logo= new StoreProductCartLogo();
                                                    $product_logo->product_id = $request->product_id;
                                                    $product_logo->session_id = Session::getId();
                                                    $product_logo->user_id = Auth::user()->id;
                                                    $product_logo->product_cart_id = $procart->id;
                                                    $product_logo->cart_logo = $name1;
                                                    $product_logo->save();
                                                //}
                                            }
                                            }
                                        $checkimage = StoreProductCartImage::where('product_cart_id',$procart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                        ->where('user_id', Auth::user()->id)->get();
                                        if ($checkimage->count() > 0) {
                                            foreach ($checkimage as $checkimage) {
                                                $ckimg[] = $checkimage->id;
                                            }
                                            $ckim = implode(',', $ckimg);
                                        }else{
                                            $ckim = null;
                                        }
                                        $checklogo = StoreProductCartLogo::where('product_cart_id',$procart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                        ->where('user_id', Auth::user()->id)->get();
                                        if ($checklogo->count() > 0) {
                                            foreach ($checklogo as $checklogo) {
                                                $cklog[] = $checklogo->id;
                                            }
                                            $cklo = implode(',', $cklog);
                                        }else{
                                            $cklo = null;
                                        }

                                    }else{
                                        $quant = $cart->quantity + $request->quantity;
                                        $data=Cart::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)
                                            ->update([
                                                'quantity' => $quant,
                                                ]);
                                        $charmprice = 0;
                                        $charmval = StoreCartCharm::where('session_id', Session::getId())->where('product_id', $request->product_id)->get();
                                        if ($charmval->count() > 0) {
                                            foreach ($charmval as $charmval) {
                                                $charmmval[] = $charmval->charm_id;
                                                $charmprice += $charmval->charm_price;
                                            }
                                            $charmm = implode(',', $charmmval);
                                        } else {
                                            $charmm = $request->charm;
                                            $charmprice += $request->charm_price;
                                        }
                                        $procart = ProductCart::find($cart->product_cart_id);
                                        $procart->quantity = $quant;
                                        $procart->addtext1 = $request->addtext1;
                                        $procart->egg_type = $request->eggtype;
                                        $procart->addtext2 = $request->addtext2;
                                        $procart->charm_id = $charmm;
                                        $procart->charm_price = $charmprice;
                                        $procart->printside = $request->printside;
                                        $procart->colortype = $request->colortype;
                                        $procart->location = $request->location;
                                        $procart->flowerss_type = $request->flowerss_type;
                                        $procart->datee = $request->datee;
                                        $procart->timee = $request->timee;
                                        $procart->pickup_type = $request->pickup_type;
                                        $procart->comment = $request->comment;
                                        $procart->giftwrap_price = $request->giftwrap_price;
                                        $procart->description = $request->description;
                                        if ($request->giftwrap == '') {
                                            $procart->giftwrap = '0';
                                        } elseif ($request->giftwrap	== 'on') {
                                            $procart->giftwrap = '1';
                                        }
                                        $request->hasfile('imageupload');
                                        if ($request->hasfile('imageupload')) {
                                            @unlink(public_path('uploads/images/'.$procart->imageupload));
                                            $file = $request->file('imageupload');
                                            $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                            $file->move(public_path('uploads/images'), $filename);
                                            $procart->imageupload = $filename;
                                        }
                                        if ($request->hasfile('logoupload')) {
                                            @unlink(public_path('uploads/images/'.$procart->logoupload));
                                            $file = $request->file('logoupload');
                                            $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                            $file->move(public_path('uploads/images'), $filename1);
                                            $procart->logoupload = $filename1;
                                        }
                                        $procart->save();
                                        $len = $request->imageupload;
                                        for ($i = 0; $i < $len; $i++) {
                                           //return $request->hasfile('imageupload'.$i);
                                           if($request->hasfile('imageupload'.$i))
                                           {
                                            $image = $request->file('imageupload'.$i);
                                             //  return $request->hasfile('imageupload'.$i);
                                             //  foreach(($request->file('imageupload'.$i)) as $image)
                                              // {
                                                   $name=time().uniqid(). '.' . $image->getClientOriginalName();
                                                   $image->move(public_path().'/uploads/images/', $name);
                                                   $data[] = $name;

                                                   $product_images= new StoreProductCartImage();
                                                   $product_images->product_id = $request->product_id;
                                                   $product_images->session_id = Session::getId();
                                                   $product_images->user_id = Auth::user()->id;
                                                   $product_images->cart_images = $name;
                                                   $product_images->product_cart_id = $procart->id;
                                                   $product_images->save();
                                               //}
                                           }
                                        }
                                        $lenlog = $request->logoupload;
                                        for ($x = 0; $x < $lenlog; $x++) {
                                           //return $request->hasfile('imageupload'.$i);
                                           if($request->hasfile('logoupload'.$x))
                                           {
                                            $logo = $request->file('logoupload'.$x);
                                             //  return $request->hasfile('imageupload'.$i);
                                             //  foreach(($request->file('imageupload'.$i)) as $image)
                                              // {
                                                   $name1=time().uniqid(). '.' . $logo->getClientOriginalName();
                                                   $logo->move(public_path().'/uploads/images/', $name1);
                                                   $data1[] = $name1;

                                                   $product_logo= new StoreProductCartLogo();
                                                   $product_logo->product_id = $request->product_id;
                                                   $product_logo->session_id = Session::getId();
                                                   $product_logo->user_id = Auth::user()->id;
                                                   $product_logo->product_cart_id = $procart->id;
                                                   $product_logo->cart_logo = $name1;
                                                   $product_logo->save();
                                               //}
                                           }
                                        }
                                        $checkimage = StoreProductCartImage::where('product_cart_id',$procart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                        ->where('user_id', Auth::user()->id)->get();
                                        if ($checkimage->count() > 0) {
                                            foreach ($checkimage as $checkimage) {
                                                $ckimg[] = $checkimage->id;
                                            }
                                            $ckim = implode(',', $ckimg);
                                        }else{
                                            $ckim = null;
                                        }
                                        $checklogo = StoreProductCartLogo::where('product_cart_id',$procart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                        ->where('user_id', Auth::user()->id)->get();
                                        if ($checklogo->count() > 0) {
                                            foreach ($checklogo as $checklogo) {
                                                $cklog[] = $checklogo->id;
                                            }
                                            $cklo = implode(',', $cklog);
                                        }else{
                                            $cklo = null;
                                        }

                                    }
                                } else {
                                    $request->all();
                                    $charmprice = 0;
                                    $charmval = StoreCartCharm::where('session_id', Session::getId())->where('product_id', $request->product_id)->get();
                                    if ($charmval->count() > 0) {
                                        foreach ($charmval as $charmval) {
                                            $charmmval[] = $charmval->charm_id;
                                            $charmprice += $charmval->charm_price;
                                        }
                                        $charmm = implode(',', $charmmval);
                                    } else {
                                        $charmm = $request->charm;
                                        $charmprice += $request->charm_price;
                                    }
                                    $productcart = new ProductCart();
                                    $productcart->egg_type = $request->eggtype;
                                    $productcart->quantity = $request->quantity;
                                    $productcart->addtext1 = $request->addtext1;
                                    $productcart->addtext2 = $request->addtext2;
                                    $productcart->charm_id = $charmm;
                                    $productcart->charm_price = $charmprice;
                                    $productcart->printside = $request->printside;
                                    $productcart->colortype = $request->colortype;
                                    $productcart->location = $request->location;
                                    $productcart->flowerss_type = $request->flowerss_type;
                                    $productcart->datee = $request->datee;
                                    $productcart->timee = $request->timee;
                                    $productcart->pickup_type = $request->pickup_type;
                                    $productcart->giftwrap_price = $request->giftwrap_price;
                                    $productcart->description = $request->description;
                                    $productcart->comment = $request->comment;
                                    if ($request->giftwrap == '') {
                                        $productcart->giftwrap = '0';
                                    } elseif ($request->giftwrap	== 'on') {
                                        $productcart->giftwrap = '1';
                                    }
                                    $request->hasfile('imageupload');
                                    if ($request->hasfile('imageupload')) {
                                        $file = $request->file('imageupload');
                                        $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                        $file->move(public_path('uploads/images'), $filename1);
                                        $productcart->imageupload = $filename1;
                                    }
                                    if ($request->hasfile('logoupload')) {
                                        $file = $request->file('logoupload');
                                        $filename2 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                        $file->move(public_path('uploads/images'), $filename2);
                                        $productcart->logoupload = $filename2;
                                    }
                                    $productcart->save();
                                    $len = $request->imageupload;
                                    for ($i = 0; $i < $len; $i++) {
                                       //return $request->hasfile('imageupload'.$i);
                                       if($request->hasfile('imageupload'.$i))
                                       {
                                        $image = $request->file('imageupload'.$i);
                                         //  return $request->hasfile('imageupload'.$i);
                                         //  foreach(($request->file('imageupload'.$i)) as $image)
                                          // {
                                               $name=time().uniqid(). '.' . $image->getClientOriginalName();
                                               $image->move(public_path().'/uploads/images/', $name);
                                               $data[] = $name;

                                               $product_images= new StoreProductCartImage();
                                               $product_images->product_id = $request->product_id;
                                               $product_images->session_id = Session::getId();
                                               $product_images->user_id = Auth::user()->id;
                                               $product_images->product_cart_id = $productcart->id;
                                               $product_images->cart_images = $name;
                                               $product_images->save();
                                           //}
                                       }
                                    }
                                    $lenlog = $request->logoupload;
                                    for ($x = 0; $x < $lenlog; $x++) {
                                       //return $request->hasfile('imageupload'.$i);
                                       if($request->hasfile('logoupload'.$x))
                                       {
                                        $logo = $request->file('logoupload'.$x);
                                         //  return $request->hasfile('imageupload'.$i);
                                         //  foreach(($request->file('imageupload'.$i)) as $image)
                                          // {
                                               $name1=time().uniqid(). '.' . $logo->getClientOriginalName();
                                               $logo->move(public_path().'/uploads/images/', $name1);
                                               $data1[] = $name1;

                                               $product_logo= new StoreProductCartLogo();
                                               $product_logo->product_id = $request->product_id;
                                               $product_logo->session_id = Session::getId();
                                               $product_logo->user_id = Auth::user()->id;
                                               $product_logo->cart_logo = $name1;
                                               $product_logo->product_cart_id = $productcart->id;
                                               $product_logo->save();
                                           //}
                                       }
                                    }
                                    $checkimage = StoreProductCartImage::where('product_cart_id',$productcart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                    ->where('user_id', Auth::user()->id)->get();
                                    if ($checkimage->count() > 0) {
                                        foreach ($checkimage as $checkimage) {
                                            $ckimg[] = $checkimage->id;
                                        }
                                        $ckim = implode(',', $ckimg);
                                    }else{
                                        $ckim = null;
                                    }
                                    $checklogo = StoreProductCartLogo::where('product_cart_id',$productcart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                    ->where('user_id', Auth::user()->id)->get();
                                    if ($checklogo->count() > 0) {
                                        foreach ($checklogo as $checklogo) {
                                            $cklog[] = $checklogo->id;
                                        }
                                        $cklo = implode(',', $cklog);
                                    }else{
                                        $cklo = null;
                                    }
                                    $cart = new Cart();
                                    $cart->session_id = $request->session_id;
                                    $cart->user_id = Auth::user()->id;
                                    $cart->product_id = $request->product_id;
                                    $cart->price = $request->price;
                                    $cart->quantity = $request->quantity;
                                    $cart->product_cart_id = $productcart->id;
                                    $cart->product_images_id = $ckim;
                                    $cart->product_logos_id = $cklo;
                                }
                                $cart->save();
                                $cart_counter = Cart::where('user_id', Auth::user()->id)->count('id');
                                //$desch = StoreCartCharm::where('session_id', Session::getId())->where('product_id', $request->product_id)->delete();
                                return response()->json(['status'=>'success','msg' => 'Product Added successfully','cart_counter' => $cart_counter]);
                            }
                        }
                    }else{
                        if ($prodd) {
                            return response()->json(['status'=>'out','msg' => 'Selected Product Is outofstock']);
                        } else {
                            $cart = Cart::where('product_id', $request->product_id)->where('user_id', Auth::user()->id)->first();
                            if ($cart) {
                                if($request->quantity =="undefined"){
                                    $charmprice = 0;
                                    $charmval = StoreCartCharm::where('session_id', Session::getId())->where('product_id', $request->product_id)->get();
                                    if ($charmval->count() > 0) {
                                        foreach ($charmval as $charmval) {
                                            $charmmval[] = $charmval->charm_id;
                                            $charmprice += $charmval->charm_price;
                                        }
                                        $charmm = implode(',', $charmmval);
                                    } else {
                                        $charmm = $request->charm;
                                        $charmprice += $request->charm_price;
                                    }
                                    $procart = ProductCart::find($cart->product_cart_id);
                                    $procart->quantity = $request->quantity;
                                    $procart->addtext1 = $request->addtext1;
                                    $procart->egg_type = $request->eggtype;
                                    $procart->addtext2 = $request->addtext2;
                                    $procart->charm_id = $charmm;
                                    $procart->charm_price = $charmprice;
                                    $procart->printside = $request->printside;
                                    $procart->colortype = $request->colortype;
                                    $procart->location = $request->location;
                                    $procart->flowerss_type = $request->flowerss_type;
                                    $procart->datee = $request->datee;
                                    $procart->timee = $request->timee;
                                    $procart->pickup_type = $request->pickup_type;
                                    $procart->comment = $request->comment;
                                    $procart->giftwrap_price = $request->giftwrap_price;
                                    $procart->description = $request->description;
                                    if ($request->giftwrap == '') {
                                        $procart->giftwrap = '0';
                                    } elseif ($request->giftwrap	== 'on') {
                                        $procart->giftwrap = '1';
                                    }
                                    $request->hasfile('imageupload');
                                    if ($request->hasfile('imageupload')) {
                                        @unlink(public_path('uploads/images/'.$procart->imageupload));
                                        $file = $request->file('imageupload');
                                        $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                        $file->move(public_path('uploads/images'), $filename);
                                        $procart->imageupload = $filename;
                                    }
                                    if ($request->hasfile('logoupload')) {
                                        @unlink(public_path('uploads/images/'.$procart->logoupload));
                                        $file = $request->file('logoupload');
                                        $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                        $file->move(public_path('uploads/images'), $filename1);
                                        $procart->logoupload = $filename1;
                                    }
                                    $procart->save();
                                    $len = $request->imageupload;
                                    for ($i = 0; $i < $len; $i++) {
                                       //return $request->hasfile('imageupload'.$i);
                                       if($request->hasfile('imageupload'.$i))
                                       {
                                        $image = $request->file('imageupload'.$i);
                                         //  return $request->hasfile('imageupload'.$i);
                                         //  foreach(($request->file('imageupload'.$i)) as $image)
                                          // {
                                               $name=time().uniqid(). '.' . $image->getClientOriginalName();
                                               $image->move(public_path().'/uploads/images/', $name);
                                               $data[] = $name;

                                               $product_images= new StoreProductCartImage();
                                               $product_images->product_id = $request->product_id;
                                               $product_images->session_id = Session::getId();
                                               $product_images->user_id = Auth::user()->id;
                                               $product_images->cart_images = $name;
                                               $product_images->product_cart_id = $procart->id;
                                               $product_images->save();
                                           //}
                                       }
                                    }
                                    $lenlog = $request->logoupload;
                                    for ($x = 0; $x < $lenlog; $x++) {
                                       //return $request->hasfile('imageupload'.$i);
                                       if($request->hasfile('logoupload'.$x))
                                       {
                                        $logo = $request->file('logoupload'.$x);
                                         //  return $request->hasfile('imageupload'.$i);
                                         //  foreach(($request->file('imageupload'.$i)) as $image)
                                          // {
                                               $name1=time().uniqid(). '.' . $logo->getClientOriginalName();
                                               $logo->move(public_path().'/uploads/images/', $name1);
                                               $data1[] = $name1;

                                               $product_logo= new StoreProductCartLogo();
                                               $product_logo->product_id = $request->product_id;
                                               $product_logo->session_id = Session::getId();
                                               $product_logo->user_id = Auth::user()->id;
                                               $product_logo->cart_logo = $name1;
                                               $product_logo->product_cart_id = $procart->id;
                                               $product_logo->save();
                                           //}
                                       }
                                    }
                                    $checkimage = StoreProductCartImage::where('product_cart_id',$procart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                    ->where('user_id', Auth::user()->id)->get();
                                    if ($checkimage->count() > 0) {
                                        foreach ($checkimage as $checkimage) {
                                            $ckimg[] = $checkimage->id;
                                        }
                                        $ckim = implode(',', $ckimg);
                                    }else{
                                        $ckim = null;
                                    }
                                    $checklogo = StoreProductCartLogo::where('product_cart_id',$procart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                    ->where('user_id', Auth::user()->id)->get();
                                    if ($checklogo->count() > 0) {
                                        foreach ($checklogo as $checklogo) {
                                            $cklog[] = $checklogo->id;
                                        }
                                        $cklo = implode(',', $cklog);
                                    }else{
                                        $cklo = null;
                                    }
                             }else{
                                    $quant = $cart->quantity + $request->quantity;
                                    $data=Cart::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)
                                        ->update([
                                            'quantity' => $quant,
                                            ]);
                                    $charmprice = 0;
                                    $charmval = StoreCartCharm::where('session_id', Session::getId())->where('product_id', $request->product_id)->get();
                                    if ($charmval->count() > 0) {
                                        foreach ($charmval as $charmval) {
                                            $charmmval[] = $charmval->charm_id;
                                            $charmprice += $charmval->charm_price;
                                        }
                                        $charmm = implode(',', $charmmval);
                                    } else {
                                        $charmm = $request->charm;
                                        $charmprice += $request->charm_price;
                                    }
                                    $procart = ProductCart::find($cart->product_cart_id);
                                    $procart->quantity = $quant;
                                    $procart->addtext1 = $request->addtext1;
                                    $procart->egg_type = $request->eggtype;
                                    $procart->addtext2 = $request->addtext2;
                                    $procart->charm_id = $charmm;
                                    $procart->charm_price = $charmprice;
                                    $procart->printside = $request->printside;
                                    $procart->colortype = $request->colortype;
                                    $procart->location = $request->location;
                                    $procart->flowerss_type = $request->flowerss_type;
                                    $procart->datee = $request->datee;
                                    $procart->timee = $request->timee;
                                    $procart->pickup_type = $request->pickup_type;
                                    $procart->comment = $request->comment;
                                    $procart->giftwrap_price = $request->giftwrap_price;
                                    $procart->description = $request->description;
                                    if ($request->giftwrap == '') {
                                        $procart->giftwrap = '0';
                                    } elseif ($request->giftwrap	== 'on') {
                                        $procart->giftwrap = '1';
                                    }
                                    $request->hasfile('imageupload');
                                    if ($request->hasfile('imageupload')) {
                                        @unlink(public_path('uploads/images/'.$procart->imageupload));
                                        $file = $request->file('imageupload');
                                        $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                        $file->move(public_path('uploads/images'), $filename);
                                        $procart->imageupload = $filename;
                                    }
                                    if ($request->hasfile('logoupload')) {
                                        @unlink(public_path('uploads/images/'.$procart->logoupload));
                                        $file = $request->file('logoupload');
                                        $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                        $file->move(public_path('uploads/images'), $filename1);
                                        $procart->logoupload = $filename1;
                                    }
                                    $procart->save();
                                    $len = $request->imageupload;
                                    for ($i = 0; $i < $len; $i++) {
                                       //return $request->hasfile('imageupload'.$i);
                                       if($request->hasfile('imageupload'.$i))
                                       {
                                        $image = $request->file('imageupload'.$i);
                                         //  return $request->hasfile('imageupload'.$i);
                                         //  foreach(($request->file('imageupload'.$i)) as $image)
                                          // {
                                               $name=time().uniqid(). '.' . $image->getClientOriginalName();
                                               $image->move(public_path().'/uploads/images/', $name);
                                               $data[] = $name;

                                               $product_images= new StoreProductCartImage();
                                               $product_images->product_id = $request->product_id;
                                               $product_images->session_id = Session::getId();
                                               $product_images->user_id = Auth::user()->id;
                                               $product_images->cart_images = $name;
                                               $product_images->product_cart_id = $procart->id;
                                               $product_images->save();
                                           //}
                                       }
                                    }
                                    $lenlog = $request->logoupload;
                                    for ($x = 0; $x < $lenlog; $x++) {
                                       //return $request->hasfile('imageupload'.$i);
                                       if($request->hasfile('logoupload'.$x))
                                       {
                                        $logo = $request->file('logoupload'.$x);
                                         //  return $request->hasfile('imageupload'.$i);
                                         //  foreach(($request->file('imageupload'.$i)) as $image)
                                          // {
                                               $name1=time().uniqid(). '.' . $logo->getClientOriginalName();
                                               $logo->move(public_path().'/uploads/images/', $name1);
                                               $data1[] = $name1;

                                               $product_logo= new StoreProductCartLogo();
                                               $product_logo->product_id = $request->product_id;
                                               $product_logo->session_id = Session::getId();
                                               $product_logo->user_id = Auth::user()->id;
                                               $product_logo->cart_logo = $name1;
                                               $product_logo->product_cart_id = $procart->id;
                                               $product_logo->save();
                                           //}
                                       }
                                    }
                                    $checkimage = StoreProductCartImage::where('product_cart_id',$procart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                    ->where('user_id', Auth::user()->id)->get();
                                    if ($checkimage->count() > 0) {
                                        foreach ($checkimage as $checkimage) {
                                            $ckimg[] = $checkimage->id;
                                        }
                                        $ckim = implode(',', $ckimg);
                                    }else{
                                        $ckim = null;
                                    }
                                    $checklogo = StoreProductCartLogo::where('product_cart_id',$procart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                    ->where('user_id', Auth::user()->id)->get();
                                    if ($checklogo->count() > 0) {
                                        foreach ($checklogo as $checklogo) {
                                            $cklog[] = $checklogo->id;
                                        }
                                        $cklo = implode(',', $cklog);
                                    }else{
                                        $cklo = null;
                                    }

                                }
                            } else {
                                $request->all();
                                $charmprice = 0;
                                $charmval = StoreCartCharm::where('session_id', Session::getId())->where('product_id', $request->product_id)->get();
                                if ($charmval->count() > 0) {
                                    foreach ($charmval as $charmval) {
                                        $charmmval[] = $charmval->charm_id;
                                        $charmprice += $charmval->charm_price;
                                    }
                                    $charmm = implode(',', $charmmval);
                                } else {
                                    $charmm = $request->charm;
                                    $charmprice += $request->charm_price;
                                }
                                $productcart = new ProductCart();
                                $productcart->egg_type = $request->eggtype;
                                $productcart->quantity = $request->quantity;
                                $productcart->addtext1 = $request->addtext1;
                                $productcart->addtext2 = $request->addtext2;
                                $productcart->charm_id = $charmm;
                                $productcart->charm_price = $charmprice;
                                $productcart->printside = $request->printside;
                                $productcart->colortype = $request->colortype;
                                $productcart->location = $request->location;
                                $productcart->flowerss_type = $request->flowerss_type;
                                $productcart->datee = $request->datee;
                                $productcart->timee = $request->timee;
                                $productcart->pickup_type = $request->pickup_type;
                                $productcart->giftwrap_price = $request->giftwrap_price;
                                $productcart->description = $request->description;
                                $productcart->comment = $request->comment;
                                if ($request->giftwrap == '') {
                                    $productcart->giftwrap = '0';
                                } elseif ($request->giftwrap	== 'on') {
                                    $productcart->giftwrap = '1';
                                }
                                $request->hasfile('imageupload');
                                if ($request->hasfile('imageupload')) {
                                    $file = $request->file('imageupload');
                                    $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                    $file->move(public_path('uploads/images'), $filename1);
                                    $productcart->imageupload = $filename1;
                                }
                                if ($request->hasfile('logoupload')) {
                                    $file = $request->file('logoupload');
                                    $filename2 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                    $file->move(public_path('uploads/images'), $filename2);
                                    $productcart->logoupload = $filename2;
                                }
                                $productcart->save();
                                $len = $request->imageupload;
                                for ($i = 0; $i < $len; $i++) {
                                   //return $request->hasfile('imageupload'.$i);
                                   if($request->hasfile('imageupload'.$i))
                                   {
                                    $image = $request->file('imageupload'.$i);
                                     //  return $request->hasfile('imageupload'.$i);
                                     //  foreach(($request->file('imageupload'.$i)) as $image)
                                      // {
                                           $name=time().uniqid(). '.' . $image->getClientOriginalName();
                                           $image->move(public_path().'/uploads/images/', $name);
                                           $data[] = $name;

                                           $product_images= new StoreProductCartImage();
                                           $product_images->product_id = $request->product_id;
                                           $product_images->session_id = Session::getId();
                                           $product_images->user_id = Auth::user()->id;
                                           $product_images->product_cart_id = $productcart->id;
                                           $product_images->cart_images = $name;
                                           $product_images->save();
                                       //}
                                   }
                                }
                                $lenlog = $request->logoupload;
                                for ($x = 0; $x < $lenlog; $x++) {
                                   //return $request->hasfile('imageupload'.$i);
                                   if($request->hasfile('logoupload'.$x))
                                   {
                                    $logo = $request->file('logoupload'.$x);
                                     //  return $request->hasfile('imageupload'.$i);
                                     //  foreach(($request->file('imageupload'.$i)) as $image)
                                      // {
                                           $name1=time().uniqid(). '.' . $logo->getClientOriginalName();
                                           $logo->move(public_path().'/uploads/images/', $name1);
                                           $data1[] = $name1;

                                           $product_logo= new StoreProductCartLogo();
                                           $product_logo->product_id = $request->product_id;
                                           $product_logo->product_cart_id = $productcart->id;
                                           $product_logo->session_id = Session::getId();
                                           $product_logo->user_id = Auth::user()->id;
                                           $product_logo->cart_logo = $name1;
                                           $product_logo->save();
                                       //}
                                   }
                                }
                                $checkimage = StoreProductCartImage::where('product_cart_id',$productcart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                ->where('user_id', Auth::user()->id)->get();
                                if ($checkimage->count() > 0) {
                                    foreach ($checkimage as $checkimage) {
                                        $ckimg[] = $checkimage->id;
                                    }
                                    $ckim = implode(',',$ckimg);
                                }else{
                                    $ckim  = null;
                                }
                                $checklogo = StoreProductCartLogo::where('product_cart_id',$productcart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                ->where('user_id', Auth::user()->id)->get();
                                if ($checklogo->count() > 0) {
                                    foreach ($checklogo as $checklogo) {
                                        $cklog[] = $checklogo->id;
                                    }
                                    $cklo = implode(',', $cklog);
                                }else{
                                    $cklo = null;
                                }
                                $cart = new Cart();
                                $cart->session_id = $request->session_id;
                                $cart->user_id = Auth::user()->id;
                                $cart->product_id = $request->product_id;
                                $cart->price = $request->price;
                                $cart->quantity = $request->quantity;
                                $cart->product_cart_id = $productcart->id;
                                $cart->product_images_id = $ckim;
                                $cart->product_logos_id = $cklo;
                        }
                            $cart->save();

                            $cart_counter = Cart::where('user_id', Auth::user()->id)->count('id');
                            //$desch = StoreCartCharm::where('session_id', Session::getId())->where('product_id', $request->product_id)->delete();
                            return response()->json(['status'=>'success','msg' => 'Product Added successfully','cart_counter' => $cart_counter]);
                        }

                    }
                }else{
                    return response()->json(['status'=>'selected','msg' => 'Please Login As User To Add More Products']);
                }
        } else {
            return response()->json(['status'=>'failure','msg' => 'Please Login']);
        }
    }



    public function storerr(Request $request)
    {
        return $request->all();
       $request->hasfile('photo');
       $data = $request->all();
    }


    public function addtowishlist(Request $request){
        $data=$request->all();
       $product_id= $request->input('product_id');
       $session_id=Session::get('session_id');
       if(Auth::check()){
          $wishlist=Wishlist::where('user_id',Auth::user()->id)->where('product_id',$product_id)->get();
             if($wishlist->isEmpty()){

           $wish = new Wishlist();
           $wish->product_id = $request->product_id;
           $wish->product_name = $request->product_name;
           $wish->product_price = $request->product_price;
           $wish->user_id = Auth::user()->id;
           $wish->session_id = $request->session_id;
           $wish->save();

                return response()->json(['status'=>'success','msg' => 'Added to wishlist']);
          }else{
               return response()->json(['status'=>'exists','msg' => 'Already Exists']);

           }
       }else{

           return response()->json(['status'=>'failure','msg' => 'Please Login']);
       }

   }

   public function deletewishlist(Request $request,$id)
   {
        $data = Wishlist::where('id',$id)->delete();
        return back()->with('flash_error','Deleted  Successfully');
   }

   public function cartcount(Request $request)
   {
        $cart_counter = Cart::where('user_id',Auth::user()->id)->count();
        return response()->json(['count'=>$cart_counter]);
    }

    public function wishlistcount(Request $request)
    {
        $wish_counter = Wishlist::where('user_id',Auth::user()->id)->count();
        return response()->json(['count'=>$wish_counter]);
    }

    public function applyCoupon(Request $request)
    {
        $carts = Cart::where('user_id',Auth::user()->id)->get();
        foreach ($carts as $cart) {
            $product=Product::where('status','Active')->where('id', $cart->product_id)->first();
            if ($product->is_variation == "0") {
                $price=$product->price;
            } else {
                $productvar=AddSubVariation::where('product_id', $product->id)->where('id',$cart->variation_id)->first();
                if ($productvar) {
                    $price=$productvar->price;
                }
            }
            $procar = ProductCart::where('id',$cart->product_cart_id)->first();

            if($cart->quantity != "undefined")
            {
                if ($procar->charm_price != null) {
                    if ($procar->giftwrap == 1) {
                        $subtotal[] = ($price*$cart->quantity)+$procar->giftwrap_price+$procar->charm_price;
                    } else {
                        $subtotal[] = ($price*$cart->quantity)+$procar->charm_price;
                    }
                }else{
                    if ($procar->giftwrap == 1) {
                        $subtotal[] = ($price*$cart->quantity)+$procar->giftwrap_price;
                    } else {
                        $subtotal[] = $price*$cart->quantity;
                    }
                }
            }else{
                if ($procar->charm_price != null) {
                    if ($procar->giftwrap == 1) {
                        $subtotal[] = $price+$procar->giftwrap_price +$procar->charm_price;
                    } else {
                        $subtotal[] = $price + $procar->charm_price;
                    }
                }else{
                    if ($procar->giftwrap == 1) {
                        $subtotal[] = $price+$procar->giftwrap_price;
                    } else {
                        $subtotal[] = $price;
                    }
                }
            }
        }
         $couponcode = Coupon::where('coupon_code',$request->couponcode)
        ->where('validity_from','<=',date("Y-m-d"))
        ->where('validity_till','>=',date("Y-m-d"))
        ->where('minimum_order','<=',array_sum($subtotal))
        ->where('status','Active')
        ->first();
        $giftcode = GiftCardBuy::where('generated_code',$request->couponcode)->where('coupon','notused')->first();
        if ($couponcode) {
            if($couponcode->allow_multiple_use == "Yes"){
                 if (isset($couponcode->id) && $couponcode->coupon_code === $request->couponcode) {
                Cart::where('user_id',Auth::user()->id)
                ->update(['coupon_id'=>$couponcode->id]);
                    return back()->with('coupon_success', 'Coupon Applied');
                }
                else
                {
                    return back()->with('coupon_danger', 'Not a valid Coupon');
                }
            }else{
            $caaa = Order::where('user_id',Auth::user()->id)->where('coupon_id',$couponcode->id)->get();
            if(count($caaa) > 0){
                return back()->with('coupon_danger', 'Not a valid Coupon');
            }else{
             if (isset($couponcode->id) && $couponcode->coupon_code === $request->couponcode) {
                Cart::where('user_id',Auth::user()->id)
                ->update(['coupon_id'=>$couponcode->id]);
                    return back()->with('coupon_success', 'Coupon Applied');
                }
                else
                {
                    return back()->with('coupon_danger', 'Not a valid Coupon');
                }
            }
            }
        }elseif($giftcode){
                if ($giftcode->generated_code === $request->couponcode) {
                    Cart::where('user_id',Auth::user()->id)
                ->update(['giftcard_id'=>$giftcode->id]);
                    return back()->with('coupon_success', 'Coupon Applied');
                }else{
                    return back()->with('coupon_danger', 'Not a valid Coupon');
                }
        }else{
            return back()->with('coupon_danger', 'Not a valid Coupon');
        }
    }
    public static function getCouponDiscount($total_amount)
    {
        $discount_amount = 0;
        $cart = Cart::where('user_id',Auth::user()->id)->first();
        if ($cart) {
            $couponcode = Coupon::find($cart->coupon_id);
            $giftcode = GiftCardBuy::where('id',$cart->giftcard_id)->first();
           // dd($couponcode, $giftcode);
            if ($couponcode) {
                if ($couponcode->discount_type == 'Percentage') {
                    $discount_amount = ($total_amount * $couponcode->discount_amount)/100;
                    $payable_amount =  $total_amount - $discount_amount ;
                }
                if ($couponcode->discount_type == 'Flat') {
                    $discount_amount = $couponcode->discount_amount;
                    $payable_amount = $total_amount - $discount_amount;
                }
                $discount_amount = round($discount_amount);
                $discount_type = $couponcode->discount_type;
                $payable_amount = round($payable_amount);
            }elseif($giftcode){
                    $gif = GiftCard::where('id',$giftcode->giftcard_id)->first();
                    $discount_amount = $gif->giftvoucher_price;
                    $payable_amount = $total_amount - $discount_amount;

                $discount_amount = round($discount_amount);
                $discount_type = null;
                $payable_amount = round($payable_amount);
            }

        }

        return $discount_amount;
    }

     public function removeCoupon(Request $request,$user_id)
     {
        Cart::where('user_id',Auth::user()->id)
                ->update(['coupon_id'=>NULL , 'giftcard_id'=>NULL]);
        return back()->with('coupon_removed', 'Coupon Removed');
     }


     public static function getSubTotalPricee($user_id,$discount_amount,$CartID)
     {
         $carts = Cart::where('user_id',$user_id)->where('id',$CartID)->get();
         foreach ($carts as $cart) {
             $product=Product::where('status','Active')->where('id',$cart->product_id)->first();
             if($cart->variation_id == null){
                     $price=$product->price;
             }else{
                 $productvar=AddSubVariation::where('product_id',$cart->product_id)->where('id',$cart->variation_id)->first();
                 if ($productvar) {
                     $price=$productvar->price;
                 }
             }
             $procar = ProductCart::where('id',$cart->product_cart_id)->first();
             if($cart->quantity != "undefined")
             {
                 if ($procar->charm_price != null) {
                     if($procar->giftwrap == 1)
                     {
                         $subtotal[] = ($price*$cart->quantity)+$procar->giftwrap_price+$procar->charm_price;
                     }else{
                         $subtotal[] = $price*$cart->quantity+$procar->charm_price;
                     }
                 }else{
                     if($procar->giftwrap == 1)
                     {
                         $subtotal[] = ($price*$cart->quantity)+$procar->giftwrap_price;
                     }else{
                         $subtotal[] = $price*$cart->quantity;
                     }
                 }
             }else{
                 if ($procar->charm_price != null) {
                     if ($procar->giftwrap == 1) {
                         $subtotal[] = $price+$procar->giftwrap_price+$procar->charm_price;
                     } else {
                         $subtotal[] = $price+$procar->charm_price;
                     }
                 }else{
                     if ($procar->giftwrap == 1) {
                         $subtotal[] = $price+$procar->giftwrap_price;
                     } else {
                         $subtotal[] = $price;
                     }
                 }
             }
             //$subtotal[] = $price*$cart->quantity;
         }
         $cartfirst = Cart::where('user_id',$user_id)->where('id',$CartID)->first();
      /*   if($cartfirst->coupon_id != ""){
         $minorder=Coupon::where('id',$cartfirst->coupon_id)->first();
         dd($minorder);
         }else{
             $minorder="";
         }*/
         if (array_sum($subtotal) < 500) {
             $payable_amount = (array_sum($subtotal) - $discount_amount);
         }
         else{
             $payable_amount = array_sum($subtotal) - $discount_amount;
         }
            return $payable_amount;

     }


     public static function getSubTotalPrice($user_id,$discount_amount)
    {
        $carts = Cart::where('user_id',$user_id)->get();
        foreach ($carts as $cart) {
            $product=Product::where('status','Active')->where('id',$cart->product_id)->first();
            if($cart->variation_id == null){
                    $price=$product->price;
            }else{
                $productvar=AddSubVariation::where('product_id',$cart->product_id)->where('id',$cart->variation_id)->first();
                if ($productvar) {
                    $price=$productvar->price;
                }
            }
            $procar = ProductCart::where('id',$cart->product_cart_id)->first();
            if($cart->quantity != "undefined")
            {
                if ($procar->charm_price != null) {
                    if($procar->giftwrap == 1)
                    {
                        $subtotal[] = ($price*$cart->quantity)+$procar->giftwrap_price+$procar->charm_price;
                    }else{
                        $subtotal[] = $price*$cart->quantity+$procar->charm_price;
                    }
                }else{
                    if($procar->giftwrap == 1)
                    {
                        $subtotal[] = ($price*$cart->quantity)+$procar->giftwrap_price;
                    }else{
                        $subtotal[] = $price*$cart->quantity;
                    }
                }
            }else{
                if ($procar->charm_price != null) {
                    if ($procar->giftwrap == 1) {
                        $subtotal[] = $price+$procar->giftwrap_price+$procar->charm_price;
                    } else {
                        $subtotal[] = $price+$procar->charm_price;
                    }
                }else{
                    if ($procar->giftwrap == 1) {
                        $subtotal[] = $price+$procar->giftwrap_price;
                    } else {
                        $subtotal[] = $price;
                    }
                }
            }

            //$subtotal[] = $price*$cart->quantity;
        }
        $cartfirst = Cart::where('user_id',$user_id)->first();
     /*   if($cartfirst->coupon_id != ""){
        $minorder=Coupon::where('id',$cartfirst->coupon_id)->first();
        dd($minorder);
        }else{
            $minorder="";
        }*/
        if (array_sum($subtotal) < 500) {
            $payable_amount = (array_sum($subtotal) - $discount_amount);
        }
        else{
            $payable_amount = array_sum($subtotal) - $discount_amount;
        }
           return $payable_amount;

    }

    public function increaseCartQuantity(Request $request,$id,$user_id)
    {
       $cart = Cart::where('user_id',$user_id)->where('id',$id)->first();
       if ($cart) {
           $cart->quantity = $cart->quantity+1;
           $cart->save();
           return back();
       }
       else{
            abort(404);
       }
    }

    public function decreaseCartQuantity(Request $request,$id,$user_id)
    {
       $cart = Cart::where('user_id',$user_id)->where('id',$id)->first();
       if ($cart) {
           if($cart->quantity < 1){

           }else{
        if ($cart->quantity == 1) {
            $cart->delete();
            return back();
        }
        else{
            $cart->quantity = $cart->quantity-1;
            $cart->save();
            return back();
        }
       }
       }
       else{
            abort(404);
       }
    }
    public function deleteCartQuantity(Request $request,$id,$session_id)
    {
        $cart = Cart::where('user_id',$session_id)->where('id',$id)->first();
        if ($cart) {
            $cart->delete();
            return back();
        }
        else{
                abort(404);
        }
    }
    public function deletecartalldata(Request $request,$id,$user_id)
    {
        $cart = Cart::where('user_id',$user_id)->get();
        foreach($cart as $cart){
            $pro = ProductCart::where('product_id',$cart->product_id)->delete();
        }
        return back();
    }

    public function comboaddToCart(Request $request)
    {
        if (!empty($request->imageval)) {
            $allowedfileExtension = ['jpeg','jpg','png'];
            if ($request->imageupload > $request->imageval) {
                return response()->json(['status'=>'error','msg' => 'Sorry! Maximum allowed images are'.$request->imageval]);
            //return 'Sorry! Maximum allowed images are'.$request->imageval;
            } else {
                $len = $request->imageupload;
                for ($i = 0; $i < $len; $i++) {
                    if ($request->hasfile('imageupload'.$i)) {
                        $image = $request->file('imageupload'.$i);
                        $sizeofimg = $request->file('imageupload'.$i)->getSize();
                        $extension = $image->getClientOriginalExtension();
                        $check = in_array($extension, $allowedfileExtension);
                        // Checking the image extension
                        if (!$check) {
                            return response()->json(['status'=>'error','msg' => 'Images must be  jpeg or jpg or png!']);
                            //return 'Images must be  jpeg or jpg or png!';
                        }
                        if ($sizeofimg > $request->imagesiz) {
                            return response()->json(['status'=>'error','msg' => 'Sorry! Maximum allowed size for an image is'.$request->imagesiz.'bytes']);
                            //return 'Sorry! Maximum allowed size for an image is'.$request->imagesiz.'bytes';
                        }
                    }
                }
            }
        }
        if (!empty($request->logoval)) {
            $allowedfileExtensionn = ['jpeg','jpg','png'];
            $request->logoval;
            if ($request->logoupload > $request->logoval) {
                return response()->json(['status'=>'error','msg' => 'Sorry! Maximum allowed images are'.$request->logoval]);
            //return 'Sorry! Maximum allowed images are'.$request->imageval;
            } else {
                $loglen = $request->logoupload;
                for ($j = 0; $j < $loglen; $j++) {
                    if ($request->hasfile('logoupload'.$j)) {
                        $logoo = $request->file('logoupload'.$j);
                        $sizeoflogo = $request->file('logoupload'.$j)->getSize();
                        $extensionlogo = $logoo->getClientOriginalExtension();
                        $checklogo = in_array($extensionlogo, $allowedfileExtensionn);
                        // Checking the image extension
                        if (!$checklogo) {
                            return response()->json(['status'=>'error','msg' => 'Image must be  jpeg or jpg or png!']);
                            //return 'Images must be  jpeg or jpg or png!';
                        }
                        if ($sizeoflogo > $request->logosiz) {
                            return response()->json(['status'=>'error','msg' => 'Sorry! Maximum allowed size for an image is'.$request->logosiz.'bytes']);
                            //return 'Sorry! Maximum allowed size for an image is'.$request->imagesiz.'bytes';
                        }
                    }
                }
            }
        }
        if (Auth::check()) {
            $user = User::where('id',Auth::user()->id)->where('role_id','3')->first();
            if ($user) {
                    $prodd = Product::where('status','Active')->where('stock_status', 'outofstock')->where('id', $request->product_id)->first();
                    $proddq = Product::where('status','Active')->where('id', $request->product_id)->first();
                    if($request->quantity != "undefined")
                    {
                        $quant = $request->quantity;
                    }else{
                        $quant = null;
                    }
                    if ($proddq->quantity != null) {
                        if ($proddq->quantity < $quant) {
                            return response()->json(['status'=>'greate','msg' => 'Selected Quantity is greater']);
                        } else {
                            if ($prodd) {
                                return response()->json(['status'=>'out','msg' => 'Selected Product Is outofstock']);
                            } else {
                                $cart = Cart::where('product_id', $request->product_id)->where('user_id', Auth::user()->id)->first();
                                if ($cart) {
                                    if($request->quantity == "undefined"){
                                        $charmprice = 0;
                                        $charmval = StoreCartCharm::where('session_id', Session::getId())->where('product_id', $request->product_id)->get();
                                        if ($charmval->count() > 0) {
                                            foreach ($charmval as $charmval) {
                                                $charmid[] = $charmval->id;
                                                $charmmval[] = $charmval->charm_id;
                                                $charmprice += $charmval->charm_price;
                                            }
                                            $charmidd = implode(',',$charmid);
                                            $charmm = implode(',', $charmmval);
                                        } else {
                                            $charmidd = null;
                                            $charmm = $request->charm;
                                            $charmprice += $request->charm_price;
                                        }
                                        $productcombocart = StoreCartCombo::where('user_id',Auth::user()->id)->where('product_id',$request->product_id)->get();
                                        if ($productcombocart->count() > 0) {
                                            foreach ($productcombocart as $productcombocart) {
                                                $productcombocartval[] = $productcombocart->id;
                                            }
                                            $comval = implode(',', $productcombocartval);
                                        } else {
                                            $comval = null;
                                        }
                                        $procart = ProductCart::find($cart->product_cart_id);
                                        $procart->quantity = $request->quantity;
                                        $procart->addtext1 = $request->addtext1;
                                        $procart->egg_type = $request->eggtype;
                                        $procart->addtext2 = $request->addtext2;
                                        $procart->cart_combo_id = $comval;
                                        $procart->cart_charm_id = $charmidd;
                                        $procart->charm_id = $charmm;
                                        $procart->charm_price = $charmprice;
                                        $procart->printside = $request->printside;
                                        $procart->colortype = $request->colortype;
                                        $procart->location = $request->location;
                                        $procart->flowerss_type = $request->flowerss_type;
                                        $procart->datee = $request->datee;
                                        $procart->timee = $request->timee;
                                        $procart->pickup_type = $request->pickup_type;
                                        $procart->comment = $request->comment;
                                        $procart->giftwrap_price = $request->giftwrap_price;
                                        $procart->description = $request->description;
                                        if ($request->giftwrap == '') {
                                            $procart->giftwrap = '0';
                                        } elseif ($request->giftwrap	== 'on') {
                                            $procart->giftwrap = '1';
                                        }
                                        $request->hasfile('imageupload');
                                        if ($request->hasfile('imageupload')) {
                                            @unlink(public_path('uploads/images/'.$procart->imageupload));
                                            $file = $request->file('imageupload');
                                            $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                            $file->move(public_path('uploads/images'), $filename);
                                            $procart->imageupload = $filename;
                                        }
                                        if ($request->hasfile('logoupload')) {
                                            @unlink(public_path('uploads/images/'.$procart->logoupload));
                                            $file = $request->file('logoupload');
                                            $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                            $file->move(public_path('uploads/images'), $filename1);
                                            $procart->logoupload = $filename1;
                                        }
                                        $procart->save();
                                        $len = $request->imageupload;
                                        for ($i = 0; $i < $len; $i++) {
                                           //return $request->hasfile('imageupload'.$i);
                                           if($request->hasfile('imageupload'.$i))
                                           {
                                            $image = $request->file('imageupload'.$i);
                                             //  return $request->hasfile('imageupload'.$i);
                                             //  foreach(($request->file('imageupload'.$i)) as $image)
                                              // {
                                                   $name=time().uniqid(). '.' . $image->getClientOriginalName();
                                                   $image->move(public_path().'/uploads/images/', $name);
                                                   $data[] = $name;

                                                   $product_images= new StoreProductCartImage();
                                                   $product_images->product_id = $request->product_id;
                                                   $product_images->session_id = Session::getId();
                                                   $product_images->user_id = Auth::user()->id;
                                                   $product_images->product_cart_id = $procart->id;
                                                   $product_images->cart_images = $name;
                                                   $product_images->save();
                                               //}
                                           }
                                        }
                                        $lenlog = $request->logoupload;
                                        for ($x = 0; $x < $lenlog; $x++) {
                                           //return $request->hasfile('imageupload'.$i);
                                           if($request->hasfile('logoupload'.$x))
                                           {
                                            $logo = $request->file('logoupload'.$x);
                                             //  return $request->hasfile('imageupload'.$i);
                                             //  foreach(($request->file('imageupload'.$i)) as $image)
                                              // {
                                                   $name1=time().uniqid(). '.' . $logo->getClientOriginalName();
                                                   $logo->move(public_path().'/uploads/images/', $name1);
                                                   $data1[] = $name1;

                                                   $product_logo= new StoreProductCartLogo();
                                                   $product_logo->product_id = $request->product_id;
                                                   $product_logo->session_id = Session::getId();
                                                   $product_logo->product_cart_id = $procart->id;
                                                   $product_logo->user_id = Auth::user()->id;
                                                   $product_logo->cart_logo = $name1;
                                                   $product_logo->save();
                                               //}
                                           }
                                        }
                                        $checkimage = StoreProductCartImage::where('product_cart_id',$procart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                        ->where('user_id', Auth::user()->id)->get();
                                        if ($checkimage->count() > 0) {
                                            foreach ($checkimage as $checkimage) {
                                                $ckimg[] = $checkimage->id;
                                            }
                                            $ckim = implode(',', $ckimg);
                                        }else{
                                            $ckim = null;
                                        }
                                        $checklogo = StoreProductCartLogo::where('product_cart_id',$procart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                        ->where('user_id', Auth::user()->id)->get();
                                        if ($checklogo->count() > 0) {
                                            foreach ($checklogo as $checklogo) {
                                                $cklog[] = $checklogo->id;
                                            }
                                            $cklo = implode(',', $cklog);
                                        }else{
                                            $cklo = null;
                                        }

                                    }else{
                                        $quant = $cart->quantity + $request->quantity;
                                        $data=Cart::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)
                                            ->update([
                                                'quantity' => $quant,
                                                ]);
                                        $charmprice = 0;
                                        $charmval = StoreCartCharm::where('session_id', Session::getId())->where('product_id', $request->product_id)->get();
                                        if ($charmval->count() > 0) {
                                            foreach ($charmval as $charmval) {
                                                $charmid[] = $charmval->id;
                                                $charmmval[] = $charmval->charm_id;
                                                $charmprice += $charmval->charm_price;
                                            }
                                            $charmidd = implode(',',$charmid);
                                            $charmm = implode(',', $charmmval);
                                        } else {
                                            $charmidd = null;
                                            $charmm = $request->charm;
                                            $charmprice += $request->charm_price;
                                        }
                                        $productcombocart = StoreCartCombo::where('user_id',Auth::user()->id)->where('product_id',$request->product_id)->get();
                                        if ($productcombocart->count() > 0) {
                                            foreach ($productcombocart as $productcombocart) {
                                                $productcombocartval[] = $productcombocart->id;
                                            }
                                            $comval = implode(',', $productcombocartval);
                                        } else {
                                            $comval = null;
                                        }
                                        $procart = ProductCart::find($cart->product_cart_id);
                                        $procart->quantity = $quant;
                                        $procart->addtext1 = $request->addtext1;
                                        $procart->egg_type = $request->eggtype;
                                        $procart->addtext2 = $request->addtext2;
                                        $procart->cart_combo_id = $comval;
                                        $procart->cart_charm_id = $charmidd;
                                        $procart->charm_id = $charmm;
                                        $procart->charm_price = $charmprice;
                                        $procart->printside = $request->printside;
                                        $procart->colortype = $request->colortype;
                                        $procart->location = $request->location;
                                        $procart->flowerss_type = $request->flowerss_type;
                                        $procart->datee = $request->datee;
                                        $procart->timee = $request->timee;
                                        $procart->pickup_type = $request->pickup_type;
                                        $procart->comment = $request->comment;
                                        $procart->giftwrap_price = $request->giftwrap_price;
                                        $procart->description = $request->description;
                                        if ($request->giftwrap == '') {
                                            $procart->giftwrap = '0';
                                        } elseif ($request->giftwrap	== 'on') {
                                            $procart->giftwrap = '1';
                                        }
                                        $request->hasfile('imageupload');
                                        if ($request->hasfile('imageupload')) {
                                            @unlink(public_path('uploads/images/'.$procart->imageupload));
                                            $file = $request->file('imageupload');
                                            $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                            $file->move(public_path('uploads/images'), $filename);
                                            $procart->imageupload = $filename;
                                        }
                                        if ($request->hasfile('logoupload')) {
                                            @unlink(public_path('uploads/images/'.$procart->logoupload));
                                            $file = $request->file('logoupload');
                                            $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                            $file->move(public_path('uploads/images'), $filename1);
                                            $procart->logoupload = $filename1;
                                        }
                                        $procart->save();
                                        $len = $request->imageupload;
                                        for ($i = 0; $i < $len; $i++) {
                                           //return $request->hasfile('imageupload'.$i);
                                           if($request->hasfile('imageupload'.$i))
                                           {
                                            $image = $request->file('imageupload'.$i);
                                             //  return $request->hasfile('imageupload'.$i);
                                             //  foreach(($request->file('imageupload'.$i)) as $image)
                                              // {
                                                   $name=time().uniqid(). '.' . $image->getClientOriginalName();
                                                   $image->move(public_path().'/uploads/images/', $name);
                                                   $data[] = $name;

                                                   $product_images= new StoreProductCartImage();
                                                   $product_images->product_id = $request->product_id;
                                                   $product_images->session_id = Session::getId();
                                                   $product_images->product_cart_id = $procart->id;
                                                   $product_images->user_id = Auth::user()->id;
                                                   $product_images->cart_images = $name;
                                                   $product_images->save();
                                               //}
                                           }
                                        }
                                        $lenlog = $request->logoupload;
                                        for ($x = 0; $x < $lenlog; $x++) {
                                           //return $request->hasfile('imageupload'.$i);
                                           if($request->hasfile('logoupload'.$x))
                                           {
                                            $logo = $request->file('logoupload'.$x);
                                             //  return $request->hasfile('imageupload'.$i);
                                             //  foreach(($request->file('imageupload'.$i)) as $image)
                                              // {
                                                   $name1=time().uniqid(). '.' . $logo->getClientOriginalName();
                                                   $logo->move(public_path().'/uploads/images/', $name1);
                                                   $data1[] = $name1;

                                                   $product_logo= new StoreProductCartLogo();
                                                   $product_logo->product_id = $request->product_id;
                                                   $product_logo->session_id = Session::getId();
                                                   $product_logo->user_id = Auth::user()->id;
                                                   $product_logo->product_cart_id = $procart->id;
                                                   $product_logo->cart_logo = $name1;
                                                   $product_logo->save();
                                               //}
                                           }
                                        }
                                        $checkimage = StoreProductCartImage::where('product_cart_id',$procart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                        ->where('user_id', Auth::user()->id)->get();
                                        if ($checkimage->count() > 0) {
                                            foreach ($checkimage as $checkimage) {
                                                $ckimg[] = $checkimage->id;
                                            }
                                            $ckim = implode(',', $ckimg);
                                        }else{
                                            $ckim = null;
                                        }
                                        $checklogo = StoreProductCartLogo::where('product_cart_id',$procart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                        ->where('user_id', Auth::user()->id)->get();
                                        if ($checklogo->count() > 0) {
                                            foreach ($checklogo as $checklogo) {
                                                $cklog[] = $checklogo->id;
                                            }
                                            $cklo = implode(',', $cklog);
                                        }else{
                                            $cklo = null;
                                        }
                                        }
                                } else {
                                    $request->all();
                                    $charmprice = 0;
                                    $charmval = StoreCartCharm::where('session_id', Session::getId())->where('product_id', $request->product_id)->get();
                                    if ($charmval->count() > 0) {
                                        foreach ($charmval as $charmval) {
                                            $charmid[] = $charmval->id;
                                            $charmmval[] = $charmval->charm_id;
                                            $charmprice += $charmval->charm_price;
                                        }
                                        $charmidd = implode(',',$charmid);
                                        $charmm = implode(',', $charmmval);
                                    } else {
                                        $charmidd = null;
                                        $charmm = $request->charm;
                                        $charmprice += $request->charm_price;
                                    }
                                    $productcombocart = StoreCartCombo::where('user_id',Auth::user()->id)->where('product_id',$request->product_id)->get();
                                    if ($productcombocart->count() > 0) {
                                        foreach ($productcombocart as $productcombocart) {
                                            $productcombocartval[] = $productcombocart->id;
                                        }
                                        $comval = implode(',', $productcombocartval);
                                    } else {
                                        $comval = null;
                                    }
                                    $productcart = new ProductCart();
                                    $productcart->egg_type = $request->eggtype;
                                    $productcart->quantity = $request->quantity;
                                    $productcart->addtext1 = $request->addtext1;
                                    $productcart->addtext2 = $request->addtext2;
                                    $productcart->cart_combo_id = $comval;
                                    $productcart->cart_charm_id = $charmidd;
                                    $productcart->charm_id = $charmm;
                                    $productcart->charm_price = $charmprice;
                                    $productcart->printside = $request->printside;
                                    $productcart->colortype = $request->colortype;
                                    $productcart->location = $request->location;
                                    $productcart->flowerss_type = $request->flowerss_type;
                                    $productcart->datee = $request->datee;
                                    $productcart->timee = $request->timee;
                                    $productcart->pickup_type = $request->pickup_type;
                                    $productcart->giftwrap_price = $request->giftwrap_price;
                                    $productcart->description = $request->description;
                                    $productcart->comment = $request->comment;
                                    if ($request->giftwrap == '') {
                                        $productcart->giftwrap = '0';
                                    } elseif ($request->giftwrap	== 'on') {
                                        $productcart->giftwrap = '1';
                                    }
                                    $request->hasfile('imageupload');
                                    if ($request->hasfile('imageupload')) {
                                        $file = $request->file('imageupload');
                                        $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                        $file->move(public_path('uploads/images'), $filename1);
                                        $productcart->imageupload = $filename1;
                                    }
                                    if ($request->hasfile('logoupload')) {
                                        $file = $request->file('logoupload');
                                        $filename2 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                        $file->move(public_path('uploads/images'), $filename2);
                                        $productcart->logoupload = $filename2;
                                    }
                                    $productcart->save();
                                    $productcombocart = StoreCartCombo::where('user_id',Auth::user()->id)->where('product_id',$request->product_id)->get();
                                    if ($productcombocart->count() > 0) {
                                        foreach ($productcombocart as $productcombocart) {
                                            $productcombocartval[] = $productcombocart->id;
                                        }
                                        $comval = implode(',', $productcombocartval);
                                    } else {
                                        $comval = null;
                                    }
                                    $len = $request->imageupload;
                                        for ($i = 0; $i < $len; $i++) {
                                        //return $request->hasfile('imageupload'.$i);
                                        if($request->hasfile('imageupload'.$i))
                                        {
                                            $image = $request->file('imageupload'.$i);
                                            //  return $request->hasfile('imageupload'.$i);
                                            //  foreach(($request->file('imageupload'.$i)) as $image)
                                            // {
                                                $name=time().uniqid(). '.' . $image->getClientOriginalName();
                                                $image->move(public_path().'/uploads/images/', $name);
                                                $data[] = $name;

                                                $product_images= new StoreProductCartImage();
                                                $product_images->product_id = $request->product_id;
                                                $product_images->session_id = Session::getId();
                                                $product_images->user_id = Auth::user()->id;
                                                $product_images->cart_images = $name;
                                                $product_images->product_cart_id = $productcart->id;
                                                $product_images->save();
                                            //}
                                        }
                                        }
                                        $lenlog = $request->logoupload;
                                        for ($x = 0; $x < $lenlog; $x++) {
                                        //return $request->hasfile('imageupload'.$i);
                                        if($request->hasfile('logoupload'.$x))
                                        {
                                            $logo = $request->file('logoupload'.$x);
                                            //  return $request->hasfile('imageupload'.$i);
                                            //  foreach(($request->file('imageupload'.$i)) as $image)
                                            // {
                                                $name1=time().uniqid(). '.' . $logo->getClientOriginalName();
                                                $logo->move(public_path().'/uploads/images/', $name1);
                                                $data1[] = $name1;

                                                $product_logo= new StoreProductCartLogo();
                                                $product_logo->product_id = $request->product_id;
                                                $product_logo->session_id = Session::getId();
                                                $product_logo->user_id = Auth::user()->id;
                                                $product_logo->product_cart_id = $productcart->id;
                                                $product_logo->cart_logo = $name1;
                                                $product_logo->save();
                                            //}
                                        }
                                        }
                                        $checkimage = StoreProductCartImage::where('product_cart_id',$productcart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                        ->where('user_id', Auth::user()->id)->get();
                                        if($checkimage->count() > 0){
                                            foreach ($checkimage as $checkimage)
                                            {
                                                $ckimg[] = $checkimage->id;
                                            }
                                            $ckim = implode(',',$ckimg);
                                        }else{
                                            $ckim = null;
                                        }
                                        $checklogo = StoreProductCartLogo::where('product_cart_id',$productcart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                        ->where('user_id', Auth::user()->id)->get();
                                        if ($checklogo->count() > 0) {
                                            foreach ($checklogo as $checklogo) {
                                                $cklog[] = $checklogo->id;
                                            }
                                            $cklo = implode(',', $cklog);
                                        }else{
                                            $cklo = null;
                                        }
                                    $cart = new Cart();
                                    $cart->session_id = $request->session_id;
                                    $cart->user_id = Auth::user()->id;
                                    $cart->product_id = $request->product_id;
                                    $cart->price = $request->price;
                                    $cart->quantity = $request->quantity;
                                    $cart->product_cart_id = $productcart->id;
                                    $cart->product_combo_id =$comval;
                                    $cart->product_images_id = $ckim;
                                    $cart->product_logos_id = $cklo;
                                }
                                $cart->save();


                                $cart_counter = Cart::where('user_id', Auth::user()->id)->count('id');
                               // $desch = StoreCartCharm::where('session_id', Session::getId())->where('product_id', $request->product_id)->delete();
                                return response()->json(['status'=>'success','msg' => 'Product Added successfully','cart_counter' => $cart_counter]);
                            }
                        }
                    }else{
                        if ($prodd) {
                            return response()->json(['status'=>'out','msg' => 'Selected Product Is outofstock']);
                        } else {
                            $cart = Cart::where('product_id', $request->product_id)->where('user_id', Auth::user()->id)->first();
                            if ($cart) {
                                if($request->quantity =="undefined"){
                                    $charmprice = 0;
                                    $charmval = StoreCartCharm::where('session_id', Session::getId())->where('product_id', $request->product_id)->get();
                                    if ($charmval->count() > 0) {
                                        foreach ($charmval as $charmval) {
                                            $charmid[] = $charmval->id;
                                            $charmmval[] = $charmval->charm_id;
                                            $charmprice += $charmval->charm_price;
                                        }
                                            $charmidd = implode(',',$charmid);
                                            $charmm = implode(',', $charmmval);
                                    } else {
                                        $charmidd = null;
                                        $charmm = $request->charm;
                                        $charmprice += $request->charm_price;
                                    }
                                    $productcombocart = StoreCartCombo::where('user_id',Auth::user()->id)->where('product_id',$request->product_id)->get();
                                    if ($productcombocart->count() > 0) {
                                        foreach ($productcombocart as $productcombocart) {
                                            $productcombocartval[] = $productcombocart->id;
                                        }
                                        $comval = implode(',', $productcombocartval);
                                    } else {
                                        $comval = null;
                                    }
                                    $procart = ProductCart::find($cart->product_cart_id);
                                    $procart->quantity = $request->quantity;
                                    $procart->addtext1 = $request->addtext1;
                                    $procart->egg_type = $request->eggtype;
                                    $procart->addtext2 = $request->addtext2;
                                    $procart->cart_combo_id = $comval;
                                    $procart->cart_charm_id = $charmidd;
                                    $procart->charm_id = $charmm;
                                    $procart->charm_price = $charmprice;
                                    $procart->printside = $request->printside;
                                    $procart->colortype = $request->colortype;
                                    $procart->location = $request->location;
                                    $procart->flowerss_type = $request->flowerss_type;
                                    $procart->datee = $request->datee;
                                    $procart->timee = $request->timee;
                                    $procart->pickup_type = $request->pickup_type;
                                    $procart->comment = $request->comment;
                                    $procart->giftwrap_price = $request->giftwrap_price;
                                    $procart->description = $request->description;
                                    if ($request->giftwrap == '') {
                                        $procart->giftwrap = '0';
                                    } elseif ($request->giftwrap	== 'on') {
                                        $procart->giftwrap = '1';
                                    }
                                    $request->hasfile('imageupload');
                                    if ($request->hasfile('imageupload')) {
                                        @unlink(public_path('uploads/images/'.$procart->imageupload));
                                        $file = $request->file('imageupload');
                                        $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                        $file->move(public_path('uploads/images'), $filename);
                                        $procart->imageupload = $filename;
                                    }
                                    if ($request->hasfile('logoupload')) {
                                        @unlink(public_path('uploads/images/'.$procart->logoupload));
                                        $file = $request->file('logoupload');
                                        $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                        $file->move(public_path('uploads/images'), $filename1);
                                        $procart->logoupload = $filename1;
                                    }
                                    $procart->save();
                                    $len = $request->imageupload;
                                    for ($i = 0; $i < $len; $i++) {
                                       //return $request->hasfile('imageupload'.$i);
                                       if($request->hasfile('imageupload'.$i))
                                       {
                                        $image = $request->file('imageupload'.$i);
                                         //  return $request->hasfile('imageupload'.$i);
                                         //  foreach(($request->file('imageupload'.$i)) as $image)
                                          // {
                                               $name=time().uniqid(). '.' . $image->getClientOriginalName();
                                               $image->move(public_path().'/uploads/images/', $name);
                                               $data[] = $name;

                                               $product_images= new StoreProductCartImage();
                                               $product_images->product_id = $request->product_id;
                                               $product_images->session_id = Session::getId();
                                               $product_images->product_cart_id = $procart->id;
                                               $product_images->user_id = Auth::user()->id;
                                               $product_images->cart_images = $name;
                                               $product_images->save();
                                           //}
                                       }
                                    }
                                    $lenlog = $request->logoupload;
                                    for ($x = 0; $x < $lenlog; $x++) {
                                       //return $request->hasfile('imageupload'.$i);
                                       if($request->hasfile('logoupload'.$x))
                                       {
                                        $logo = $request->file('logoupload'.$x);
                                         //  return $request->hasfile('imageupload'.$i);
                                         //  foreach(($request->file('imageupload'.$i)) as $image)
                                          // {
                                               $name1=time().uniqid(). '.' . $logo->getClientOriginalName();
                                               $logo->move(public_path().'/uploads/images/', $name1);
                                               $data1[] = $name1;

                                               $product_logo= new StoreProductCartLogo();
                                               $product_logo->product_id = $request->product_id;
                                               $product_logo->session_id = Session::getId();
                                               $product_logo->user_id = Auth::user()->id;
                                               $product_logo->cart_logo = $name1;
                                               $product_logo->product_cart_id = $procart->id;
                                               $product_logo->save();
                                           //}
                                       }
                                    }
                                    $checkimage = StoreProductCartImage::where('product_cart_id',$procart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                    ->where('user_id', Auth::user()->id)->get();
                                    if ($checkimage->count() > 0) {
                                        foreach ($checkimage as $checkimage) {
                                            $ckimg[] = $checkimage->id;
                                        }
                                        $ckim = implode(',', $ckimg);
                                    }else{
                                        $ckim = null;
                                    }
                                    $checklogo = StoreProductCartLogo::where('product_cart_id',$procart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                    ->where('user_id', Auth::user()->id)->get();
                                    if ($checklogo->count() > 0) {
                                        foreach ($checklogo as $checklogo) {
                                            $cklog[] = $checklogo->id;
                                        }
                                        $cklo = implode(',', $cklog);
                                    }else{
                                        $cklo = null;
                                    }

                                }else{
                                    $quant = $cart->quantity + $request->quantity;
                                    $data=Cart::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)
                                        ->update([
                                            'quantity' => $quant,
                                            ]);
                                    $charmprice = 0;
                                    $charmval = StoreCartCharm::where('session_id', Session::getId())->where('product_id', $request->product_id)->get();
                                    if ($charmval->count() > 0) {
                                        foreach ($charmval as $charmval) {
                                            $charmid[] = $charmval->id;
                                            $charmmval[] = $charmval->charm_id;
                                            $charmprice += $charmval->charm_price;
                                        }
                                        $charmidd = implode(',',$charmid);
                                        $charmm = implode(',', $charmmval);
                                    } else {
                                            $charmidd = null;
                                            $charmm = $request->charm;
                                        $charmprice += $request->charm_price;
                                    }
                                    $productcombocart = StoreCartCombo::where('user_id',Auth::user()->id)->where('product_id',$request->product_id)->get();
                                    if ($productcombocart->count() > 0) {
                                        foreach ($productcombocart as $productcombocart) {
                                            $productcombocartval[] = $productcombocart->id;
                                        }
                                        $comval = implode(',', $productcombocartval);
                                    } else {
                                        $comval = null;
                                    }
                                    $procart = ProductCart::find($cart->product_cart_id);
                                    $procart->quantity = $quant;
                                    $procart->addtext1 = $request->addtext1;
                                    $procart->egg_type = $request->eggtype;
                                    $procart->addtext2 = $request->addtext2;
                                    $procart->cart_combo_id = $comval;
                                    $procart->cart_charm_id = $charmidd;
                                    $procart->charm_id = $charmm;
                                    $procart->charm_price = $charmprice;
                                    $procart->printside = $request->printside;
                                    $procart->colortype = $request->colortype;
                                    $procart->location = $request->location;
                                    $procart->flowerss_type = $request->flowerss_type;
                                    $procart->datee = $request->datee;
                                    $procart->timee = $request->timee;
                                    $procart->pickup_type = $request->pickup_type;
                                    $procart->comment = $request->comment;
                                    $procart->giftwrap_price = $request->giftwrap_price;
                                    $procart->description = $request->description;
                                    if ($request->giftwrap == '') {
                                        $procart->giftwrap = '0';
                                    } elseif ($request->giftwrap	== 'on') {
                                        $procart->giftwrap = '1';
                                    }
                                    $request->hasfile('imageupload');
                                    if ($request->hasfile('imageupload')) {
                                        @unlink(public_path('uploads/images/'.$procart->imageupload));
                                        $file = $request->file('imageupload');
                                        $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                        $file->move(public_path('uploads/images'), $filename);
                                        $procart->imageupload = $filename;
                                    }
                                    if ($request->hasfile('logoupload')) {
                                        @unlink(public_path('uploads/images/'.$procart->logoupload));
                                        $file = $request->file('logoupload');
                                        $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                        $file->move(public_path('uploads/images'), $filename1);
                                        $procart->logoupload = $filename1;
                                    }
                                    $procart->save();
                                    $len = $request->imageupload;
                                        for ($i = 0; $i < $len; $i++) {
                                        //return $request->hasfile('imageupload'.$i);
                                        if($request->hasfile('imageupload'.$i))
                                        {
                                            $image = $request->file('imageupload'.$i);
                                            //  return $request->hasfile('imageupload'.$i);
                                            //  foreach(($request->file('imageupload'.$i)) as $image)
                                            // {
                                                $name=time().uniqid(). '.' . $image->getClientOriginalName();
                                                $image->move(public_path().'/uploads/images/', $name);
                                                $data[] = $name;

                                                $product_images= new StoreProductCartImage();
                                                $product_images->product_id = $request->product_id;
                                                $product_images->session_id = Session::getId();
                                                $product_images->user_id = Auth::user()->id;
                                                $product_images->cart_images = $name;
                                                $product_images->product_cart_id = $procart->id;
                                                $product_images->save();
                                            //}
                                        }
                                        }
                                        $lenlog = $request->logoupload;
                                        for ($x = 0; $x < $lenlog; $x++) {
                                        //return $request->hasfile('imageupload'.$i);
                                        if($request->hasfile('logoupload'.$x))
                                        {
                                            $logo = $request->file('logoupload'.$x);
                                            //  return $request->hasfile('imageupload'.$i);
                                            //  foreach(($request->file('imageupload'.$i)) as $image)
                                            // {
                                                $name1=time().uniqid(). '.' . $logo->getClientOriginalName();
                                                $logo->move(public_path().'/uploads/images/', $name1);
                                                $data1[] = $name1;

                                                $product_logo= new StoreProductCartLogo();
                                                $product_logo->product_id = $request->product_id;
                                                $product_logo->session_id = Session::getId();
                                                $product_logo->product_cart_id = $procart->id;
                                                $product_logo->user_id = Auth::user()->id;
                                                $product_logo->cart_logo = $name1;
                                                $product_logo->save();
                                            //}
                                        }
                                        }
                                        $checkimage = StoreProductCartImage::where('product_cart_id',$procart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                        ->where('user_id', Auth::user()->id)->get();
                                        if ($checkimage->count() > 0) {
                                            foreach ($checkimage as $checkimage) {
                                                $ckimg[] = $checkimage->id;
                                            }
                                            $ckim = implode(',',$ckimg);

                                        }else{
                                            $ckim=null;
                                        }
                                        $checklogo = StoreProductCartLogo::where('product_cart_id',$procart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                        ->where('user_id', Auth::user()->id)->get();
                                        if ($checklogo->count() > 0) {
                                            foreach ($checklogo as $checklogo) {
                                                $cklog[] = $checklogo->id;
                                            }
                                            $cklo = implode(',', $cklog);
                                        }else{
                                            $cklo = null;
                                        }
                                }
                            } else {
                                $request->all();
                                $charmprice = 0;
                                $charmval = StoreCartCharm::where('session_id', Session::getId())->where('product_id', $request->product_id)->get();
                                if ($charmval->count() > 0) {
                                    foreach ($charmval as $charmval) {
                                        $charmid[] = $charmval->id;
                                        $charmmval[] = $charmval->charm_id;
                                        $charmprice += $charmval->charm_price;
                                    }
                                    $charmidd = implode(',',$charmid);
                                    $charmm = implode(',', $charmmval);
                                } else {
                                    $charmidd = null;
                                    $charmm = $request->charm;
                                    $charmprice += $request->charm_price;
                                }
                                $productcombocart = StoreCartCombo::where('user_id',Auth::user()->id)->where('product_id',$request->product_id)->get();
                                if ($productcombocart->count() > 0) {
                                    foreach ($productcombocart as $productcombocart) {
                                        $productcombocartval[] = $productcombocart->id;
                                    }
                                    $comval = implode(',', $productcombocartval);
                                } else {
                                    $comval = null;
                                }
                                $productcart = new ProductCart();
                                $productcart->egg_type = $request->eggtype;
                                $productcart->quantity = $request->quantity;
                                $productcart->addtext1 = $request->addtext1;
                                $productcart->addtext2 = $request->addtext2;
                                $productcart->cart_combo_id = $comval;
                                $productcart->cart_charm_id = $charmidd;
                                $productcart->charm_id = $charmm;
                                $productcart->charm_price = $charmprice;
                                $productcart->printside = $request->printside;
                                $productcart->colortype = $request->colortype;
                                $productcart->location = $request->location;
                                $productcart->flowerss_type = $request->flowerss_type;
                                $productcart->datee = $request->datee;
                                $productcart->timee = $request->timee;
                                $productcart->pickup_type = $request->pickup_type;
                                $productcart->giftwrap_price = $request->giftwrap_price;
                                $productcart->description = $request->description;
                                $productcart->comment = $request->comment;
                                if ($request->giftwrap == '') {
                                    $productcart->giftwrap = '0';
                                } elseif ($request->giftwrap	== 'on') {
                                    $productcart->giftwrap = '1';
                                }
                                $request->hasfile('imageupload');
                                if ($request->hasfile('imageupload')) {
                                    $file = $request->file('imageupload');
                                    $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                    $file->move(public_path('uploads/images'), $filename1);
                                    $productcart->imageupload = $filename1;
                                }
                                if ($request->hasfile('logoupload')) {
                                    $file = $request->file('logoupload');
                                    $filename2 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                                    $file->move(public_path('uploads/images'), $filename2);
                                    $productcart->logoupload = $filename2;
                                }
                                $productcart->save();
                                $productcombocart = StoreCartCombo::where('user_id',Auth::user()->id)->where('product_id',$request->product_id)->get();
                                if ($productcombocart->count() > 0) {
                                    foreach ($productcombocart as $productcombocart) {
                                        $productcombocartval[] = $productcombocart->id;
                                    }
                                    $comval = implode(',', $productcombocartval);
                                } else {
                                    $comval = null;
                                }
                                $len = $request->imageupload;
                                for ($i = 0; $i < $len; $i++) {
                                   //return $request->hasfile('imageupload'.$i);
                                   if($request->hasfile('imageupload'.$i))
                                   {
                                    $image = $request->file('imageupload'.$i);
                                     //  return $request->hasfile('imageupload'.$i);
                                     //  foreach(($request->file('imageupload'.$i)) as $image)
                                      // {
                                           $name=time().uniqid(). '.' . $image->getClientOriginalName();
                                           $image->move(public_path().'/uploads/images/', $name);
                                           $data[] = $name;

                                           $product_images= new StoreProductCartImage();
                                           $product_images->product_id = $request->product_id;
                                           $product_images->session_id = Session::getId();
                                           $product_images->user_id = Auth::user()->id;
                                           $product_images->product_cart_id = $productcart->id;
                                           $product_images->cart_images = $name;
                                           $product_images->save();
                                       //}
                                   }
                                }
                                $lenlog = $request->logoupload;
                                for ($x = 0; $x < $lenlog; $x++) {
                                   //return $request->hasfile('imageupload'.$i);
                                   if($request->hasfile('logoupload'.$x))
                                   {
                                    $logo = $request->file('logoupload'.$x);
                                     //  return $request->hasfile('imageupload'.$i);
                                     //  foreach(($request->file('imageupload'.$i)) as $image)
                                      // {
                                           $name1=time().uniqid(). '.' . $logo->getClientOriginalName();
                                           $logo->move(public_path().'/uploads/images/', $name1);
                                           $data1[] = $name1;

                                           $product_logo= new StoreProductCartLogo();
                                           $product_logo->product_id = $request->product_id;
                                           $product_logo->session_id = Session::getId();
                                           $product_logo->user_id = Auth::user()->id;
                                           $product_logo->product_cart_id = $productcart->id;
                                           $product_logo->cart_logo = $name1;
                                           $product_logo->save();
                                       //}
                                   }
                                }
                                $checkimage = StoreProductCartImage::where('product_cart_id',$productcart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                ->where('user_id', Auth::user()->id)->get();
                                if ($checkimage->count() > 0) {
                                    foreach ($checkimage as $checkimage) {
                                        $ckimg[] = $checkimage->id;
                                    }
                                    $ckim = implode(',',$ckimg);
                                }else{
                                    $ckim = null;
                                }
                                $checklogo = StoreProductCartLogo::where('product_cart_id',$productcart->id)->where('product_id', $request->product_id)->where('session_id',Session::getId())
                                ->where('user_id', Auth::user()->id)->get();
                                if ($checklogo->count() > 0) {
                                    foreach ($checklogo as $checklogo) {
                                        $cklog[] = $checklogo->id;
                                    }
                                $cklo = implode(',',$cklog);
                                }else{
                                    $cklo = null;
                                }
                                $cart = new Cart();
                                $cart->session_id = $request->session_id;
                                $cart->user_id = Auth::user()->id;
                                $cart->product_id = $request->product_id;
                                $cart->price = $request->price;
                                $cart->quantity = $request->quantity;
                                $cart->product_cart_id = $productcart->id;
                                $cart->product_combo_id =$comval;
                                $cart->product_images_id = $ckim;
                                $cart->product_logos_id = $cklo;
                            }
                            $cart->save();
                            $cart_counter = Cart::where('user_id', Auth::user()->id)->count('id');
                            //$desch = StoreCartCharm::where('session_id', Session::getId())->where('product_id', $request->product_id)->delete();
                            return response()->json(['status'=>'success','msg' => 'Product Added successfully','cart_counter' => $cart_counter]);
                        }

                    }
                }else{
                    return response()->json(['status'=>'selected','msg' => 'Please Login As User To Add More Products']);
                }
        } else {
            return response()->json(['status'=>'failure','msg' => 'Please Login']);
        }
    }



}
