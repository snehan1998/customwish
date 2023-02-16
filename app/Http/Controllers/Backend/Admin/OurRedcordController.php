<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\OurRecord;
use Illuminate\Http\Request;

class OurRedcordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = OurRecord::orderBy('id','DESC')->get();
        return view('admin.ourrecord.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.ourrecord.create');
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
            'title' => 'required',
        ]);
            $data = new OurRecord();
            $data->title = $request->title;
            $data->yearr = $request->yearr;
            $data->desc = $request->desc;
            if($request->hasfile('our_image'))
            {
               $file = $request->file('our_image');
                $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                $file->move(public_path('uploads/images'),$filename1);
                $data->our_image = $filename1;
            }
            $data->save();
            return back()->with('flash_success', ' Created successfully');
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
        $data = OurRecord::find($id);
        return view('admin.ourrecord.edit',compact('data'));
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
            'title' => 'required',
        ]);
        $data = OurRecord::find($id);
        $data->title = $request->title;
        $data->yearr = $request->yearr;
        $data->desc = $request->desc;
        if($request->hasfile('our_image'))
        {
            @unlink(public_path('uploads/images/'.$data->our_image));
            $file = $request->file('our_image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
            $file->move(public_path('uploads/images'),$filename);
            $data->our_image = $filename;
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
        $data = OurRecord::find($id);
        @unlink(public_path('uploads/images/'.$data->our_image));
        $data->delete();
        return back()->with('flash_success', 'Deleted  Successfully!');
    }
}
