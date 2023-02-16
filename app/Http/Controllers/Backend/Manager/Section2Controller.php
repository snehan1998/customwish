<?php

namespace App\Http\Controllers\Backend\Manager;

use App\Http\Controllers\Controller;
use App\Models\Section2;
use Illuminate\Http\Request;

class Section2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Section2::orderBy('id','DESC')->get();
        return view('manager.section2.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('manager.section2.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Section2;
        $data->title = $request->title;
        $data->button_name = $request->button_name;
        $data->button_url = $request->button_url;
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
            $file->move(public_path('uploads/images'), $filename1);
            $data->image = $filename1;
        }
        $data->save();
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
        $data = Section2::find($id);
        return view('manager.section2.edit',compact('data'));
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
        $data = Section2::find($id);
        $data->title = $request->title;
        $data->button_name = $request->button_name;
        $data->button_url = $request->button_url;
        if ($request->hasfile('image')) {
            @unlink(public_path('uploads/images/'.$data->image));
            $file = $request->file('image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
            $file->move(public_path('uploads/images'), $filename);
            $data->image = $filename;
        }
        $data->save();
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
        $data = Section2::find($id);
        $data->delete();
        return back()->with('flash_success', 'Deleted  Successfully!');
    }
}
