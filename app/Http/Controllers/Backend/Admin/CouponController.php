<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Coupon::orderBy('id','DESC')->get();
        return View('admin.coupons.index',compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('admin.coupons.create');
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
            'coupon_code' => 'required',
            'discount_type' => 'required',
            'discount_amount' => 'required',
            'minimum_order' => 'required',
            'validity_till' => 'required',
            'status' => 'required',
            'validity_from' => 'required'
        ]);

        if (Coupon::where('coupon_code', '=', $request->coupon_code)->count() > 0)
        {
           return back()->with('flash_error', 'Coupons Exists Can not Create Same Coupon Twice');
        }
        else
        {
            $user = new Coupon();
            $user->coupon_code = $request->coupon_code;
            $user->discount_type = $request->discount_type;
            $user->discount_amount = $request->discount_amount;
            $user->minimum_order = $request->minimum_order;
            $user->validity_till = $request->validity_till;
            $user->status = $request->status;
            $user->allow_multiple_use = $request->allow_multiple_use;
            $user->validity_from = $request->validity_from;
            $user->save();

            return back()->with('flash_success', 'Coupons added successfully');
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
        $data = Coupon::findOrFail($id);
        return View('admin.coupons.edit',compact('data'));

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
        $user = Coupon::find($id);
        $user->coupon_code = $request->coupon_code;
        $user->discount_type = $request->discount_type;
        $user->discount_amount = $request->discount_amount;
        $user->minimum_order = $request->minimum_order;
        $user->validity_till = $request->validity_till;
        $user->status = $request->status;
        $user->validity_from = $request->validity_from;
        $user->allow_multiple_use = $request->allow_multiple_use;
        $user->save();
       return back()->with('flash_success', 'Coupons Updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Coupon::findOrFail($id);
        $data->delete();
        return back()->with('flash_success', 'Coupon Deleted Successfully!');

    }
}
