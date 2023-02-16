<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Page::orderBy('id','DESC')->get();
        return view('admin.pages.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Page::all();
        return view('admin.pages.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request, [
            'title' => 'required',
        ]);


        $page = new Page();
        $page->title = $request->title;
        $page->slug = Helper::getBlogUrl($request->title);
        if($request->hasfile('page_image'))
        {
            $file = $request->file('page_image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
            $file->move(public_path('uploads/images'),$filename);
            $page->page_image = $filename;
        }
        $page->content = $request->content;
        $page->save();
        return back()->with('flash_success', 'Created successfully');

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
        $data = Page::find($id);
        return view('admin.pages.edit',compact('data'));
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
        $this->validate($request, [
            'title' => 'required',
        ]);
        $page = Page::find($id);
        $page->title = $request->title;
        $page->slug = Helper::getBlogUrl($request->title);
        if($request->hasfile('page_image'))
        {
            @unlink(public_path('uploads/images/'.$page->page_image));
            $file = $request->file('page_image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
            $file->move(public_path('uploads/images'),$filename);
            $page->page_image= $filename;
        }
        $page->content = $request->content;
        $page->save();
        return back()->with('flash_success', 'Updated successfully');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Page::find($id);
        @unlink(public_path('uploads/images/'.$data->page_image));
        $data->delete();
        return back()->with('flash_success', 'Deleted  Successfully!');
    }

}
