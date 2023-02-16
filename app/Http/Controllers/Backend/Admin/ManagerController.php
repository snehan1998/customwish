<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Manager::orderBy('id','DESC')->get();
        return view('admin.manager.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.manager.create');
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
            'email' => 'required',
            'id_proof' => 'required',
            'phone' => 'required',
        ]);

        if (User::where('email',$request->email)->count() > 0)
        {
            return back()->with('flash_error', 'Email Already Exits');
        }
        else{

            $user = new  User();
            $user->role_id = 2;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->status = $request->status;
            $user->save();

            $data = new Manager;
            $data->user_id = $user->id;
            $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->password = $request->password;
            if($request->hasfile('id_proof'))
            {
               $file = $request->file('id_proof');
                $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                $file->move(public_path('uploads/images'),$filename1);
                $data->id_proof = $filename1;
            }
            $data->save();
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
        $data = Manager::find($id);
        $user = User::where('id', $data->user_id)->first();
        return view('admin.manager.edit',compact('data','user'));
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
            'email' => 'required',
            'phone' => 'required',
        ]);
        $manager = Manager::where('id', $id)->first();
        $user = User::where('id',$manager->user_id)->update([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'status' => $request->status,
        ]);
        $data = Manager::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->password = $request->password;
        if($request->hasfile('id_proof'))
        {
            @unlink(public_path('uploads/images/'.$data->id_proof));
            $file = $request->file('id_proof');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
            $file->move(public_path('uploads/images'),$filename);
            $data->id_proof = $filename;
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
        $data = Manager::find($id);
        $user = User::where('id',$data->user_id)->delete();
        $data->delete();
        return back()->with('flash_success', 'Deleted Successfully!');
    }
}
