<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;

class AttributeValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

          $data=AttributeValue::all();
          return View('admin.attributevalue.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
          $attr=Attribute::where('id',$id)->first();
          $data=AttributeValue::where('attr_id',$id)->get();
          return View('admin.attributevalue.create',compact('attr','data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'attr_id' => 'required',
            'attr_value_name' => 'required',
        ]);

        $attribute = new AttributeValue();
        $attribute->attr_id = $request->attr_id;
        $attribute->attr_value_name = $request->attr_value_name;
        $attribute->attr_value_title = $request->attr_value_title;
        $attribute->attr_color = $request->attr_color;
        $attribute->is_default = $request->is_default;
        $attribute->save();
        return back()->with('flash_success', 'Attribute Values Created successfully');

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

          return View('admin.attributevalue.edit');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attribute = AttributeValue::find($id);
        $attribute->delete();
        return back()->with('flash_success', 'Attribute Value Deleted  Successfully!');

    }
}
