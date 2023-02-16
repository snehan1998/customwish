<?php

namespace App\Http\Controllers\Backend\Manager;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCombo;
use App\Models\ProductSelectHeading;
use App\Models\ProductSelectOption;
use Illuminate\Http\Request;

class ProductSelectOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ProductSelectHeading::orderBy('id','DESC')->get();
        return view('manager.productselectoption.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $products = Product::where('status','Active')->get();
        $firstcategory = Product::where('status','Active')->first();
         if (isset($request->product_id) && $request->product_id !='') {
              $combo = ProductCombo::where('product_id',$request->product_id)->where('is_charm','1')->get();
         }else{
             $combo = ProductCombo::where('product_id',@$firstcategory->id)->where('is_charm','1')->get();
         }
        return view('manager.productselectoption.create',compact('products','combo','firstcategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required',
            'product_select_title' => 'required',
        ]);
        $banner = new ProductSelectHeading();
        $banner->product_id = $request->product_id;
        $banner->combo_id = $request->combo_id;
        $banner->product_select_title = $request->product_select_title;
        $banner->save();


        if ($request->product_select_option != "") {
            $data1 = $request->all();
            $quantity = $data1['product_select_option'];
            $price = $data1['product_select_option_price'];
            if (count($quantity)) {
                foreach ($quantity as $key => $input) {
                    if ($quantity[$key]!=null) {
                        $product_images= new ProductSelectOption();
                        $product_images->product_id= $banner->product_id;
                        $product_images->combo_id = $banner->combo_id;
                        $product_images->product_select_id= $banner->id;
                        $product_images->product_select_option=$quantity[$key];
                        $product_images->product_select_option_price =$price[$key];
                        $product_images->save();
                    }
                }
            }
        }

        return back()->with('flash_success', ' Updated Successfully');
    }


    public function addmoreselection(Request $request)
    {
        $data1 = $request->all();
        $quantity = $data1['product_select_option'];
        $price = $data1['product_select_option_price'];
        if (count($quantity)) {
            foreach ($quantity as $key => $input) {
                if ($quantity[$key]!=null) {
                    $product_images= new ProductSelectOption();
                    $product_images->product_id= $request->product_id;
                    $product_images->combo_id= $request->combo_id;
                    $product_images->product_select_id= $request->product_select_id;
                    $product_images->product_select_option=$quantity[$key];
                    $product_images->product_select_option_price =$price[$key];
                    $product_images->save();
                }
            }
        }
        return back()->with('flash_sucess','Created successfully');
    }

    public function deleteselection(Request $request)
    {
        $pro = $_REQUEST['id'];
        $produ  = ProductSelectOption::where('id',$pro)->delete();
        return back()->with('flash_success', ' Deleted  Successfully!');
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
    public function edit($id,Request $request)
    {
        $data = ProductSelectHeading::find($id);
        $check = Product::where('id',$data->product_id)->first();
        $products = Product::where('status','Active')->get();
        $service = ProductSelectOption::where('product_select_id',$id)->get();
        if (isset($request->product_id) && $request->product_id !='') {
            $combo = ProductCombo::where('is_charm','1')->where('product_id',$request->product_id)->get();
        }
        else{
            $combo = ProductCombo::where('is_charm','1')->where('product_id',$data->product_id)->get();
        }
        return view('manager.productselectoption.edit',compact('data','products','service','combo','check'));
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
        $banner = ProductSelectHeading::find($id);
        $banner->product_id = $request->product_id;
        $banner->combo_id = $request->combo_id;
        $banner->product_select_title = $request->product_select_title;
        $banner->save();

        return back()->with('flash_success', 'Updated Successfully');
    }

    public function deleteService(Request $request)
    {
        $cake = ProductSelectOption::findOrFail($request->id);
        $cake->delete();
        return back()->with('flash_success', ' Deleted Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = ProductSelectHeading::find($id);
        $bannerr = ProductSelectOption::where('product_select_id',$id)->delete();
        $banner->delete();
        return back()->with('flash_success', ' Deleted  Successfully!');
    }
}
