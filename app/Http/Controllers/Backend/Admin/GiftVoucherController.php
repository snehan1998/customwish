<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\GiftCard;
use Illuminate\Http\Request;

class GiftVoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = GiftCard::orderBy('id','DESC')->get();
        return view('admin.giftcard.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.giftcard.create');
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
            'giftvoucher_name' => 'required',
            'giftvoucher_price' => 'required',
            'giftvoucher_image' => 'required',
            'giftvoucher_status' => 'required',
        ]);
            $data = new GiftCard();
            $data->giftvoucher_name = $request->giftvoucher_name;
            $data->giftvoucher_price = $request->giftvoucher_price;
            $data->giftvoucher_status = $request->giftvoucher_status;
            if($request->hasfile('giftvoucher_image'))
            {
                $file = $request->file('giftvoucher_image');
                $filename1 = uniqid() . '.' . $file->getClientOriginalExtension($file);
                $file->move(public_path('uploads/images'),$filename1);
                $data->giftvoucher_image = $filename1;
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
        $data = GiftCard::find($id);
        return view('admin.giftcard.edit',compact('data'));
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
            'giftvoucher_name' => 'required',
            'giftvoucher_price' => 'required',
            'giftvoucher_status' => 'required',
        ]);
        $data = GiftCard::find($id);
        $data->giftvoucher_name = $request->giftvoucher_name;
        $data->giftvoucher_price = $request->giftvoucher_price;
        $data->giftvoucher_status = $request->giftvoucher_status;
        if($request->hasfile('giftvoucher_image'))
        {
            @unlink(public_path('uploads/images/'.$data->giftvoucher_image));
            $file = $request->file('giftvoucher_image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
            $file->move(public_path('uploads/images'),$filename);
            $data->giftvoucher_image = $filename;
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
        $data = GiftCard::find($id);
        @unlink(public_path('uploads/images/'.$data->giftvoucher_image));
        $data->delete();
        return back()->with('flash_success', 'Deleted  Successfully!');
    }

}
