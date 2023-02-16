<?php

namespace App\Http\Controllers\Backend\Manager;

use App\Http\Controllers\Controller;
use App\Models\AttributeValue;
use App\Models\Product;
use App\Models\ProductCombo;
use App\Models\ProductCombooo;
use App\Models\ProductComboVariation;
use Attribute;
use Illuminate\Http\Request;

class ComboController extends Controller
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
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $procombo = ProductComboVariation::where('product_id', $id)->get();
        $idd = $id;
        $var = ProductComboVariation::where('product_id',$id)->get();
        $varr = ProductComboVariation::where('product_id',$id)->get();
        $data = ProductCombo::where('product_id', $id)->get();
        $productb = Product::where('id',$id)->first();

        return view('manager.combo.create', compact('procombo','idd','var','varr','data','productb'));
    }

    public function store(Request $request)
    {
        $attribute = new ProductCombo();
        $attribute->product_id = $request->product_id;
        $attribute->combo_attr_id = implode(',', $request->combo_attr_id);
        $attribute->combo_attr_value = implode(',',$request->combo_attr_value);
        $attribute->button_name = $request->button_name;
        $attribute->combo_text_heading = $request->combo_text_heading;
        $attribute->combo_text_validation = $request->combo_text_validation;
        if($request->combo_text_field ==''){
            $attribute->combo_text_field = '0';
        }else if($request->combo_text_field == 'on'){
            $attribute->combo_text_field = '1';
        }
        if($request->is_charm ==''){
            $attribute->is_charm = '0';
        }else if($request->is_charm == 'on'){
            $attribute->is_charm = '1';
        }
        $attribute->save();

        $data = $request->all();
        if ($data['combo_attr_id'] != '' && $data['combo_attr_value'] != '') {
            $combo_attr_value = implode(',', $request->combo_attr_value);
            if($combo_attr_value != null){
                foreach (explode(',',$combo_attr_value) as $val) {
                    //$item_val_idsco[$val] = $val;
                    $co = AttributeValue::where('id',$val)->first();
                    $product_price = new ProductCombooo();
                    $product_price->combo_id =  $attribute->id;
                    $product_price->product_id = $request->product_id;
                    $product_price->combo_attr_id = $co->attr_id;
                    $product_price->combo_attr_value =  $val;
                    $product_price->button_name = $request->button_name;
                    $product_price->combo_text_heading = $request->combo_text_heading;
                    $product_price->combo_text_validation = $request->combo_text_validation;
                    if($request->combo_text_field ==''){
                        $product_price->combo_text_field = '0';
                    }else if($request->combo_text_field == 'on'){
                        $product_price->combo_text_field = '1';
                    }
                    if($request->is_charm ==''){
                        $product_price->is_charm = '0';
                    }else if($request->is_charm == 'on'){
                        $product_price->is_charm = '1';
                    }
                    $product_price->save();
                }
            }

        }
        return back()->with('flash_success', 'Combo Created successfully');

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
        $data = ProductCombo::where('id', $id)->first();
        $productb = Product::where('id',$data->product_id)->first();
        $procombo = ProductComboVariation::where('product_id', $data->product_id)->get();

        $item_attr_idsc =[];
        if($data->combo_attr_value != null){
            foreach (explode(',',$data->combo_attr_value) as $atrrc) {
                $item_attr_idsc[$atrrc] = $atrrc;
            }
        }
        return view('manager.combo.edit', compact('data','item_attr_idsc','productb','procombo'));

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
        $attribute = ProductCombo::find($id);
        $attribute->product_id = $request->product_id;
        $attribute->button_name = $request->button_name;
        $attribute->combo_text_heading = $request->combo_text_heading;
        $attribute->combo_text_validation = $request->combo_text_validation;
        if($request->combo_text_field ==''){
            $attribute->combo_text_field = '0';
        }else if($request->combo_text_field == 'on'){
            $attribute->combo_text_field = '1';
        }
        if($request->is_charm ==''){
            $attribute->is_charm = '0';
        }else if($request->is_charm == 'on'){
            $attribute->is_charm = '1';
        }
        if($request->combo_attr_id){
            $attribute->combo_attr_id = implode(',',$request->combo_attr_id);
        }else{
            $attribute->combo_attr_id  =  $request->input('combo_attr_id');
        }
        if($request->combo_attr_value){
            $attribute->combo_attr_value = implode(',',$request->combo_attr_value);
        }else{
            $attribute->combo_attr_value  =  $request->input('combo_attr_value');
        }
        $attribute->save();
        if($request->combo_text_field ==''){
            $combo_text_field = '0';
        }else if($request->combo_text_field == 'on'){
            $combo_text_field = '1';
        }
        if($request->is_charm ==''){
            $is_charm = '0';
        }else if($request->is_charm == 'on'){
            $is_charm = '1';
        }
        $codel= ProductCombooo::where('combo_id',$attribute->id)->delete();
        $data = $request->all();
        if ($data['combo_attr_id'] != '' && $data['combo_attr_value'] != '') {
            $combo_attr_value = implode(',', $request->combo_attr_value);
            if($combo_attr_value != null){
                foreach (explode(',',$combo_attr_value) as $val) {
                    //$item_val_idsco[$val] = $val;
                    $co = AttributeValue::where('id',$val)->first();
                    $product_price = new ProductCombooo();
                    $product_price->combo_id =  $attribute->id;
                    $product_price->product_id = $request->product_id;
                    $product_price->combo_attr_id = $co->attr_id;
                    $product_price->combo_attr_value =  $val;
                    $product_price->button_name = $request->button_name;
                    $product_price->combo_text_heading = $request->combo_text_heading;
                    $product_price->combo_text_validation = $request->combo_text_validation;
                    if($request->combo_text_field ==''){
                        $product_price->combo_text_field = '0';
                    }else if($request->combo_text_field == 'on'){
                        $product_price->combo_text_field = '1';
                    }
                    if($request->is_charm ==''){
                        $product_price->is_charm = '0';
                    }else if($request->is_charm == 'on'){
                        $product_price->is_charm = '1';
                    }
                    $product_price->save();
                }
            }

        }
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
        $data = ProductCombo::find($id);
        $var = ProductCombooo::where('product_id',$data->product_id)->where('combo_id',$id)->delete();
        $data->delete();
        return back()->with('flash_success', ' Deleted  Successfully!');
    }


}
