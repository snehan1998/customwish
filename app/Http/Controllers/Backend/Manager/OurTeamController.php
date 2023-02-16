<?php

namespace App\Http\Controllers\Backend\Manager;

use App\Http\Controllers\Controller;
use App\Models\OurTeam;
use Illuminate\Http\Request;

class OurTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = OurTeam::orderBy('id','DESC')->get();
        return view('manager.ourteam.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('manager.ourteam.create');
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
            $data = new OurTeam();
            $data->name = $request->name;
            $data->designation = $request->designation;
            $data->description = $request->description;
            $data->facebook = $request->facebook;
            $data->instagram = $request->instagram;
            $data->twitter = $request->twitter;
            if($request->hasfile('team_image'))
            {
               $file = $request->file('team_image');
                $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                $file->move(public_path('uploads/images'),$filename1);
                $data->team_image = $filename1;
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
        $data = OurTeam::find($id);
        return view('manager.ourteam.edit',compact('data'));
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
        $data = OurTeam::find($id);
        $data->name = $request->name;
        $data->designation = $request->designation;
        $data->description = $request->description;
        $data->facebook = $request->facebook;
        $data->instagram = $request->instagram;
        $data->twitter = $request->twitter;
        if($request->hasfile('team_image'))
        {
            @unlink(public_path('uploads/images/'.$data->team_image));
            $file = $request->file('team_image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
            $file->move(public_path('uploads/images'),$filename);
            $data->team_image = $filename;
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
        $data = OurTeam::find($id);
        @unlink(public_path('uploads/images/'.$data->our_image));
        $data->delete();
        return back()->with('flash_success', 'Deleted  Successfully!');
    }
}
