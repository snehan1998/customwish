<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\AddSubVariation;
use App\Models\AttributeValue;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\CareerForm;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Contact;
use App\Models\ContactForm;
use App\Models\Faq;
use App\Models\LeaveComment;
use App\Models\OurRecord;
use App\Models\OurTeam;
use App\Models\Page;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductSelectHeading;
use App\Models\ProductSelectOption;
use App\Models\Section2;
use App\Models\Section8;
use App\Models\StoreCartAttribute;
use App\Models\SubCategory;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class WebsiteController10 extends Controller
{
    public function index(Request $request)
    {
        $banners = Banner::where('status','Active')->get();
        $section2 = Section2::orderBy('id','ASC')->get();
        $testimonial = Testimonial::OrderBy('id','DESC')->get();
        $section8 = Section8::orderBy('id','ASC')->get();
       return view('welcome',compact('banners','section2','testimonial','section8'));
    }
    public function contactus(Request $request)
    {
        $section8 = Section8::orderBy('id','ASC')->get();
        $contact = Contact::where('id','1')->first();
        return view('contact',compact('section8','contact'));
    }
    public function aboutus(Request $request)
    {
        $section8 = Section8::orderBy('id','ASC')->get();
        $about = About::where('id','1')->first();
        $ourrecord = OurRecord::orderBy('id','DESC')->get();
        $ourteam = OurTeam::orderBy('id','DESC')->get();
        return view('aboutus',compact('section8','about','ourteam','ourrecord'));
    }
    public function bloglist(Request $request)
    {
        $blogs = Blog::orderBy('id','DESC')->paginate(1);
        $recent = Blog::orderBy('id','DESC')->limit(5)->get();
        $blogcat = BlogCategory::orderBy('id','DESC')->get();
        return view('bloglist',compact('blogs','blogcat','recent'));
    }
    public function blogcat(Request $request,$id)
    {
        $blogs = Blog::where('category_id',$id)->orderBy('id','DESC')->paginate(1);
        $recent = Blog::where('category_id',$id)->orderBy('id','DESC')->limit(5)->get();
        $blogcat = BlogCategory::orderBy('id','DESC')->get();
        return view('blogcategory',compact('blogs','blogcat','recent'));
    }
    public function blogdetails(Request $request,$slug)
    {
        $blogcat = BlogCategory::orderBy('id','DESC')->get();
        $blog = Blog::where('slug',$slug)->first();
        $recent = Blog::orderBy('id','DESC')->limit(5)->get();
        $comment = LeaveComment::where('blog_id',$blog->id)->where('status','Active')->count();
        return view('blogdetail',compact('blog','blogcat','recent','comment'));
    }
    public function faq(Request $request)
    {
        $faq = Faq::orderBy('id','DESC')->get();
        $section8 = Section8::orderBy('id','ASC')->get();
        return view('faq',compact('section8','faq'));
    }
    public function testimonial(Request $request)
    {
        $testi = Testimonial::orderBy('id','DESC')->get();
        $section8 = Section8::orderBy('id','ASC')->get();
        return view('client',compact('section8','testi'));
    }
    public function dynamicpage(Request $request,$id)
    {
        $page = Page::where('id',$id)->first();
        return view('termsconditions',compact('page'));
    }

    public function subcategory(Request $request,$id)
    {
        $category = SubCategory::where('category_id',$id)->where('status','Active')->get();
        $testimonial = Testimonial::OrderBy('id','DESC')->get();
        $section8 = Section8::orderBy('id','ASC')->get();
        return view('category',compact('category','testimonial','section8'));
    }

    public function childcategory(Request $request,$id)
    {
        $child = ChildCategory::where('subcategory_id',$id)->where('status','Active')->get();
        $sub = SubCategory::where('id',$id)->first();
        $cat = Category::where('id',$sub->category_id)->first();
        $testimonial = Testimonial::OrderBy('id','DESC')->get();
        $section8 = Section8::orderBy('id','ASC')->get();
        return view('subcategory',compact('child','testimonial','section8','sub','cat'));
    }

    public function productlist(Request $request,$id)
    {
        $products = Product::where('status','Active')->where('childcategory_id',$id)->get();
        $child = ChildCategory::where('id',$id)->first();
        $sub = SubCategory::where('id',$child->subcategory_id)->first();
        $cat = Category::where('id',$child->category_id)->first();
        $testimonial = Testimonial::OrderBy('id','DESC')->get();
        return view('productlist',compact('products','testimonial','child','sub','cat'));
    }

    public function productdetail(Request $request,$slug)
    {
        $product = Product::where('status','Active')->where('slug',$slug)->first();
        $testimonial = Testimonial::OrderBy('id','DESC')->get();
        return view('productdetails',compact('product','testimonial'));
    }
    public function loadd(Request $request)
    {
        if ($request->buttonid) {
            $data = AttributeValue::where('id', $request->att)->orwhere('id', $request->selecct)->first();
            $att = StoreCartAttribute::where('attribute', $data->attr_id)->where('session_id', Session::getId())->where('product_id', $request->product)->first();
            if ($att) {
                $store = StoreCartAttribute::where('attribute', $data->attr_id)->where('buttonid',$request->buttonid)->where('session_id', Session::getId())->where('product_id', $request->product)
                ->update(['session_id' => Session::getId(), 'attribute' => $data->attr_id ,'att_id' => $request->att,'buttonid'=>$request->buttonid]);
            } else {
                $store = new StoreCartAttribute();
                $store->session_id = Session::getId();
                $store->product_id = $request->product;
                $store->buttonid = $request->buttonid;
                $store->attribute = $data->attr_id;
                if ($request->att != "") {
                    $store->att_id = $request->att;
                } elseif ($request->selecct != "") {
                    $store->att_id = $request->selecct;
                }
                $store->save();
            }
        }else{
            $data = AttributeValue::where('id', $request->att)->orwhere('id', $request->selecct)->first();
            $att = StoreCartAttribute::where('attribute', $data->attr_id)->where('session_id', Session::getId())->where('product_id', $request->product)->first();
            if ($att) {
                $store = StoreCartAttribute::where('attribute', $data->attr_id)->where('session_id', Session::getId())->where('product_id', $request->product)
                ->update(['session_id' => Session::getId(), 'attribute' => $data->attr_id ,'att_id' => $request->att]);
            } else {
                $store = new StoreCartAttribute();
                $store->session_id = Session::getId();
                $store->product_id = $request->product;
                $store->attribute = $data->attr_id;
                if ($request->att != "") {
                    $store->att_id = $request->att;
                } elseif ($request->selecct != "") {
                    $store->att_id = $request->selecct;
                }
                $store->save();
            }
        }
        return response()->json($store);
    }
    public function fetchproduct(Request $request)
    {
         $request->all();
        $var = StoreCartAttribute::where('session_id',Session::getId())->where('product_id',$request->productdd)->get();
        foreach($var as $var){
            $vari[] = $var->att_id;
        }
        $tags = implode(',',$vari);
        $dat = $request->attr2;
        $datt[] = $dat;
        $request->attr2;
         $tags;
      return $dataa = AddSubVariation::where("main_attr_value",$tags)->where('product_id',$request->productdd)->get(["main_attr_id","main_attr_value","price","strike_price", "product_id", "stock", "def", "quantity","skucode","id"]);

        return response()->json($dataa);
    }

    public function fetchimages(Request $request)
    {
        return $request->all();
        $var = StoreCartAttribute::where('session_id',Session::getId())->where('product_id',$request->productdd)->get();
        foreach($var as $var){
        $vari[] = $var->att_id;
        }
         $tags = implode(',',$vari);
         $request->productdd;
         $dataa = AddSubVariation::where("main_attr_value",$tags)->where('product_id',$request->productdd)->first(["main_attr_id","main_attr_value","price","strike_price", "product_id", "stock", "def", "quantity","skucode","id"]);
        $img = ProductImage::where('variation_product_id',$dataa->id)->where('product_id',$dataa->product_id)->get();
        return response()->json($img);
    }

    public function contactform(Request $request)
    {
        $data = new ContactForm();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->subject = $request->subject;
        $data->message = $request->message;
        $data->save();
        //return $mailData;

        if($data){
            $dataa = array(
            'name' =>$request->name,
            'email' =>$request->email,
            'subject' =>$request->subject,
            'message1' =>$request->message,
            'user'=>'user',
            );

            Mail::send(['html'=>'mail.contactformmail'], $dataa, function($message) use ($dataa) {
                $message->to($dataa['email'])->subject
                    ('Contact Form');
                $message->from('sneha@telcopl.com','Customwish');
            });
            $dataaa = array(
                'user'=>'admin',
                'name' =>$request->name,
                'email' =>$request->email,
                'subject' =>$request->subject,
                'message1' =>$request->message,
            );
            Mail::send(['html'=>'mail.contactformmail'], $dataaa, function($message) {
                $message->to('sneha@telcopl.com')->subject
                    (' Contact Form');
                $message->from('sneha@telcopl.com','Customwish');
            });
            return back()->with('success','Thank You Our Team will get back shortly!');
        }else{
            return back()->with('success','Something went wrong please try again later');
        }

    }

    public function leaveacomment(Request $request)
    {
        $data = new LeaveComment();
        $data->blog_id = $request->blog_id;
        $data->blog_name = $request->blog_name;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->website = $request->website;
        $data->comment = $request->comment;
        $data->save();
        //return $mailData;

        if($data){
            $dataa = array(
            'blog_id' =>$request->blog_id,
            'blog_name' =>$request->blog_name,
            'name' =>$request->name,
            'email' =>$request->email,
            'website' =>$request->website,
            'comment' =>$request->comment,
            'user'=>'user',
            );

            Mail::send(['html'=>'mail.leaveformmail'], $dataa, function($message) use ($dataa) {
                $message->to($dataa['email'])->subject
                    ('Leave a Comment  Form');
                $message->from('sneha@telcopl.com','Customwish');
            });
            $dataaa = array(
                'user'=>'admin',
                'blog_id' =>$request->blog_id,
                'blog_name' =>$request->blog_name,
                'name' =>$request->name,
                'email' =>$request->email,
                'website' =>$request->website,
                'comment' =>$request->comment,
            );
            Mail::send(['html'=>'mail.leaveformmail'], $dataaa, function($message) {
                $message->to('sneha@telcopl.com')->subject
                    (' Leave a Comment Form');
                $message->from('sneha@telcopl.com','Customwish');
            });
            return back()->with('success','Thank You Our Team will get back shortly!');
        }else{
            return back()->with('success','Something went wrong please try again later');
        }

    }
    public function career(Request $request)
    {
        $section8 = Section8::orderBy('id','ASC')->get();
        return view('careeropportunity',compact('section8'));
    }
    public function careerform(Request $request)
    {
        $data = new CareerForm();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->position = $request->position;
        $data->experience = $request->experience;
        $data->message = $request->message;
        $request->hasfile('resume');
        if($request->hasfile('resume')){
           $file=$request->file('resume');
           $extension=$file->getClientOriginalExtension();
           $filename2=mt_rand(15, 50) . time().'.'.$extension;
           $path2=$file->move(public_path().'/uploads/pdf/',$filename2);
           $data->resume = $filename2;
       }
        $data->save();
        //return $mailData;

        if($data){
            $dataa = array(
            'name' =>$request->name,
            'mobile' =>$request->phone,
            'email' => $request->email,
            'position' => $request->position,
            'experience' => $request->experience,
            'profileresume' => $data->resume,
            'message1' => $request->message,
            'user'=>'user',
            );

            Mail::send(['html'=>'mail.careerformmail'], $dataa, function($message) use ($dataa) {
                $message->to($dataa['email'])->subject
                    ('Career Form');
                $message->from('sneha@telcopl.com','Customwish');
            });
            $dataaa = array(
                'user'=>'admin',
                'name' =>$request->name,
                'mobile' =>$request->phone,
                'email' => $request->email,
                'position' => $request->position,
                'experience' => $request->experience,
                'profileresume' => $data->resume,
                'message1' => $request->message,
            );
            Mail::send(['html'=>'mail.careerformmail'], $dataaa, function($message) {
                $message->to('sneha@telcopl.com')->subject
                    (' Career Form');
                $message->from('sneha@telcopl.com','Customwish');
            });
            return back()->with('success','Thank You Our Team will get back shortly!');
        }else{
            return back()->with('success','Something went wrong please try again later');
        }

    }

}
