<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use App\Models\SubChildCategory;
use Illuminate\Http\Request;

class SubChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = SubChildCategory::orderBy('id', 'DESC')->with('category','subcategory','childcategory')->get();
        return view('admin.subchildcategory.index', compact('data'));
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

        return view('admin.subchildcategory.create', compact('firstcategory','maincategory','subcategory','childcategory'));
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
            'childcategory_id' => 'required',
            'subchildcat_name' => 'required',
        ]);
        $dep =  Category::where('id',$request->category_id)->first();
        $depp = SubCategory::where('id',$request->subcategory_id)->first();
        $deppp = ChildCategory::where('id',$request->childcategory_id)->first();
        $merge = $request->childcat_name .' '.$dep->cat_name.' '.$depp->subcat_name.' '.$deppp->childcat_name;
        $slug = Helper::getBlogUrl($merge);
        if (SubChildCategory::where('subchildcat_slug', '=', $slug)->count() > 0) {
            return back()->with('flash_error', 'SubChildCategory Already Exits');
        } else {
            $data = new SubChildCategory;
            $data->subchildcat_name = $request->subchildcat_name;
            $data->subchildcat_slug = $slug;
            $data->category_id=$request->category_id;
            $data->subcategory_id=$request->subcategory_id;
            $data->childcategory_id=$request->childcategory_id;
            $data->subchildstatus = $request->subchildstatus;
            $data->subchilddescription = $request->subchilddescription;
            if ($request->hasfile('subchildcat_image')) {
                $file = $request->file('subchildcat_image');
                $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                $file->move(public_path('uploads/images'), $filename1);
                $data->subchildcat_image = $filename1;
            }
            if ($request->hasfile('subchildcat_logo')) {
                $file = $request->file('subchildcat_logo');
                $filename2 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                $file->move(public_path('uploads/images'), $filename2);
                $data->subchildcat_logo = $filename2;
            }
            if($request->top_subchildcategory==''){
                $data->top_subchildcategory = '0';
            }else if($request->top_subchildcategory== 'on'){
                $data->top_subchildcategory = '1';
            }
            $data->save();
            return back()->with('flash_success', 'SubChildCategory Created successfully');
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
        $data = SubChildcategory::find($id);
        $data1=Category::where('status', 'Active')->get();
        $data2 = Subcategory::where('status', 'Active')->get();
        $data3 = ChildCategory::where('status', 'Active')->get();
        $firstcategory = Category::where('status','Active')->first();
        $maincategory = Category::where('status','Active')->get();
        if (isset($request->category_id) && $request->category_id !='') {
        $subcategory = SubCategory::where('status','Active')->where('category_id',$request->category_id)->get();
        $childcategory = ChildCategory::where('subcategory_id',$data->subcategory_id)->where('status','Active')->get();

            if (isset($request->subcategory_id) && $request->subcategory_id !='') {
             $childcategory = ChildCategory::where('subcategory_id',$request->subcategory_id)->where('status','Active')->get();
            }else{
             $childcategory = ChildCategory::where('subcategory_id',$data->subcategory_id)->where('status','Active')->get();
            }
        }
        else{
            $subcategory = Subcategory::where('status','Active')->where('category_id',$data->category_id)->get();
           $childcategory = ChildCategory::where('subcategory_id',$data->subcategory_id)->where('status','Active')->get();

        }
        return view('admin.subchildcategory.edit', compact('data', 'data1','data2','data3','firstcategory','maincategory','subcategory','childcategory'));
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
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'childcategory_id' => 'required',
            'subchildcat_name' => 'required',
       ]);
        $dep =  Category::where('id',$request->category_id)->first();
        $depp = SubCategory::where('id',$request->subcategory_id)->first();
        $deppp = ChildCategory::where('id',$request->childcategory_id)->first();
        $merge = $request->childcat_name .' '.$dep->cat_name.' '.$depp->subcat_name.' '.$deppp->childcat_name;
        $slug = Helper::getBlogUrl($merge);
        $data = SubChildCategory::find($id);
        $data->subchildcat_name = $request->subchildcat_name;
        $data->subchildcat_slug = $slug;
        $data->category_id=$request->category_id;
        $data->subcategory_id=$request->subcategory_id;
        $data->childcategory_id=$request->childcategory_id;
        $data->subchildstatus = $request->subchildstatus;
        $data->subchilddescription = $request->subchilddescription;
        if ($request->hasfile('subchildcat_image')) {
            @unlink(public_path('uploads/images/'.$data->subchildcat_image));
            $file = $request->file('childcat_image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
            $file->move(public_path('uploads/images'), $filename);
            $data->subchildcat_image = $filename;
        }
        if ($request->hasfile('subchildcat_logo')) {
            @unlink(public_path('uploads/images/'.$data->subchildcat_logo));
            $file = $request->file('subchildcat_logo');
            $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
            $file->move(public_path('uploads/images'), $filename1);
            $data->subchildcat_logo = $filename1;
        }
        if($request->top_subchildcategory==''){
            $data->top_subchildcategory = '0';
        }else if($request->top_subchildcategory== 'on'){
            $data->top_subchildcategory = '1';
        }

        $data->save();
        return back()->with('flash_success', 'SubChildCategory Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = SubChildCategory::find($id);
        @unlink(public_path('uploads/images/'.$data->subchildcat_image));
        $data->delete();
        return back()->with('flash_success', 'SubChildCategory Deleted  Successfully!');
    }
}
