<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\AddProductVariation;
use App\Models\Addproductvariationn;
use App\Models\AddSubVariation;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        //dd('d');
        $request->validate(['attr_name' => 'required', 'attr_value' => 'required'], ['attr_name.unique' => 'Option Already Added In Product !', 'attr_value.required' => 'Atleast one value is required !']);
        $request->all();
        $findrows =Addproductvariationn::where('product_id', '=', $id)->get();
        foreach ($findrows as $value)
        {
           if ($request->attr_name == $value->attr_name)
            {
                return back()->with('warning', 'Variant Already Added For This Product !');
            }
        }
    /*    if ($findrows->count() >= 2)
        {
            return back()->with('warning', 'You can add only two variant');
        }
        else
        { */
           // return $request->all();
            $newvar = new AddProductVariation();
            $findallsub = AddSubVariation::where('product_id', $id)->get();
            $nArry = [];
            foreach ($findallsub as $key => $value)
            {
                array_push($nArry, $value['main_attr_id'][0], $request->attr_name);
            }
            foreach ($findallsub as $value)
            {
                foreach ($nArry as $key => $n)
                {
                    $request->attr_name;
                    $update = AddSubVariation::where('product_id', '=', $id)->get();
                    foreach ($update as $newup)
                    {
                        $value = $newup->main_attr_id;
                        if (count($value) <= 1)
                        {
                            foreach ($value as $cval)
                            {
                                $str = $cval . '"' . ',' . '"' . $request->attr_name;
                                $str2 = array();
                                array_push($str2, $str);
                                $new = json_encode($str2);
                                $str3 = stripslashes($new);
                                DB::table('add_sub_variants')->where('id', $newup->id)
                                    ->update(array(
                                    'main_attr_id' => $str3
                                ));
                                DB::table('addsubvariationns')->where('id', $newup->id)
                                ->update(array(
                                'main_attr_id' => $request->attr_name
                            ));

                            }
                        }
                    }
                }
            }
            $nArry2 = [];
            foreach ($findallsub as $key => $value)
            {
                foreach ($value['main_attr_value'] as $a => $att_v)
                {
                    array_push($nArry2, [$a => $att_v, $request->attr_name => "0"]);
                }
            }
            foreach ($findallsub as $value)
            {
                foreach ($nArry2 as $key => $n)
                {
                    $request->attr_name;
                    $update = AddSubVariation::where('product_id', '=', $id)->get();
                    $new1 = json_encode($n);
                    DB::table('add_sub_variants')->where('id', $value->id)
                        ->update(array(
                        'main_attr_value' => $new1
                    ));
                    DB::table('addsubvariationns')->where('id', $value->id)
                    ->update(array(
                    'main_attr_value' => $request->attr_name,
                ));
                }
            }
            $newvar->attr_name = $request->attr_name;
            $str_json = json_encode($request->attr_value);
            $newvar->attr_value = $str_json;
            $newvar->product_id = $id;
            $newvar->save();

            $data = $request->all();
                   $mrp_price = $data['attr_value'];
                if (count($mrp_price)) {
                    foreach ($mrp_price as $key => $input) {
                        if ($mrp_price[$key]!=null) {
                            $product_price = new Addproductvariationn();
                            $product_price->attr_name = $request->attr_name;
                            $product_price->attr_value= $mrp_price[$key];
                            $product_price->product_id = $id;
                            $product_price->save();
                        }
                    }
                }
            return back()->with('Added', 'Variant Added Successfully !');
        //}
    }



    public function getProductValues(Request $request)
    {
        $getval = $request->sendval;
        $conversion_rates = AttributeValue::select('attr_id','attr_value_name','attr_value_title','id')->where('attr_id', '=', $getval)->get();
        return response()->json($conversion_rates);
    }


    public function destroy($id)
    {

        $findpro = AddProductVariation::findorfail($id);
        $getallsub = AddSubVariation::where('product_id', $findpro->pro_id)->get();

        foreach ($getallsub as $value)
        {

            $arr = $value['main_attr_value'];

            $arr2 = $value['main_attr_id'];

            unset($arr[$findpro->attr_name]);

            if (($key = array_search($findpro->attr_name, $arr2)) !== false) {
                unset($arr2[$key]);
            }

            foreach ($arr2 as $key => $v) {
                $n2[] = $v;
            }

            $n = json_encode($arr);

            if(empty($n2)){

                $value->delete();

            }else{

               DB::table('add_sub_variants')->where('id', $value->id)
                    ->update(array(
                    'main_attr_value' => $n,
                    'main_attr_id' => $n2
                ));

            }



        }

        $findpro->delete();

        return back()->with('deleted', 'Product Variant Deleted !');
    }


    public function update(Request $request, $id)
    {
        $request->validate(['attr_value' => 'required'],
        ['attr_value.required' => 'Atleast one value is required !']);

        $findpro = AddProductVariation::findorfail($id);
        $findpro->attr_value = $request->attr_value;

        $findpro->save();
        return back();
        //return redirect()->route('add.var', $findpro->product_id)->with('updated', 'Product Values Updated Successfully !');
    }

}
