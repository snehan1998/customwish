<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\AddSubVariation;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\CareerForm;
use App\Models\Cart;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Contact;
use App\Models\ContactForm;
use App\Models\Coupon;
use App\Models\Event;
use App\Models\Faq;
use App\Models\LandingCakes;
use App\Models\LeaveComment;
use App\Models\Location;
use App\Models\MediaCoverage;
use App\Models\Notifyme;
use App\Models\Order;
use App\Models\OurRecord;
use App\Models\OurTeam;
use App\Models\Page;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductRequired;
use App\Models\ProductSelectHeading;
use App\Models\ProductSelectOption;
use App\Models\Review;
use App\Models\Section2;
use App\Models\Section8;
use App\Models\StoreCartAttribute;
use App\Models\StoreCartCharm;
use App\Models\StoreCartCombo;
use App\Models\SubCategory;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Wishlist;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class WebsiteController extends Controller
{
    public function pushlocation(Request $request)
    {
        $location = $request->locationdd;
        $getresult=Location::pushchecklocation($location);
        return response()->json(['status'=>$getresult['status'],'message'=>$getresult['message']]);
    }
    public function google()
    {
        return view('googleAutocomplete');
    }
    public function index(Request $request)
    {
        $banners = Banner::where('status','Active')->get();
        $section2 = Section2::orderBy('id','ASC')->get();
        $testimonial = Testimonial::OrderBy('id','DESC')->get();
        $section8 = Section8::orderBy('id','ASC')->get();
        $trend = Product::where('status','Active')->where('trending','1')->limit('4')->get();
        $new = Product::where('status','Active')->where('newarrivalgift','1')->limit('4')->get();
        $cake = Product::whereRaw('FIND_IN_SET("2",cake_id)')->orderBy('id','DESC')->limit('4')->get();
        $cake1 = Product::whereRaw('FIND_IN_SET("3",cake_id)')->orderBy('id','DESC')->limit('4')->get();
        $cake2 = Product::whereRaw('FIND_IN_SET("4",cake_id)')->orderBy('id','DESC')->limit('4')->get();
        $cake3 = Product::whereRaw('FIND_IN_SET("5",cake_id)')->orderBy('id','DESC')->limit('4')->get();
        $cake4 = Product::whereRaw('FIND_IN_SET("6",cake_id)')->orderBy('id','DESC')->limit('4')->get();
       return view('welcome',compact('banners','section2','testimonial','section8','trend','new','cake','cake1','cake2','cake3','cake4'));
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
    public function medialist(Request $request)
    {
        $medias = MediaCoverage::orderBy('id','DESC')->paginate(1);
        $recmedia = MediaCoverage::orderBy('id','DESC')->limit(5)->get();
        return view('mediacoverage',compact('medias','recmedia'));
    }
    public function mediadetail(Request $request,$slug)
    {
        $media = MediaCoverage::where('media_slug',$slug)->first();
        $recente = MediaCoverage::orderBy('id','DESC')->limit(5)->get();
        return view('media_details',compact('media','recente'));
    }
    public function eventlist(Request $request)
    {
        $events = Event::orderBy('id','DESC')->paginate(1);
        $recevent = Event::orderBy('id','DESC')->limit(5)->get();
        return view('event',compact('events','recevent'));
    }
    public function eventdetail(Request $request,$slug)
    {
        $event = Event::where('event_slug',$slug)->first();
        $recente = Event::orderBy('id','DESC')->limit(5)->get();
        return view('eventdetail',compact('event','recente'));
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
        $youmay = Product::where('category_id',$id)->where('status','Active')->where('youmayalsolike','1')->limit('4')->get();
        return view('category',compact('category','testimonial','section8','youmay'));
    }

    public function childcategory(Request $request,$id)
    {
        $child = ChildCategory::where('subcategory_id',$id)->where('status','Active')->get();
        $sub = SubCategory::where('id',$id)->first();
        $cat = Category::where('id',$sub->category_id)->first();
        $testimonial = Testimonial::OrderBy('id','DESC')->get();
        $section8 = Section8::orderBy('id','ASC')->get();
        $youmay = Product::where('subcategory_id',$id)->where('status','Active')->where('youmayalsolike','1')->limit('4')->get();
        return view('subcategory',compact('child','testimonial','section8','sub','cat','youmay'));
    }

    public function subproductlist(Request $request,$id)
    {
        $request->all();
        if ($request->sortby == 'Recommended') {
            $products = Product::where('status','Active')->where('subcategory_id',$id)->paginate('8');
        } else if ($request->sortby == 'New') {
            $products = Product::where('status','Active')->where('subcategory_id',$id)->where('newarrivalgift','1')->paginate('8');
        } else if ($request->sortby == 'Price: Low to High') {
            $products = Product::where('status','Active')->where('subcategory_id',$id)->orderBy('price','ASC')->paginate('8');
        } else if($request->sortby == 'Price: High to Low'){
            $products = Product::where('status','Active')->where('subcategory_id',$id)->orderBy('price','DESC')->paginate('8');
        }else {
            $products = Product::where('status','Active')->where('subcategory_id',$id)->paginate('8');
        }
        $attribute = Attribute::all();
        $sub = SubCategory::where('id',$id)->first();
        $cat = Category::where('id',$sub->category_id)->first();
        $testimonial = Testimonial::OrderBy('id','DESC')->get();
        $trend = Product::where('subcategory_id',$id)->where('status','Active')->where('trending','1')->limit('4')->get();
        return view('subproductlist',compact('products','testimonial','sub','cat','trend','attribute'));

    }

    public function search(Request $request)
    {
        //return $request->all();
        if ($request->sortby == 'Recommended') {
            $search = $request->search;
            $category = Category::where('cat_name','LIKE', '%'.$search.'%')->first();
            if ($category !== null) {
                $products = Product::where('status', 'Active')->where('product_name', 'LIKE', '%'.$search.'%')
                            ->orwhere('skucode', 'LIKE', '%'.$search.'%')->orwhere('category_id', $category->id)->get();
            }else{
                $products = Product::where('status', 'Active')->where('product_name', 'LIKE', '%'.$search.'%')
                ->orwhere('skucode', 'LIKE', '%'.$search.'%')->get();
            }
        } else if ($request->sortby == 'New') {
            $search = $request->search;
            $category = Category::where('cat_name','LIKE', '%'.$search.'%')->first();
            if ($category !== null) {
                $products = Product::where('status', 'Active')->where('product_name', 'LIKE', '%'.$search.'%')
                            ->where('newarrivalgift','1')
                            ->orwhere('skucode', 'LIKE', '%'.$search.'%')->orwhere('category_id', $category->id)->get();
            }else{
                $products = Product::where('status', 'Active')->where('product_name', 'LIKE', '%'.$search.'%')->where('newarrivalgift','1')
                ->orwhere('skucode', 'LIKE', '%'.$search.'%')->get();
            }
        } else if ($request->sortby == 'Price: Low to High') {
            $search = $request->search;
            $category = Category::where('cat_name','LIKE', '%'.$search.'%')->first();
            if ($category !== null) {
                $products = Product::where('status', 'Active')->where('product_name', 'LIKE', '%'.$search.'%')
                            ->orderBy('price','ASC')
                            ->orwhere('skucode', 'LIKE', '%'.$search.'%')->orwhere('category_id', $category->id)->get();
            }else{
                $products = Product::where('status', 'Active')->where('product_name', 'LIKE', '%'.$search.'%')->orderBy('price','ASC')
                ->orwhere('skucode', 'LIKE', '%'.$search.'%')->get();
            }
        } else if($request->sortby == 'Price: High to Low'){
            $search = $request->search;
            $category = Category::where('cat_name','LIKE', '%'.$search.'%')->first();
            if ($category !== null) {
                $products = Product::where('status', 'Active')->where('product_name', 'LIKE', '%'.$search.'%')->orderBy('price','DESC')
                            ->orwhere('skucode', 'LIKE', '%'.$search.'%')->orwhere('category_id', $category->id)->get();
            }else{
                $products = Product::where('status', 'Active')->where('product_name', 'LIKE', '%'.$search.'%')->orderBy('price','DESC')
                ->orwhere('skucode', 'LIKE', '%'.$search.'%')->get();
            }
        }else {
            $search = $request->search;
            $category = Category::where('cat_name','LIKE', '%'.$search.'%')->first();
            if ($category !== null) {
                $products = Product::where('status', 'Active')->where('product_name', 'LIKE', '%'.$search.'%')
                            ->orwhere('skucode', 'LIKE', '%'.$search.'%')->orwhere('category_id', $category->id)->get();
            }else{
                $products = Product::where('status', 'Active')->where('product_name', 'LIKE', '%'.$search.'%')
                ->orwhere('skucode', 'LIKE', '%'.$search.'%')->get();
            }
        }
        $attribute = Attribute::all();
        $testimonial = Testimonial::OrderBy('id','DESC')->get();
        $trend = Product::where('status','Active')->where('trending','1')->limit('4')->get();
        return view('searchproductlist',compact('products','testimonial','trend','attribute'));
    }
    public function offerproductlist(Request $request)
    {
        $request->all();
        if ($request->sortby == 'Recommended') {
            $products = Product::where('status','Active')->whereNotNull('discount')->paginate('8');
        } else if ($request->sortby == 'New') {
            $products = Product::where('status','Active')->whereNotNull('discount')->where('newarrivalgift','1')->paginate('8');
        } else if ($request->sortby == 'Price: Low to High') {
            $products = Product::where('status','Active')->whereNotNull('discount')->orderBy('price','ASC')->paginate('8');
        } else if($request->sortby == 'Price: High to Low'){
            $products = Product::where('status','Active')->whereNotNull('discount')->orderBy('price','DESC')->paginate('8');
        }else {
            $products = Product::where('status','Active')->whereNotNull('discount')->paginate('8');
        }

        $attribute = Attribute::all();
        $testimonial = Testimonial::OrderBy('id','DESC')->get();
        $trend = Product::where('status','Active')->where('trending','1')->limit('4')->get();
        return view('offers',compact('products','testimonial','trend','attribute'));

    }
    public function trendproductlist(Request $request,$id)
    {
        if($id == 'trend'){
            $request->all();
            if ($request->sortby == 'Recommended') {
                $products = Product::where('status','Active')->where('trending',1)->paginate('8');
            } else if ($request->sortby == 'New') {
                $products = Product::where('status','Active')->where('trending',1)->where('newarrivalgift','1')->paginate('8');
            } else if ($request->sortby == 'Price: Low to High') {
                $products = Product::where('status','Active')->where('trending',1)->orderBy('price','ASC')->paginate('8');
            } else if($request->sortby == 'Price: High to Low'){
                $products = Product::where('status','Active')->where('trending',1)->orderBy('price','DESC')->paginate('8');
            }else {
                $products = Product::where('status','Active')->where('trending',1)->paginate('8');
            }

        }elseif($id == 'newarrival'){
            $request->all();
            if ($request->sortby == 'Recommended') {
                $products = Product::where('status','Active')->where('newarrivalgift',1)->paginate('8');
            } else if ($request->sortby == 'New') {
                $products = Product::where('status','Active')->where('newarrivalgift',1)->where('newarrivalgift','1')->paginate('8');
            } else if ($request->sortby == 'Price: Low to High') {
                $products = Product::where('status','Active')->where('newarrivalgift',1)->orderBy('price','ASC')->paginate('8');
            } else if($request->sortby == 'Price: High to Low'){
                $products = Product::where('status','Active')->where('newarrivalgift',1)->orderBy('price','DESC')->paginate('8');
            }else {
                $products = Product::where('status','Active')->where('newarrivalgift',1)->paginate('8');
            }
        }elseif($id == 'youmayalsolike'){
            $request->all();
            if ($request->sortby == 'Recommended') {
                $products = Product::where('status','Active')->where('youmayalsolike',1)->paginate('8');
            } else if ($request->sortby == 'New') {
                $products = Product::where('status','Active')->where('youmayalsolike',1)->where('newarrivalgift','1')->paginate('8');
            } else if ($request->sortby == 'Price: Low to High') {
                $products = Product::where('status','Active')->where('youmayalsolike',1)->orderBy('price','ASC')->paginate('8');
            } else if($request->sortby == 'Price: High to Low'){
                $products = Product::where('status','Active')->where('youmayalsolike',1)->orderBy('price','DESC')->paginate('8');
            }else {
                $products = Product::where('status','Active')->where('youmayalsolike',1)->paginate('8');
            }
        }
        $attribute = Attribute::all();
        $testimonial = Testimonial::OrderBy('id','DESC')->get();
        $trend = Product::where('status','Active')->where('trending','1')->limit('4')->get();
        return view('trendproductlist',compact('products','testimonial','trend','attribute'));

    }
    public function productlist(Request $request,$id)
    {
         $request->all();
        if ($request->sortby == 'Recommended') {
            $products = Product::where('status','Active')->where('childcategory_id',$id)->paginate('8');
        } else if ($request->sortby == 'New') {
            $products = Product::where('status','Active')->where('childcategory_id',$id)->where('newarrivalgift','1')->paginate('8');
        } else if ($request->sortby == 'Price: Low to High') {
            $products = Product::where('status','Active')->where('childcategory_id',$id)->orderBy('price','ASC')->paginate('8');
        } else if($request->sortby == 'Price: High to Low'){
            $products = Product::where('status','Active')->where('childcategory_id',$id)->orderBy('price','DESC')->paginate('8');
        }else {
            $products = Product::where('status','Active')->where('childcategory_id',$id)->paginate('8');
        }
        $attribute = Attribute::all();
        $child = ChildCategory::where('id',$id)->first();
        $sub = SubCategory::where('id',$child->subcategory_id)->first();
        $cat = Category::where('id',$child->category_id)->first();
        $testimonial = Testimonial::OrderBy('id','DESC')->get();
        $trend = Product::where('childcategory_id',$id)->where('status','Active')->where('trending','1')->limit('4')->get();
        return view('productlist',compact('products','testimonial','child','sub','cat','trend','attribute'));
    }

    public function productindex(Request $request,$id)
    {
        if ($request->sortby == 'Recommended') {
            $products = Product::where('status','Active')->where('childcategory_id',$id)->where('featured','1')->paginate('8');
        } else if ($request->sortby == 'New') {
            $products = Product::where('status','Active')->where('childcategory_id',$id)->where('best_seller','1')->paginate('8');
        } else if ($request->sortby == 'Price: Low to High') {
            $products = Product::where('status','Active')->where('childcategory_id',$id)->where('new_arrival','1')->paginate('8');
        } else if($request->sortby == 'Price: High to Low'){
            $products = Product::where('status','Active')->where('childcategory_id',$id)->where('brand_id',$request->brand)->paginate('8');
        }else {
            $products = Product::where('status','Active')->where('childcategory_id',$id)->paginate('8');
        }
        $attribute = Attribute::all();
        $child = ChildCategory::where('id',$id)->first();
        $sub = SubCategory::where('id',$child->subcategory_id)->first();
        $cat = Category::where('id',$child->category_id)->first();
        $testimonial = Testimonial::OrderBy('id','DESC')->get();
        $trend = Product::where('childcategory_id',$id)->where('status','Active')->where('trending','1')->limit('4')->get();
        return view('productlist',compact('products','testimonial','child','sub','cat','trend','attribute'));
    }
    public function productdetail(Request $request,$slug)
    {
        $product = Product::where('status','Active')->where('slug',$slug)->first();
        $proreq = ProductRequired::where('product_id',$product->id)->first();
        $testimonial = Testimonial::OrderBy('id','DESC')->get();
        $review = Review::where('status','Active')->where('product_id',$product->id)->get();
        $trend = Product::where('category_id',$product->category_id)->where('status','Active')->orderBy('id','DESC')->where('trending','1')->limit('4')->get();
        $youmay = Product::where('category_id',$product->category_id)->where('status','Active')->orderBy('id','DESC')->where('youmayalsolike','1')->limit('4')->get();
        return view('productdetails',compact('proreq','product','testimonial','review','youmay','trend'));
    }

    public function wishlist(Request $request)
    {
        $wish = Wishlist::where('user_id',Auth::user()->id)->get();
        return view('user.wishlist',compact('wish'));
    }
    public function charmloadd(Request $request)
    {
        $selectop = ProductSelectOption::where('id',$request->charmvalue)->where('product_id', $request->product)->first();
        if ($request->charmvalue) {
            $att = StoreCartCharm::where('product_select_id',$selectop->product_select_id)->where('user_id', Auth::user()->id)->where('product_id', $request->product)->first();
            if ($att) {
                $store = StoreCartCharm::where('product_select_id',$selectop->product_select_id)->where('user_id', Auth::user()->id)->where('product_id', $request->product)
                ->update(['session_id' => Session::getId(),'user_id'=>Auth::user()->id ,'charm_id' => $request->charmvalue ,'charm_price' => $selectop->product_select_option_price,'combo_id'=>$request->combo_idd]);
            } else {
                $store = new StoreCartCharm();
                $store->session_id = Session::getId();
                $store->user_id = Auth::user()->id;
                $store->product_id = $request->product;
                $store->product_select_id = $selectop->product_select_id;
                $store->charm_id = $request->charmvalue;
                $store->charm_price = $selectop->product_select_option_price;
                $store->combo_id = $request->combo_idd;
                $store->save();
            }
        }
        return response()->json($store);
    }
    public function loadd(Request $request)
    {
        if ($request->buttonid) {
            $data = AttributeValue::where('id', $request->att)->first();
            $att = StoreCartAttribute::where('attribute', $data->attr_id)->where('buttonid',$request->buttonid)->where('session_id', Session::getId())->where('product_id', $request->product)->first();
            if ($att) {
                $store = StoreCartAttribute::where('attribute', $data->attr_id)->where('buttonid',$request->buttonid)->where('session_id', Session::getId())->where('product_id', $request->product)
                ->update(['session_id' => Session::getId(), 'attribute' => $data->attr_id ,'att_id' => $request->att,'buttonid'=>$request->buttonid, 'variationaddtext1'=>$request->variationaddtext1]);
            } else {
                $store = new StoreCartAttribute();
                $store->session_id = Session::getId();
                $store->product_id = $request->product;
                $store->buttonid = $request->buttonid;
                $store->attribute = $data->attr_id;
                $store->att_id = $request->att;
                $store->variationaddtext1 = $request->variationaddtext1;
                $store->save();
            }
        }else{
            $data = AttributeValue::where('id', $request->att)->first();
            $att = StoreCartAttribute::where('attribute', $data->attr_id)->where('session_id', Session::getId())->where('product_id', $request->product)->first();
            if ($att) {
                $store = StoreCartAttribute::where('attribute', $data->attr_id)->where('session_id', Session::getId())->where('product_id', $request->product)
                ->update(['session_id' => Session::getId(), 'attribute' => $data->attr_id ,'att_id' => $request->att]);
            } else {
                $store = new StoreCartAttribute();
                $store->session_id = Session::getId();
                $store->product_id = $request->product;
                $store->attribute = $data->attr_id;
                $store->att_id = $request->att;
                $store->save();
            }
        }
        return response()->json($store);
    }
    public function comboloadd(Request $request)
    {
        $data = AttributeValue::where('id', $request->att)->first();
        $att = StoreCartCombo::where('attribute', $data->attr_id)->where('user_id', Auth::user()->id)->where('combo_id', $request->comboname)->where('product_id', $request->product)->first();
        if ($att) {
            $store = StoreCartCombo::where('attribute', $data->attr_id)->where('user_id', Auth::user()->id)->where('combo_id', $request->comboname)->where('product_id', $request->product)
            ->update(['session_id' => Session::getId(), 'attribute' => $data->attr_id ,'att_id' => $request->att,'comboaddtext1' => $request->comboaddtext1]);
        } else {
            $store = new StoreCartCombo();
            $store->session_id = Session::getId();
            $store->user_id = Auth::user()->id;
            $store->product_id = $request->product;
            $store->combo_id = $request->comboname;
            $store->attribute = $data->attr_id;
            $store->att_id = $request->att;
            $store->product_select_id = $request->product_select_id;
            $store->charm_id = $request->charm_id;
            $store->charm_price = $request->charm_price;
            $store->comboaddtext1 = $request->comboaddtext1;
            $store->save();
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


    public function checkout(Request $request)
    {
        $carts = Cart::where('user_id',Auth::user()->id)->get();
        $use = User::where('id',Auth::user()->id)->first();
        $user = UserProfile::where('user_id',Auth::user()->id)->first();

        $isCouponCheck = Cart::where('user_id',Auth::user()->id)->wherenotNull('coupon_id')->first();

        if ($isCouponCheck) {
            $isCoupon = 1;
            $coupon = Coupon::find($isCouponCheck->coupon_id);
        }
        else{
            $isCoupon = 0;
            $coupon = '';
        }
        return view('checkout',compact('carts','isCoupon','user'));
    }
    public function checkoutbuy(Request $request,$id)
    {
        $carts = Cart::where('user_id',Auth::user()->id)->where('id',$id)->get();
        $use = User::where('id',Auth::user()->id)->first();
        $user = UserProfile::where('user_id',Auth::user()->id)->first();
        $CartID = $id;
        $isCouponCheck = Cart::where('user_id',Auth::user()->id)->where('id',$id)->wherenotNull('coupon_id')->first();

        if ($isCouponCheck) {
            $isCoupon = 1;
            $coupon = Coupon::find($isCouponCheck->coupon_id);
        }
        else{
            $isCoupon = 0;
            $coupon = '';
        }
        return view('checkoutforbuy',compact('carts','isCoupon','user','CartID'));
    }

    public function orderconfirmed(Request $request,$id)
    {
        $order = Order::where('id',$id)->first();

        return view('orderconfirmed',compact('order'));
    }

    public function notifyinstock(Request $request)
    {
        if (Auth::check()) {
            $user = User::where('id',Auth::user()->id)->where('role_id','3')->first();
            if($user){
                $ntify = new Notifyme();
                $ntify->user_id = Auth::user()->id;
                $ntify->session_id = Session::getId();
                $ntify->product_id = $request->product_id;
                $ntify->save();
                return response()->json(['status'=>'success','msg' => 'Submitted Successfully']);

            }else{
                return response()->json(['status'=>'failure','msg' => 'Please Login']);
            }
        }else{
                return redirect('login');
        }

    }

    public function productreview(Request $request)
    {
        $data = new Review();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->comment = $request->review;
        $data->rating = $request->rating;
        $data->product_id = $request->productid;
        $data->user_id = Auth::user()->id;
        $data->session_id = Session::getId();
        $data->save();

        if($data){
            $dataa = array(
            'name' =>$request->name,
            'review' =>$request->review,
            'email' => $request->email,
            'rating' => $request->rating,
            'product_id' => $request->productid,
            'user_id' => $data->user_id,
            'session_id' => $data->session_id,
            'user'=>'user',
            );

            Mail::send(['html'=>'mail.reviewmail'], $dataa, function($message) use ($dataa) {
                $message->to($dataa['email'])->subject
                    ('Review Form');
                $message->from('sneha@telcopl.com','Pow Store');
            });
            $dataaa = array(
                'user'=>'admin',
                'name' =>$request->name,
                'review' =>$request->review,
                'email' => $request->email,
                'rating' => $request->rating,
                'product_id' => $request->productid,
                'user_id' => $data->user_id,
                'session_id' => $data->session_id,
                );

            Mail::send(['html'=>'mail.reviewmail'], $dataaa, function($message) {
                $message->to('sneha@telcopl.com')->subject
                    ('Review Form');
                $message->from('sneha@telcopl.com','Pow Store');
            });
            return back()->with('flash_success','Thank You Our Team will get back shortly!');
        }else{
            return back()->with('flash_success','Something went wrong please try again later');
        }
    }

}
