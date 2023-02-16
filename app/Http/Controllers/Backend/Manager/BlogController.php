<?php

namespace App\Http\Controllers\Backend\Manager;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Helpers\Helper;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Blog::all();
        return View('manager.blog.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cat = BlogCategory::all();
        return view('manager.blog.create',compact('cat'));

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
            'name' => 'required',
        ]);
        $slug = Helper::getBlogUrl($request->name);
        if (Blog::where('slug', '=', $slug)->count() > 0)
        {
            return back()->with('flash_error', 'Blog Already Exits');
        }
        else{
            $blog = new Blog;
            $blog->datee = $request->datee;
            $blog->slug = $slug;
            $blog->name = $request->name;
            $blog->category_id = $request->category_id;
            $blog->short_desc = $request->short_desc;
            $blog->long_desc = $request->long_desc;
            $blog->added_by = $request->added_by;
            if ($request->hasfile('images')) {
                $file = $request->file('images');
                $filename = time() . '.' . $file->getClientOriginalExtension($file);
                $filePath = 'uploads/images/' . $filename;
                $file->move(public_path('uploads/images'), $filePath);
                $blog->images = $filename;
            }
            $blog->save();
            return back()->with('flash_success', 'Created successfully');
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
        $data = Blog::find($id);
        $cat = BlogCategory::all();
        return view('manager.blog.edit',compact('data','cat'));
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
            'name' => 'required',

        ]);
        $slug = Helper::getBlogUrl($request->name);
        $blog = Blog::find($id);
        $blog->datee = $request->datee;
        $blog->slug = $slug;
        $blog->name = $request->name;
        $blog->category_id = $request->category_id;
        $blog->short_desc = $request->short_desc;
        $blog->long_desc = $request->long_desc;
        $blog->added_by = $request->added_by;
        if($request->hasfile('images'))
        {
            @unlink(public_path('uploads/images/'.$blog->images));
            $file = $request->file('images');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
            $file->move(public_path('uploads/images'),$filename);
            $blog->images = $filename;
        }

        $blog->save();
        return back()->with('flash_success', ' Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);
        @unlink('public/uploads/images/'.$blog->images);
        $blog->delete();
        return back()->with('flash_success', 'Deleted  Successfully!');
    }
}
