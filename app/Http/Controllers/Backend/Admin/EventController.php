<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Event::all();
        return View('admin.event.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.event.create');

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
            'event_name' => 'required',
        ]);
        $slug = Helper::getBlogUrl($request->event_name);
        if (Event::where('event_slug', '=', $slug)->count() > 0)
        {
            return back()->with('flash_error', ' Already Exits');
        }
        else{
            $media = new Event();
            $media->event_datee = $request->event_datee;
            $media->event_slug = $slug;
            $media->event_name = $request->event_name;
            $media->event_short_desc = $request->event_short_desc;
            $media->event_long_desc = $request->event_long_desc;
            if ($request->hasfile('event_images')) {
                $file = $request->file('event_images');
                $filename = time() . '.' . $file->getClientOriginalExtension($file);
                $filePath = 'uploads/images/' . $filename;
                $file->move(public_path('uploads/images'), $filePath);
                $media->event_images = $filename;
            }
            $media->save();
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
        $data = Event::find($id);
        return view('admin.event.edit',compact('data'));
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
            'event_name' => 'required',

        ]);
        $slug = Helper::getBlogUrl($request->event_name);
        $media = Event::find($id);
        $media->event_datee = $request->event_datee;
        $media->event_slug = $slug;
        $media->event_name = $request->event_name;
        $media->event_short_desc = $request->event_short_desc;
        $media->event_long_desc = $request->event_long_desc;
        if($request->hasfile('event_images'))
        {
            @unlink(public_path('uploads/images/'.$media->event_images));
            $file = $request->file('event_images');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
            $file->move(public_path('uploads/images'),$filename);
            $media->event_images = $filename;
        }

        $media->save();
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
        $media = Event::find($id);
        @unlink('public/uploads/images/'.$media->event_images);
        $media->delete();
        return back()->with('flash_success', 'Deleted  Successfully!');
    }
}
