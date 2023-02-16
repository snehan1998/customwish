<?php

namespace App\Http\Controllers\Backend\Manager;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = SubCategory::orderBy('id', 'DESC')->with('category')->get();
        return view('manager.subcategory.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Category::where('status', 'Active')->get();
        return view('manager.subcategory.create', compact('data'));
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
            'subcat_name' => 'required',
        ]);
        $dep =  Category::where('id',$request->category_id)->first();

        $merge = $request->subcat_name . ' '.$dep->cat_name;
        $slug = Helper::getBlogUrl($merge);

      //  $slug = Helper::getBlogUrl($request->subcat_name);
        if (Subcategory::where('subcat_slug', '=', $slug)->count() > 0) {
            return back()->with('flash_error', 'SubCategory Already Exits');
        } else {
           // return $request->new_launche;
            $data = new Subcategory;
            $data->subcat_name = $request->subcat_name;
            $data->subcat_slug = $slug;
            $data->category_id=$request->category_id;
            $data->status = $request->status;
            $data->description = $request->description;
            if ($request->hasfile('subcat_image')) {
                $file = $request->file('subcat_image');
                $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                $file->move(public_path('uploads/images'), $filename1);
                $data->subcat_image = $filename1;
            }
            if ($request->hasfile('subcat_logo')) {
                $file = $request->file('subcat_logo');
                $filename2 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                $file->move(public_path('uploads/images'), $filename2);
                $data->subcat_logo = $filename2;
            }
            if($request->top_subcategory==''){
                $data->top_subcategory = '0';
            }else if($request->top_subcategory== 'on'){
                $data->top_subcategory = '1';
            }
            $data->save();

            return back()->with('flash_success', 'SubCategory Created successfully');
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
    public function edit($id)
    {
        $data = Subcategory::find($id);
        $data1=Category::where('status', 'Active')->get();
        return view('manager.subcategory.edit', compact('data', 'data1'));
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
            'subcat_name' => 'required',
            'category_id' => 'required',
        ]);
       // $slug = Helper::getBlogUrl($request->subcat_name);
       $dep =  Category::where('id',$request->category_id)->first();
       $merge = $request->subcat_name . ' '.$dep->cat_name;
       $slug = Helper::getBlogUrl($merge);

        $data = Subcategory::find($id);
        $data->subcat_name = $request->subcat_name;
        $data->subcat_slug = $slug;
        $data->category_id=$request->category_id;
        $data->status = $request->status;
        $data->description = $request->description;
        if ($request->hasfile('subcat_image')) {
            @unlink(public_path('uploads/images/'.$data->subcat_image));
            $file = $request->file('subcat_image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
            $file->move(public_path('uploads/images'), $filename);
            $data->subcat_image = $filename;
        }
        if ($request->hasfile('subcat_logo')) {
            @unlink(public_path('uploads/images/'.$data->subcat_logo));
            $file = $request->file('subcat_logo');
            $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
            $file->move(public_path('uploads/images'), $filename1);
            $data->subcat_logo = $filename1;
        }
        if($request->top_subcategory==''){
            $data->top_subcategory = '0';
        }else if($request->top_subcategory== 'on'){
            $data->top_subcategory = '1';
        }
        $data->save();


        return back()->with('flash_success', 'SubCategory Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = SubCategory::find($id);
        @unlink(public_path('uploads/images/'.$data->subcat_image));
        $sub = ChildCategory::where('subcategory_id', $id)->delete();
        $data->delete();
        return back()->with('flash_success', 'SubCategory Deleted  Successfully!');
    }
}
