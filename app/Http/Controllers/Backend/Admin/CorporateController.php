<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\CorporateGift;
use App\Models\CorporateGiftImage;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class CorporateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = CorporateGift::with('category','subcategory','childcategory')->get();
        return view('admin.corporate.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $firstcategory = Category::where('status','Active')->first();
        $maincategory = Category::where('status','Active')->get();
        if (isset($request->category_id) && $request->category_id !='') {
             $subcategory = SubCategory::where('category_id',$request->category_id)->where('status','Active')->get();
            if (isset($request->subcategory_id) && $request->subcategory_id !='') {
              $childcategory = ChildCategory::where('subcategory_id',$request->subcategory_id)->where('status','Active')->get();
            }else{
              $childcategory = ChildCategory::where('category_id',$request->category_id)->where('status','Active')->get();

            }
        }
        else{
            $subcategory = Subcategory::where('category_id',@$firstcategory->id)->where('status','Active')->get();
           $childcategory = ChildCategory::where('category_id',$request->category_id)->where('status','Active')->get();
        }
            $childcategory;
        return view('admin.corporate.create',compact('childcategory','subcategory','firstcategory','maincategory'));
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
            //'category_id' => 'required',
            //'subcategory_id'=>'required',
            'corp_product_name'=>'required',
        ]);
        $slug = Helper::getBlogUrl($request->corp_product_name);
        if (CorporateGift::where('corp_product_slug', '=', $slug)->count() > 0)
        {
            return back()->with('flash_error', 'Already Exits');
        }
        else
        {
            $product = new CorporateGift();
            $product->category_id = $request->category_id;
            $product->subcategory_id = $request->subcategory_id;
            $product->childcategory_id = $request->childcategory_id;
            $product->corp_product_name = $request->corp_product_name;
            $product->corp_product_slug = $slug;
            $product->corp_product_desc = $request->corp_product_desc;
            $product->status = $request->status;
            $product->meta_title = $request->meta_title;
            $product->meta_description = $request->meta_description;
            $product->meta_keywords = $request->meta_keywords;
            $product->save();

            if($request->hasfile('images'))
            {
                foreach(($request->file('images')) as $image)
                {
                    $name=time().uniqid(). '.' . $image->getClientOriginalName();
                    $image->move(public_path().'/uploads/images/', $name);
                    $data[] = $name;

                    $product_images= new CorporateGiftImage();
                    $product_images->corporate_id = $product->id;
                    $product_images->images = $name;
                    $product_images->save();
                }
            }

           return back()->with('flash_success', ' Created successfully');
        }

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
        $data = CorporateGift::findOrFail($id);
        $images = CorporateGiftImage::where('corporate_id',$id)->get();
        $firstcategory = Category::where('status','Active')->first();
        $maincategory = Category::where('status','Active')->get();
        if (isset($request->category_id) && $request->category_id !='') {
        $subcategory = SubCategory::where('status','Active')->where('category_id',$request->category_id)->get();
        $childcategory = ChildCategory::where('subcategory_id',$request->subcategory_id)->where('status','Active')->get();

        if (isset($request->subcategory_id) && $request->subcategory_id !='') {
             $childcategory = ChildCategory::where('subcategory_id',$request->subcategory_id)->where('status','Active')->get();
           }else{
                $childcategory = ChildCategory::where('subcategory_id',$data->subcategory_id)->where('status','Active')->get();
            }
        }else{
            $subcategory = SubCategory::where('status','Active')->where('category_id',$data->category_id)->get();
           $childcategory = ChildCategory::where('subcategory_id',$data->subcategory_id)->where('status','Active')->get();

        }
        return View('admin.corporate.edit',compact('data','subcategory','images','subcategory','childcategory','maincategory','firstcategory'));
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
        $validated = $request->validate([
            //'category_id' => 'required',
            //'subcategory_id'=>'required',
            'corp_product_name'=>'required',
        ]);
        $slug = Helper::getBlogUrl($request->corp_product_name);
        $product = CorporateGift::find($id);
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->childcategory_id = $request->childcategory_id;
        $product->corp_product_name = $request->corp_product_name;
        $product->corp_product_slug = $slug;
        $product->corp_product_desc = $request->corp_product_desc;
        $product->status = $request->status;
        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;
        $product->meta_keywords = $request->meta_keywords;
        $product->save();

        return back()->with('flash_success', 'Updated successfully');

    }

    public function addcorporateImages(Request $request)
    {
        if($request->hasfile('images'))
        {
            foreach($request->file('images') as $image)
            {
                $name=time().uniqid(). '.' . $image->getClientOriginalName();
                $image->move(public_path().'/uploads/images/', $name);
                $data[] = $name;

                $product_images= new CorporateGiftImage();
                $product_images->corporate_id = $request->corporate_id;
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
    public function destroy($id)
    {
        $data = CorporateGift::find($id);
        @unlink(public_path('uploads/images/'.$data->images));
        $datt = CorporateGiftImage::where('corporate_id',$data->id)->delete();
        $data->delete();
        return back()->with('flash_success', ' Deleted  Successfully!');
    }

    public function corporatedeleteimage(Request $request)
    {
       $id = $_REQUEST['id'];
        $dataa = CorporateGiftImage::find($id);
        $delete = @unlink(public_path('uploads/images/'.$dataa->images));
        $dataa->delete();
        return back()->with('flash_success', 'Image Deleted Successfully!');
    }

}
