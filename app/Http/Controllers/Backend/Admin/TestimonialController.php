<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Testimonial::orderBy('id','DESC')->get();
        return view('admin.testimonial.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.testimonial.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Testimonial;
        $data->name = $request->name;
        $data->designation = $request->designation;
        $data->description = $request->description;
        $data->rating = $request->rating;
        $data->letter = $request->letter;
        if ($request->hasfile('image1')) {
            $file = $request->file('image1');
            $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
            $file->move(public_path('uploads/images'), $filename1);
            $data->image1 = $filename1;
        }
        if ($request->hasfile('image2')) {
            $file = $request->file('image2');
            $filename2 = uniqid() . '.' . $file->getClientOriginalExtension($file);
            $file->move(public_path('uploads/images'), $filename2);
            $data->image2 = $filename2;
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
        $data = Testimonial::find($id);
        return view('admin.testimonial.edit',compact('data'));
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
        $data = Testimonial::find($id);
        $data->name = $request->name;
        $data->designation = $request->designation;
        $data->description = $request->description;
        $data->letter = $request->letter;
        $data->rating = $request->rating;
        if ($request->hasfile('image1')) {
            @unlink(public_path('uploads/images/'.$data->image1));
            $file = $request->file('image1');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
            $file->move(public_path('uploads/images'), $filename);
            $data->image1 = $filename;
        }
        if ($request->hasfile('image2')) {
            @unlink(public_path('uploads/images/'.$data->image2));
            $file = $request->file('image2');
            $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
            $file->move(public_path('uploads/images'), $filename1);
            $data->image2 = $filename1;
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
        $data = Testimonial::find($id);
        $data->delete();
        return back()->with('flash_success', 'Deleted  Successfully!');
    }
}
