<?php

namespace App\Http\Controllers\Backend\Manager;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {

        $data = Category::orderBy('id','DESC')->get();

        return view('manager.category.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $data = Category::where('status','Active')->get();
       return view('manager.category.create',compact('data'));
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
            'cat_name' => 'required',
        ]);

        $slug = Helper::getBlogUrl($request->cat_name);
        if (Category::where('cat_slug', '=', $slug)->count() > 0)
        {
            return back()->with('flash_error', 'Category Already Exits');
        }
        else{
            $data = new Category;
            $data->cat_name = $request->cat_name;
            $data->cat_slug = $slug;
            $data->status = $request->status;
            $data->description = $request->description;
            if($request->hasfile('images'))
            {
               $file = $request->file('images');
                $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                $file->move(public_path('uploads/images'),$filename1);
                $data->image = $filename1;
            }
            if($request->hasfile('logo'))
            {
                $file = $request->file('logo');
                $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                $file->move(public_path('uploads/images'),$filename1);
                $data->logo = $filename1;
            }

            $data->save();
            return back()->with('flash_success', 'Category Created successfully');
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
        $data = Category::find($id);
        $data1=Category::where('status','Active')->get();
        return view('manager.category.edit',compact('data','data1'));
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
            'cat_name' => 'required',
        ]);
        $slug = Helper::getBlogUrl($request->cat_name);

        $data = Category::find($id);
        $data->cat_name = $request->cat_name;
        $data->cat_slug = $slug;
        $data->status = $request->status;
        $data->description = $request->description;
        if($request->hasfile('images'))
        {
            @unlink(public_path('uploads/images/'.$data->image));
            $file = $request->file('images');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
            $file->move(public_path('uploads/images'),$filename);
            $data->image = $filename;
        }
        if($request->hasfile('logo'))
        {
            @unlink(public_path('uploads/images/'.$data->logo));
            $file = $request->file('logo');
            $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
            $file->move(public_path('uploads/images'),$filename1);
            $data->logo = $filename1;
        }

        $data->save();
        return back()->with('flash_success', 'Category Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Category::find($id);
        @unlink(public_path('uploads/images/'.$data->image));
        $sub = SubCategory::where('category_id', $id)->delete();
        $subb = ChildCategory::where('category_id', $id)->delete();
        $data->delete();
        return back()->with('flash_success', 'Category Deleted  Successfully!');
    }

}
