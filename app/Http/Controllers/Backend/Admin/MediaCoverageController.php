<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\MediaCoverage;
use Illuminate\Http\Request;

class MediaCoverageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = MediaCoverage::all();
        return View('admin.media.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.media.create');

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
            'media_name' => 'required',
        ]);
        $slug = Helper::getBlogUrl($request->media_name);
        if (MediaCoverage::where('media_slug', '=', $slug)->count() > 0)
        {
            return back()->with('flash_error', 'Media Coverage Already Exits');
        }
        else{
            $media = new MediaCoverage();
            $media->media_datee = $request->media_datee;
            $media->media_slug = $slug;
            $media->media_name = $request->media_name;
            $media->media_short_desc = $request->media_short_desc;
            $media->media_long_desc = $request->media_long_desc;
            if ($request->hasfile('media_images')) {
                $file = $request->file('media_images');
                $filename = time() . '.' . $file->getClientOriginalExtension($file);
                $filePath = 'uploads/images/' . $filename;
                $file->move(public_path('uploads/images'), $filePath);
                $media->media_images = $filename;
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
        $data = MediaCoverage::find($id);
        return view('admin.media.edit',compact('data'));
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
            'media_name' => 'required',

        ]);
        $slug = Helper::getBlogUrl($request->media_name);
        $media = MediaCoverage::find($id);
        $media->media_datee = $request->media_datee;
        $media->media_slug = $slug;
        $media->media_name = $request->media_name;
        $media->media_short_desc = $request->media_short_desc;
        $media->media_long_desc = $request->media_long_desc;
        if($request->hasfile('media_images'))
        {
            @unlink(public_path('uploads/images/'.$media->media_images));
            $file = $request->file('media_images');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
            $file->move(public_path('uploads/images'),$filename);
            $media->media_images = $filename;
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
        $media = MediaCoverage::find($id);
        @unlink('public/uploads/images/'.$media->media_images);
        $media->delete();
        return back()->with('flash_success', 'Deleted  Successfully!');
    }
}
