<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Attribute::get();
        return view('admin.attribute.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Attribute::get();
        return view('admin.attribute.create',compact('data'));
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
            'attr_name' => 'required',
        ]);
        $slug = Helper::getBlogUrl($request->attr_name);

        $attr = new Attribute();
        $attr->attr_name = $request->attr_name;
        $attr->attr_label = $request->attr_label;
        $attr->attr_slug = $slug;
        $attr->save();
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
        $data = Attribute::find($id);
        return view('admin.attribute.edit',compact('data'));
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
        $slug = Helper::getBlogUrl($request->attr_name);

        $attr = Attribute::find($id);
        $attr->attr_name = $request->attr_name;
        $attr->attr_label = $request->attr_label;
        $attr->attr_slug = $slug;
        $attr->save();
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
        $attr = Attribute::find($id);
        $attrval = AttributeValue::where('attr_id',$id)->delete();
        $attr->delete();
        return back()->with('flash_success', 'Deleted  Successfully!');
    }
}
