<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ChildCategory::orderBy('id', 'DESC')->with('category','subcategory')->get();
        return view('admin.childcategory.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
   //   $data = Category::where('status', 'Active')->get();
   //   $sub = SubCategory::where('status', 'Active')->get();

        $firstcategory = Category::where('status','Active')->first();
        $subcategory_id = SubCategory::where('status','Active')->get();
        $category = Category::where('status','Active')->get();
        if (isset($request->category_id) && $request->category_id !='') {
            $subcategory = Subcategory::where('category_id',$request->category_id)->where('status','Active')->get();
        }
        else{
            $subcategory = Subcategory::where('category_id',@$firstcategory->id)->where('status','Active')->get();
        }

        return view('admin.childcategory.create', compact('firstcategory','subcategory_id','category','subcategory'));
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
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'childcat_name' => 'required',
        ]);
        $dep =  Category::where('id',$request->category_id)->first();
        $depp =  SubCategory::where('id',$request->subcategory_id)->first();
        $merge = $request->childcat_name . ' '.$dep->cat_name. ' '.$depp->subcat_name;
        $slug = Helper::getBlogUrl($merge);
        if (ChildCategory::where('childcat_slug', '=', $slug)->count() > 0) {
            return back()->with('flash_error', 'ChildCategory Already Exits');
        } else {
            $data = new ChildCategory;
            $data->childcat_name = $request->childcat_name;
            $data->childcat_slug = $slug;
            $data->category_id=$request->category_id;
            $data->subcategory_id=$request->subcategory_id;
            $data->status = $request->status;
            $data->description = $request->description;
            if ($request->hasfile('childcat_image')) {
                $file = $request->file('childcat_image');
                $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                $file->move(public_path('uploads/images'), $filename1);
                $data->childcat_image = $filename1;
            }
            if ($request->hasfile('childcat_logo')) {
                $file = $request->file('childcat_logo');
                $filename2 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                $file->move(public_path('uploads/images'), $filename2);
                $data->childcat_logo = $filename2;
            }
            if($request->top_childcategory==''){
                $data->top_childcategory = '0';
            }else if($request->top_childcategory== 'on'){
                $data->top_childcategory = '1';
            }

            $data->save();

            return back()->with('flash_success', 'ChildCategory Created successfully');
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
        $data = Childcategory::find($id);
        $data1=Category::where('status', 'Active')->get();
        $data2 = Subcategory::where('status', 'Active')->get();

        $firstcategory = Category::where('status','Active')->first();
        $category = Category::where('status','Active')->get();
        if (isset($request->category_id) && $request->category_id !='') {
            $subcategory = Subcategory::where('status','Active')->where('category_id',$request->category_id)->get();
        }
        else{
            $subcategory = Subcategory::where('status','Active')->where('category_id',$data->category_id)->get();
        }

        return view('admin.childcategory.edit', compact('data', 'data1','data2','firstcategory','subcategory','category'));
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
            'childcat_name' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
        ]);
       $dep =  Category::where('id',$request->category_id)->first();
       $dep =  SubCategory::where('id',$request->subcategory_id)->first();
       $merge = $request->childcat_name . ' '.$dep->cat_name. ' '.$dep->subcat_name;
       $slug = Helper::getBlogUrl($merge);

        $data = ChildCategory::find($id);
        $data->childcat_name = $request->childcat_name;
        $data->childcat_slug = $slug;
        $data->category_id=$request->category_id;
        $data->subcategory_id=$request->subcategory_id;
        $data->status = $request->status;
        $data->description = $request->description;
        if ($request->hasfile('childcat_image')) {
            @unlink(public_path('uploads/images/'.$data->childcat_image));
            $file = $request->file('childcat_image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
            $file->move(public_path('uploads/images'), $filename);
            $data->childcat_image = $filename;
        }
        if ($request->hasfile('childcat_logo')) {
            @unlink(public_path('uploads/images/'.$data->childcat_logo));
            $file = $request->file('childcat_logo');
            $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
            $file->move(public_path('uploads/images'), $filename1);
            $data->childcat_logo = $filename1;
        }
        if($request->top_childcategory==''){
            $data->top_childcategory = '0';
        }else if($request->top_childcategory== 'on'){
            $data->top_childcategory = '1';
        }

        $data->save();


        return back()->with('flash_success', 'ChildCategory Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = ChildCategory::find($id);
        @unlink(public_path('uploads/images/'.$data->image));
        $data->delete();
        return back()->with('flash_success', 'ChildCategory Deleted  Successfully!');
    }
}
