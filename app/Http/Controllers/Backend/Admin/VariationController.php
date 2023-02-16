<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\AddProductVariation;
use App\Models\Addproductvariationn;
use App\Models\AddSubVariation;
use App\Models\Addsubvariationn;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductPrice;
use App\Models\ProductVariation;
use App\Models\ProductVariationButton;
use Illuminate\Http\Request;

class VariationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function addvariants(Request $request,$id){

        $findpro = Product::findorfail($id);
        $getopts = AddProductVariation::where('product_id', '=', $id)->get();
        $getoptsss = AddProductVariation::where('product_id', '=', $id)->get();
        $getoptss = Addproductvariationn::where('product_id', '=', $id)->get();
        $sub_variant = AddSubVariation::where('product_id', '=', $id)->get();
        $sub_variantt = Addsubvariationn::where('product_id', '=', $id)->get();
       //return $getopts;
        return view('admin.variations.addvariants',compact('findpro','getopts','sub_variant','sub_variantt','getoptss','getoptsss'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $provarit = ProductVariation::where('product_id', '=', $id)->get();
        $idd = $id;
        $var = ProductVariation::where('product_id',$id)->get();
        $varr = ProductVariation::where('product_id',$id)->get();
        $data = AddSubVariation::where('product_id', $id)->get();
        $productb = Product::where('id',$id)->first();
        return view('admin.variations.create', compact('provarit','idd','data','var','varr','productb'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->product_button_id)
        {
            $product_button_id = implode(',',$request->product_button_id);
        }else{
            $product_button_id = $request->product_button_id;
        }
        $attribute = new AddSubVariation();
        $attribute->product_id = $request->product_id;
        $attribute->main_attr_id = implode(',', $request->main_attr_id);
        $attribute->main_attr_value = implode(',',$request->main_attr_value);
        $attribute->product_button_id = $product_button_id;
      //  $attribute->main_attr_id = json_encode($request->main_attr_id);
       // $attribute->main_attr_value = json_encode($request->main_attr_value);
        $attribute->price = $request->price;
        $attribute->stock = $request->stock;
        $attribute->quantity = $request->quantity;
        $attribute->skucode = $request->skucode;
        $attribute->strike_price = $request->strick_price;
        $attribute->discount = $request->discount;
        $attribute->variation_text_heading = $request->variation_text_heading;
        $attribute->variation_text_validation = $request->variation_text_validation;
        if($request->variation_text_field ==''){
            $attribute->variation_text_field = '0';
        }else if($request->variation_text_field == 'on'){
            $attribute->variation_text_field = '1';
        }

        $attribute->save();
        if($request->hasfile('images'))
        {
            $imgCount = 0;
            foreach($request->file('images') as $image)
            {
                $imgCount++;
                $name=time().uniqid(). '.' . $image->getClientOriginalName();
                $image->move(public_path().'/uploads/images/', $name);
                $data[] = $name;

                $product_images= new ProductImage();
                $product_images->product_id = $request->product_id;
                $product_images->variation_product_id = $attribute->id;
                $product_images->images = $name;
                $product_images->save();
            }
        }

                $product_pprice= new ProductPrice();
                $product_pprice->product_id = $attribute->product_id;
                $product_pprice->variation_id = $attribute->id;
                $product_pprice->price = $request->price;
                $product_pprice->strick_price = $request->strick_price;
                $product_pprice->discount = $request->discount;
                $product_pprice->save();

        $data = $request->all();
        if ($data['main_attr_id'] != '' && $data['main_attr_value'] != '') {
            $mrp_price = $data['main_attr_id'];
            $value_price = $data['main_attr_value'];
            if($request->product_button_id)
            {
                $button_id = implode(',',$request->product_button_id);
            }else{
                $button_id = $request->product_button_id;
            }
            $auto = $this->generateBarcodeNumber();
            if (count($mrp_price)) {
                foreach ($mrp_price as $key => $input) {
                    if ($mrp_price[$key]!=null && $value_price[$key]!=null) {
                        $product_price = new Addsubvariationn();
                        $product_price->var_id =  $attribute->id;
                        $product_price->subvar_id = $auto;
                        $product_price->product_id = $request->product_id;
                        $product_price->main_attr_id = $mrp_price[$key];
                        $product_price->main_attr_value =  $value_price[$key];
                        $product_price->price = $request->price;
                        $product_price->discount = $request->discount;
                        $product_price->stock = $request->stock;
                        $product_price->quantity = $request->quantity;
                        $product_price->skucode = $request->skucode;
                        $product_price->strike_price = $request->strick_price;
                        $product_price->product_button_id = $button_id;
                        $product_price->variation_text_heading = $request->variation_text_heading;
                        $product_price->variation_text_validation = $request->variation_text_validation;
                        if($request->variation_text_field ==''){
                            $product_price->variation_text_field = '0';
                        }else if($request->variation_text_field == 'on'){
                            $product_price->variation_text_field = '1';
                        }
                        $product_price->save();
                    }
                }
            }
        }

        return back()->with('flash_success', 'Attribute Values Created successfully');

    }

    function generateBarcodeNumber() {
        $number = rand(10000,100000); // better than rand()
        return $number;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $provarit = ProductVariation::where('product_id', '=', $id)->get();
        $idd = $id;
        $images = ProductImage::where('variation_product_id',$id)->get();
        $var = ProductVariation::where('product_id',$id)->get();
        $varr = ProductVariation::where('product_id',$id)->get();
        $data = AddSubVariation::where('id', $id)->first();
        $productb = Product::where('id',$id)->first();

        $item_val_ids = explode(',',$data->main_attr_value);
        $item_val_ids =[];
        if($data->main_attr_value != null){
            foreach (explode(',',$data->main_attr_value) as $val) {
                $item_val_ids[$val] = $val;
            }
        }
        return view('admin.variations.edit', compact('provarit','idd','data','var','varr','item_val_ids','images','productb'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $attribute = AddSubVariation::find($id);
        $attribute->product_id = $request->product_id;
        $attribute->price = $request->price;
        $attribute->stock = $request->stock;
        $attribute->quantity = $request->quantity;
        $attribute->skucode = $request->skucode;
        $attribute->strike_price = $request->strick_price;
        $attribute->discount = $request->discount;
        $attribute->variation_text_heading = $request->variation_text_heading;
        $attribute->variation_text_validation = $request->variation_text_validation;
        if($request->variation_text_field ==''){
            $attribute->variation_text_field = '0';
        }else if($request->variation_text_field == 'on'){
            $attribute->variation_text_field = '1';
        }
        $attribute->save();

        $product_price = ProductPrice::updateOrCreate(['product_id'=> $attribute->product_id,'variation_id' => $attribute->id],[
            'product_id' => $attribute->product_id,
            'variation_id' => $attribute->id,
            'price' => $request->price,
            'strick_price' => $request->strick_price,
            'discount' => $request->discount,
        ]);
        if($request->variation_text_field ==''){
            $variation_text_field = '0';
        }else if($request->variation_text_field == 'on'){
            $variation_text_field = '1';
        }

        $attribute = Addsubvariationn::where('var_id',$id)->update([
            'product_id' => $request->product_id,
            'price' => $request->price,
            'strike_price' => $request->strick_price,
            'discount' => $request->discount,
            'stock' => $request->stock,
            'quantity' => $request->quantity,
            'skucode' => $request->skucode,
            'variation_text_heading' => $request->variation_text_heading,
            'variation_text_validation' => $request->variation_text_validation,
            'variation_text_field' => $variation_text_field,
        ]);

        return back()->with('flash_success', 'Attribute Values Updated Successfully');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = AddSubVariation::find($id);
        $datt = ProductImage::where('product_id',$data->product_id)->where('variation_product_id',$id)->delete();
        $var = Addsubvariationn::where('product_id',$data->product_id)->where('var_id',$id)->delete();
        $price = ProductPrice::where('product_id',$data->product_id)->where('variation_id',$id)->delete();
        $data->delete();
        return back()->with('flash_success', ' Deleted  Successfully!');
    }




    public function addMoreImagesvar(Request $request)
    {
        if($request->hasfile('images'))
        {
            foreach($request->file('images') as $image)
            {
                $name=time().uniqid(). '.' . $image->getClientOriginalName();
                $image->move(public_path().'/uploads/images/', $name);
                $data[] = $name;
                $product_images= new ProductImage();
                $product_images->product_id = $request->product_id;
                $product_images->variation_product_id = $request->variation_id;
                $product_images->images = $name;
                $product_images->save();
            }
        }
        return back()->with('flash_success', 'Images Uploaded successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function deleteMultipleImagesvar(Request $request)
    {
        $id = $_REQUEST['id'];
        $data = ProductImage::find($id);
        $delete = @unlink(public_path('uploads/images/'.$data->images));
        $data->delete();
        return back()->with('flash_success', 'Image Deleted Successfully!');
    }
}
