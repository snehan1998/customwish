<?php

namespace App\Http\Controllers\Backend\Manager;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ReviewController extends Controller
{
    public function index()
    {
        $data = Review::orderBy('id','DESC')->get();
        return view('manager.review.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $product = Product::get();
       $data = Review::where('status','Active')->get();
       return view('manager.review.create',compact('data','product'));
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
            'product_id' => 'required',
        ]);

        $data = new Review();
        $data->user_id = Auth::user()->id;
        $data->session_id = Session::getId();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->product_id = $request->product_id;
        $data->comment = $request->comment;
        $data->rating = $request->rating;
        $data->status = $request->status;
        if($request->hasfile('review_image'))
        {
            $file = $request->file('review_image');
            $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
            $file->move(public_path('uploads/images'),$filename1);
            $data->review_image = $filename1;
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
        $data = Review::find($id);
        $product = Product::get();
        return view('manager.review.edit',compact('data','product'));
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
            'product_id' => 'required',
        ]);
        $data = Review::find($id);
        $data->user_id = Auth::user()->id;
        $data->session_id = Session::getId();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->product_id = $request->product_id;
        $data->comment = $request->comment;
        $data->rating = $request->rating;
        $data->status = $request->status;
        if($request->hasfile('review_image'))
        {
            @unlink(public_path('uploads/images/'.$data->review_image));
            $file = $request->file('review_image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
            $file->move(public_path('uploads/images'),$filename);
            $data->review_image = $filename;
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
        $data = Review::find($id);
        $data->delete();
        return back()->with('flash_success', 'Deleted  Successfully!');
    }
}
