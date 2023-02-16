<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function list(Request $request,$id)
    {
        $products = Product::where('status','Active')->where('childcategory_id',$id)->filter($request->all())->get();
        $stockk= $request->stock;
        $priceee = $request->price;
        $attribute = Attribute::all();
        $attvaluee = $request->attribute;
        $child = ChildCategory::where('id',$id)->first();
        $sub = SubCategory::where('id',$child->subcategory_id)->first();
        $cat = Category::where('id',$child->category_id)->first();
        $testimonial = Testimonial::OrderBy('id','DESC')->get();
        $trend = Product::where('childcategory_id',$id)->where('status','Active')->where('trending','1')->limit('4')->get();
        return view('productfilter', compact('products','child','stockk','attribute','attvaluee','priceee','sub','cat','testimonial','trend'));
    }
    public function subproductlist(Request $request,$id)
    {
        $products = Product::where('status','Active')->where('subcategory_id',$id)->filter($request->all())->get();
        $stockk= $request->stock;
        $priceee = $request->price;
        $attribute = Attribute::all();
        $attvaluee = $request->attribute;
        $sub = SubCategory::where('id',$id)->first();
        $cat = Category::where('id',$sub->category_id)->first();
        $testimonial = Testimonial::OrderBy('id','DESC')->get();
        $trend = Product::where('childcategory_id',$id)->where('status','Active')->where('trending','1')->limit('4')->get();
        return view('subproductfilter', compact('products','stockk','attribute','attvaluee','priceee','sub','cat','testimonial','trend'));
    }

    public function searchproductlist(Request $request)
    {
        $products = Product::where('status','Active')->where('subcategory_id',$id)->filter($request->all())->get();
        $stockk= $request->stock;
        $priceee = $request->price;
        $attribute = Attribute::all();
        $attvaluee = $request->attribute;
        $sub = SubCategory::where('id',$id)->first();
        $cat = Category::where('id',$sub->category_id)->first();
        $testimonial = Testimonial::OrderBy('id','DESC')->get();
        $trend = Product::where('childcategory_id',$id)->where('status','Active')->where('trending','1')->limit('4')->get();
        return view('subproductfilter', compact('products','stockk','attribute','attvaluee','priceee','sub','cat','testimonial','trend'));

    }
}
