<?php

namespace App\Http\Controllers\Backend\Manager;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\ProductComboVariation;
use App\Models\ProductFlower;
use App\Models\ProductImage;
use App\Models\ProductPrice;
use App\Models\ProductVariation;
use App\Models\ProductVariationButton;
use App\Models\SubCategory;
use App\Models\SubChildCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::with('category','subcategory','childcategory','subchildcategory')->get();
        return view('manager.products.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //return $request->all();
        $firstcategory = Category::where('status','Active')->first();
        $maincategory = Category::where('status','Active')->get();
        if (isset($request->category_id) && $request->category_id !='') {
             $subcategory = SubCategory::where('category_id',$request->category_id)->where('status','Active')->get();
            if (isset($request->subcategory_id) && $request->subcategory_id !='') {
              $childcategory = ChildCategory::where('subcategory_id',$request->subcategory_id)->where('status','Active')->get();
                if (isset($request->childcategory_id) && $request->childcategory_id !='') {
                    $subchildcategory = SubChildCategory::where('childcategory_id',$request->childcategory_id)->where('subchildstatus','Active')->get();
                }else{
                    $subchildcategory = SubChildCategory::where('subcategory_id',$request->subcategory_id)->where('subchildstatus','Active')->get();
                }

            }else{
              $childcategory = ChildCategory::where('category_id',$request->category_id)->where('status','Active')->get();
              $subchildcategory = SubChildCategory::where('category_id',$request->category_id)->where('subchildstatus','Active')->get();

            }
        }
        else{
            $subcategory = Subcategory::where('category_id',@$firstcategory->id)->where('status','Active')->get();
           $childcategory = ChildCategory::where('category_id',$request->category_id)->where('status','Active')->get();
           $subchildcategory = SubChildCategory::where('category_id',$request->category_id)->where('subchildstatus','Active')->get();
        }
       // $firstcategory = Category::where('status','Active')->first();
       // $subcategory_id = Subcategory::where('status','Active')->get();
      //  $category = Category::where('status','Active')->get();
      //  if (isset($request->category_id) && $request->category_id !='') {
      //      $subcategory = Subcategory::where('category_id',$request->category_id)->where('status','Active')->get();
      //  }
      //  else{
      //      $subcategory = Subcategory::where('category_id',@$firstcategory->id)->where('status','Active')->get();
      //  }
            $childcategory;
        return view('manager.products.create',compact('childcategory','subcategory','firstcategory','maincategory','subchildcategory'));
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
            'category_id' => 'required',
           'subcategory_id'=>'required',
           //'childcategory_id'=>'required',
          // 'subchildcategory_id'=>'required',
            'product_name'=>'required',
            'price'=>'required',
        ]);
        $slug = Helper::getBlogUrl($request->product_name);
        if (Product::where('slug', '=', $slug)->count() > 0)
        {
            return back()->with('flash_error', 'Product Already Exits');
        }
        else
        {
            $product = new Product();
            $product->category_id = $request->category_id;
            $product->subcategory_id = $request->subcategory_id;
            $product->childcategory_id = $request->childcategory_id;
            $product->subchildcategory_id = $request->subchildcategory_id;
            $product->product_name = $request->product_name;
            $product->slug = $slug;
            $product->pro_short_desc = $request->pro_short_desc;
            $product->pro_long_desc = $request->pro_long_desc;
            $product->specification = $request->specification;
            $product->delivery_info = $request->delivery_info;
            $product->color_desclaimer = $request->color_desclaimer;
            $product->return_policy = $request->return_policy;
            $product->review = $request->review;
            $product->price = $request->price;
            $product->status = $request->status;
            $product->stock_status = $request->stock_status;
            $product->quantity = $request->quantity;
            $product->meta_title = $request->meta_title;
            $product->meta_description = $request->meta_description;
            $product->meta_keywords = $request->meta_keywords;
            $product->comment_heading = $request->comment_heading;
            $product->textarea_name = $request->textarea_name;
            $product->textarea_validation = $request->textarea_validation;
            $product->imageuploadoption_heading = $request->imageuploadoption_heading;
            $product->imageuploadoption_validation = $request->imageuploadoption_validation;
            $product->text_heading = $request->text_heading;
            $product->text_validation = $request->text_validation;
            $product->giftwrapper_price = $request->giftwrapper_price;
            $product->addatext_heading = $request->addatext_heading;
            $product->addatext_validation = $request->addatext_validation;
            $product->uploadlogo_heading = $request->uploadlogo_heading;
            $product->uploadlogo_validation = $request->uploadlogo_validation;
            if($request->frontandbackprint_option ==''){
                $product->frontandbackprint_option = '0';
            }else if($request->frontandbackprint_option == 'on'){
                $product->frontandbackprint_option = '1';
            }
            if($request->single_option == ''){
                $product->single_option = '0';
            }else if($request->single_option	== 'on'){
                $product->single_option = '1';
            }

            if($request->is_variation ==''){
                $product->is_variation = '0';
            }else if($request->is_variation == 'on'){
                $product->is_variation = '1';
            }
            if($request->trending == ''){
                $product->trending = '0';
            }else if($request->trending	== 'on'){
                $product->trending = '1';
            }
            if($request->youmayalsolike == ''){
                $product->youmayalsolike = '0';
            }else if($request->youmayalsolike	== 'on'){
                $product->youmayalsolike = '1';
            }
            if($request->newarrivalgift == ''){
                $product->newarrivalgift = '0';
            }else if($request->newarrivalgift	== 'on'){
                $product->newarrivalgift = '1';
            }
            if($request->is_combo == ''){
                $product->is_combo = '0';
            }else if($request->is_combo	== 'on'){
                $product->is_combo = '1';
            }
            if($request->location ==''){
                $product->location = '0';
            }else if($request->location == 'on'){
                $product->location = '1';
            }
            if($request->datee ==''){
                $product->datee	 = '0';
            }else if($request->datee == 'on'){
                $product->datee	= '1';
            }
            if($request->timee ==''){
                $product->timee = '0';
            }else if($request->timee == 'on'){
                $product->timee = '1';
            }
            if($request->comment ==''){
                $product->comment = '0';
            }else if($request->comment == 'on'){
                $product->comment = '1';
            }
            if($request->queryy ==''){
                $product->query = '0';
            }else if($request->queryy == 'on'){
                $product->query = '1';
            }
            if($request->self_pickup ==''){
                $product->self_pickup = '0';
            }else if($request->self_pickup == 'on'){
                $product->self_pickup = '1';
            }
            if($request->eggoreggless ==''){
                $product->eggoreggless = '0';
            }else if($request->eggoreggless == 'on'){
                $product->eggoreggless = '1';
            }
            if($request->quantity_show ==''){
                $product->quantity_show = '0';
            }else if($request->quantity_show == 'on'){
                $product->quantity_show = '1';
            }
            if($request->textareaa ==''){
                $product->textareaa = '0';
            }else if($request->textareaa == 'on'){
                $product->textareaa	= '1';
            }
            if($request->imageuploadoption ==''){
                $product->imageuploadoption	= '0';
            }else if($request->imageuploadoption == 'on'){
                $product->imageuploadoption	= '1';
            }
            if($request->text_field	==''){
                $product->text_field = '0';
            }else if($request->text_field == 'on'){
                $product->text_field = '1';
            }
            if($request->giftwrapper_option	==''){
                $product->giftwrapper_option = '0';
            }else if($request->giftwrapper_option == 'on'){
                $product->giftwrapper_option = '1';
            }
            if($request->anyspecificdesign_option ==''){
                $product->anyspecificdesign_option = '0';
            }else if($request->anyspecificdesign_option	== 'on'){
                $product->anyspecificdesign_option = '1';
            }
            if($request->haveadesigninmind_option ==''){
                $product->haveadesigninmind_option = '0';
            }else if($request->haveadesigninmind_option	== 'on'){
                $product->haveadesigninmind_option = '1';
            }
            if($request->uploadlogo_option ==''){
                $product->uploadlogo_option	= '0';
            }else if($request->uploadlogo_option == 'on'){
                $product->uploadlogo_option	= '1';
            }
            if($request->addatext_option ==''){
                $product->addatext_option = '0';
            }else if($request->addatext_option == 'on'){
                $product->addatext_option = '1';
            }
            if($request->flower_type_option == ''){
                $product->flower_type_option = '0';
            }else if($request->flower_type_option	== 'on'){
                $product->flower_type_option = '1';
            }
            if($request->button_type_option == ''){
                $product->button_type_option = '0';
            }else if($request->button_type_option	== 'on'){
                $product->button_type_option = '1';
            }
            if($request->cake_id){
                $product->cake_id = implode(',',$request->cake_id);
            //    $product->related_products = json_encode($request->related_products);
            }else{
                $product->cake_id  =  $request->input('cake_id');
            }
            if($request->related_products){
                $product->related_products = implode(',',$request->related_products);
            //    $product->related_products = json_encode($request->related_products);
            }else{
                $product->related_products  =  $request->input('related_products');
            }
            if($request->pro_attributes){
                $product->pro_attributes = implode(',',$request->pro_attributes);
            }else{
                $product->pro_attributes  =  $request->input('pro_attributes');
            }
            if($request->pro_combo_attributes){
                $product->pro_combo_attributes = implode(',',$request->pro_combo_attributes);
            }else{
                $product->pro_combo_attributes  =  $request->input('pro_combo_attributes');
            }
            $product->save();

            if($request->hasfile('images'))
            {
                foreach(($request->file('images')) as $image)
                {
                    $name=time().uniqid(). '.' . $image->getClientOriginalName();
                    $image->move(public_path().'/uploads/images/', $name);
                    $data[] = $name;

                    $product_images= new ProductImage();
                    $product_images->product_id = $product->id;
                    $product_images->images = $name;
                    $product_images->save();
                }
            }

            if($product->is_variation != 1){
                $product_price= new ProductPrice();
                $product_price->product_id = $product->id;
                $product_price->price = $request->price;
                $product_price->strick_price = $request->strick_price;
                $product_price->discount = $request->discount;
                $product_price->save();
            }

            if ($request->product_flower_name != "") {
                $data1 = $request->all();
                $fnamee = $data1['product_flower_name'];
                if (count($fnamee)) {
                    foreach ($fnamee as $key => $input) {
                        if ($fnamee[$key]!=null ) {
                            $product_fprice= new ProductFlower();
                            $product_fprice->product_id = $product->id;
                            $product_fprice->product_flower_name = $fnamee[$key];
                            $product_fprice->save();
                        }
                    }
                }
            }


            if ($request->button_name != "") {
                $data1 = $request->all();
                $fnamee = $data1['button_name'];
                if (count($fnamee)) {
                    foreach ($fnamee as $key => $input) {
                        if ($fnamee[$key]!=null ) {
                            $product_fbprice= new ProductVariationButton();
                            $product_fbprice->product_id = $product->id;
                            $product_fbprice->button_name = $fnamee[$key];
                            $product_fbprice->save();
                        }
                    }
                }
            }

            $data = $request->all();
            if ($product->is_variation == 1) {
                if ($data['pro_attributes'] != '') {
                    $mrp_price = $data['pro_attributes'];
                    if (count($mrp_price)) {
                        foreach ($mrp_price as $key => $input) {
                            if ($mrp_price[$key]!=null) {
                                $product_price = new ProductVariation();
                                $product_price->product_attr_id= $mrp_price[$key];
                                $product_price->product_id = $product->id;
                                $product_price->save();
                            }
                        }
                    }
                }
            }

            $datac = $request->all();
            if ($product->is_combo == 1) {
                if ($datac['pro_combo_attributes'] != '') {
                    $mrp_pricec = $datac['pro_combo_attributes'];
                    if (count($mrp_pricec)) {
                        foreach ($mrp_pricec as $keyc => $inputc) {
                            if ($mrp_pricec[$keyc]!=null) {
                                $product_pricec = new ProductComboVariation();
                                $product_pricec->product_combo_attr_id= $mrp_pricec[$keyc];
                                $product_pricec->product_id = $product->id;
                                $product_pricec->save();
                            }
                        }
                    }
                }
            }
           return back()->with('flash_success', ' Created successfully');
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
    public function edit($id,Request $request)
    {
        $data = Product::findOrFail($id);
        $images = ProductImage::where('product_id',$id)->get();
        $item_rel_ids = explode(',',$data->related_products);
        $item_rel_ids =[ ];
        if($data->related_products != null){
            foreach (explode(',',$data->related_products) as $rel) {
                $item_rel_ids[$rel] = $rel;
            }
        }
        $item_attr_ids = explode(',',$data->pro_attributes);
        $item_attr_ids =[ ];
        if($data->pro_attributes != null){
            foreach (explode(',',$data->pro_attributes) as $atrr) {
                $item_attr_ids[$atrr] = $atrr;
            }
        }
        $item_attr_idsc =[ ];
        if($data->pro_combo_attributes != null){
            foreach (explode(',',$data->pro_combo_attributes) as $atrrc) {
                $item_attr_idsc[$atrrc] = $atrrc;
            }
        }
        $cake_desc = explode(',',$data->cake_id);
        $cake_desc =[ ];
        if($data->cake_id != null){
            foreach (explode(',',$data->cake_id) as $cak) {
                $cake_desc[$cak] = $cak;
            }
        }

        $treat = ProductFlower::where('product_id',$id)->get();
        $butt = ProductVariationButton::where('product_id',$id)->get();
        $firstcategory = Category::where('status','Active')->first();
        $maincategory = Category::where('status','Active')->get();
        if (isset($request->category_id) && $request->category_id !='') {
        $subcategory = SubCategory::where('status','Active')->where('category_id',$request->category_id)->get();
        $childcategory = ChildCategory::where('subcategory_id',$request->subcategory_id)->where('status','Active')->get();

        if (isset($request->subcategory_id) && $request->subcategory_id !='') {
             $childcategory = ChildCategory::where('subcategory_id',$request->subcategory_id)->where('status','Active')->get();
                if (isset($request->childcategory_id) && $request->childcategory_id !='') {
                    $subchildcategory = SubChildCategory::where('childcategory_id',$request->childcategory_id)->where('subchildstatus','Active')->get();
                }else{
                    $subchildcategory = SubChildCategory::where('childcategory_id',$request->childcategory_id)->where('subchildstatus','Active')->get();
                }
            }else{
                // $childcategory = ChildCategory::where('category_id',$request->category_id)->where('status','Active')->get();
                $childcategory = ChildCategory::where('subcategory_id',$data->subcategory_id)->where('status','Active')->get();
                $subchildcategory = SubChildCategory::where('subcategory_id',$data->subcategory_id)->where('subchildstatus','Active')->get();
            }
        }else{
            $subcategory = Subcategory::where('status','Active')->where('category_id',$data->category_id)->get();
           //  $childcategory = ChildCategory::where('category_id',$request->category_id)->where('status','Active')->get();
           $childcategory = ChildCategory::where('subcategory_id',$data->subcategory_id)->where('status','Active')->get();
           $subchildcategory = SubChildCategory::where('subcategory_id',$data->subcategory_id)->where('subchildstatus','Active')->get();

        }
       // $firstcategory = Category::where('status','Active')->first();
      //  $category = Category::where('status','Active')->get();
      //  if (isset($request->category_id) && $request->category_id !='') {
      //      $subcategory = Subcategory::where('status','Active')->where('category_id',$request->category_id)->get();
      //  }
      //  else{
      //      $subcategory = Subcategory::where('status','Active')->where('category_id',$data->category_id)->get();
      //  }
        return View('manager.products.edit',compact('cake_desc','butt','childcategory','treat','maincategory','item_attr_ids','firstcategory','data','subcategory','item_rel_ids','images','subchildcategory','item_attr_idsc'));
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
            'category_id' => 'required',
           'subcategory_id'=>'required',
          // 'childcategory_id'=>'required',
           //'subchildcategory_id'=>'required',
            'product_name'=>'required',
            'price'=>'required',
        ]);
        $slug = Helper::getBlogUrl($request->product_name);
        $product = Product::find($id);
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->childcategory_id = $request->childcategory_id;
        $product->subchildcategory_id = $request->subchildcategory_id;
        $product->product_name = $request->product_name;
        $product->slug = $slug;
        $product->pro_short_desc = $request->pro_short_desc;
        $product->pro_long_desc = $request->pro_long_desc;
        $product->specification = $request->specification;
        $product->delivery_info = $request->delivery_info;
        $product->color_desclaimer = $request->color_desclaimer;
        $product->return_policy = $request->return_policy;
        $product->review = $request->review;
        $product->price = $request->price;
        $product->status = $request->status;
        $product->stock_status = $request->stock_status;
        $product->quantity = $request->quantity;
        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;
        $product->meta_keywords = $request->meta_keywords;
        $product->comment_heading = $request->comment_heading;
        $product->textarea_name = $request->textarea_name;
        $product->textarea_validation = $request->textarea_validation;
        $product->imageuploadoption_heading = $request->imageuploadoption_heading;
        $product->imageuploadoption_validation = $request->imageuploadoption_validation;
        $product->text_heading = $request->text_heading;
        $product->text_validation = $request->text_validation;
        $product->giftwrapper_price = $request->giftwrapper_price;
        $product->addatext_heading = $request->addatext_heading;
        $product->addatext_validation = $request->addatext_validation;
        $product->uploadlogo_heading = $request->uploadlogo_heading;
        $product->uploadlogo_validation = $request->uploadlogo_validation;
        if($request->frontandbackprint_option ==''){
            $product->frontandbackprint_option = '0';
        }else if($request->frontandbackprint_option == 'on'){
            $product->frontandbackprint_option = '1';
        }
        if($request->single_option == ''){
            $product->single_option = '0';
        }else if($request->single_option	== 'on'){
            $product->single_option = '1';
        }


        if($request->is_variation ==''){
            $product->is_variation = '0';
        }else if($request->is_variation == 'on'){
            $product->is_variation = '1';
        }
        if($request->is_combo ==''){
            $product->is_combo = '0';
        }else if($request->is_combo == 'on'){
            $product->is_combo = '1';
        }
        if($request->trending == ''){
            $product->trending = '0';
        }else if($request->trending	== 'on'){
            $product->trending = '1';
        }
        if($request->youmayalsolike == ''){
            $product->youmayalsolike = '0';
        }else if($request->youmayalsolike	== 'on'){
            $product->youmayalsolike = '1';
        }
        if($request->newarrivalgift == ''){
            $product->newarrivalgift = '0';
        }else if($request->newarrivalgift	== 'on'){
            $product->newarrivalgift = '1';
        }
        if($request->location ==''){
            $product->location = '0';
        }else if($request->location == 'on'){
            $product->location = '1';
        }
        if($request->datee ==''){
            $product->datee	 = '0';
        }else if($request->datee == 'on'){
            $product->datee	= '1';
        }
        if($request->timee ==''){
            $product->timee = '0';
        }else if($request->timee == 'on'){
            $product->timee = '1';
        }
        if($request->comment ==''){
            $product->comment = '0';
        }else if($request->comment == 'on'){
            $product->comment = '1';
        }
        if($request->queryy ==''){
            $product->query = '0';
        }elseif($request->queryy == 'on'){
            $product->query = '1';
        }
        if($request->self_pickup ==''){
            $product->self_pickup = '0';
        }else if($request->self_pickup == 'on'){
            $product->self_pickup = '1';
        }
        if($request->eggoreggless ==''){
            $product->eggoreggless = '0';
        }else if($request->eggoreggless == 'on'){
            $product->eggoreggless = '1';
        }
        if($request->quantity_show ==''){
            $product->quantity_show = '0';
        }else if($request->quantity_show == 'on'){
            $product->quantity_show = '1';
        }
        if($request->textareaa ==''){
            $product->textareaa = '0';
        }else if($request->textareaa == 'on'){
            $product->textareaa	= '1';
        }
        if($request->imageuploadoption ==''){
            $product->imageuploadoption	= '0';
        }else if($request->imageuploadoption == 'on'){
            $product->imageuploadoption	= '1';
        }
        if($request->text_field	==''){
            $product->text_field = '0';
        }else if($request->text_field == 'on'){
            $product->text_field = '1';
        }
        if($request->giftwrapper_option	==''){
            $product->giftwrapper_option = '0';
        }else if($request->giftwrapper_option == 'on'){
            $product->giftwrapper_option = '1';
        }
        if($request->anyspecificdesign_option ==''){
            $product->anyspecificdesign_option = '0';
        }else if($request->anyspecificdesign_option	== 'on'){
            $product->anyspecificdesign_option = '1';
        }
        if($request->haveadesigninmind_option ==''){
            $product->haveadesigninmind_option = '0';
        }else if($request->haveadesigninmind_option	== 'on'){
            $product->haveadesigninmind_option = '1';
        }
        if($request->uploadlogo_option ==''){
            $product->uploadlogo_option	= '0';
        }else if($request->uploadlogo_option == 'on'){
            $product->uploadlogo_option	= '1';
        }
        if($request->addatext_option ==''){
            $product->addatext_option = '0';
        }else if($request->addatext_option == 'on'){
            $product->addatext_option = '1';
        }
        if($request->flower_type_option == ''){
            $product->flower_type_option = '0';
        }else if($request->flower_type_option	== 'on'){
            $product->flower_type_option = '1';
        }
        if($request->button_type_option == ''){
            $product->button_type_option = '0';
        }else if($request->button_type_option	== 'on'){
            $product->button_type_option = '1';
        }

        if($request->related_products){
            $product->related_products = implode(',',$request->related_products);
        //    $product->related_products = json_encode($request->related_products);
        }else{
            $product->related_products  =  $request->input('related_products');
        }
        if($request->cake_id){
            $product->cake_id = implode(',',$request->cake_id);
        }else{
            $product->cake_id  =  $request->input('cake_id');
        }
        if($request->pro_attributes){
            $product->pro_attributes = implode(',',$request->pro_attributes);
        }else{
            $product->pro_attributes  =  $request->input('pro_attributes');
        }
        if($request->pro_combo_attributes){
            $product->pro_combo_attributes = implode(',',$request->pro_combo_attributes);
        }else{
            $product->pro_combo_attributes  =  $request->input('pro_combo_attributes');
        }
        $product->save();

        if($product->is_variation != 1){
        $product_price= ProductPrice::updateOrCreate(['product_id'=> $id],[
                'product_id' => $product->id,
                'price' => $request->price,
                'strick_price' => $request->strick_price,
                'discount' => $request->discount,
            ]);
        }

        $data = $request->all();
        $proattr = ProductVariation::where('product_id',$product->id)->delete();
        if ($product->is_variation == '1') {
            if ($data['pro_attributes'] != '') {
                $mrp_price = $data['pro_attributes'];
                if (count($mrp_price)) {
                    foreach ($mrp_price as $key => $input) {
                        if ($mrp_price[$key]!=null) {
                            $product_price = new ProductVariation();
                            $product_price->product_attr_id= $mrp_price[$key];
                            $product_price->product_id = $product->id;
                            $product_price->save();
                        }
                    }
                }
            }
        }


        $datac = $request->all();
        $proattrc = ProductComboVariation::where('product_id',$product->id)->delete();
        if ($product->is_combo == '1') {
            if ($datac['pro_combo_attributes'] != '') {
                $mrp_pricec = $datac['pro_combo_attributes'];
                if (count($mrp_pricec)) {
                    foreach ($mrp_pricec as $keyc => $inputc) {
                        if ($mrp_pricec[$keyc]!=null) {
                            $product_pricec = new ProductComboVariation();
                            $product_pricec->product_combo_attr_id= $mrp_pricec[$keyc];
                            $product_pricec->product_id = $product->id;
                            $product_pricec->save();
                        }
                    }
                }
            }
        }

        return back()->with('flash_success', 'Updated successfully');

    }

    public function addMoreImages(Request $request)
    {
        if($request->hasfile('images'))
        {
            foreach($request->file('images') as $image)
            {
                $name=time().uniqid(). '.' . $image->getClientOriginalName();
                $image->move(public_path().'/uploads/images/', $name);
                $data[] = $name;

                $product_images= new ProductImage();
                $product_images->product_id = $request->product_id;
                $product_images->images = $name;
                $product_images->save();
            }
        }
        return back()->with('flash_success', 'Images Uploaded successfully');
    }

    public function addflower(Request $request)
    {
        if ($request->product_flower_name != "") {
            $data1 = $request->all();
            $quantity = $data1['product_flower_name'];
            if (count($quantity)) {
                foreach ($quantity as $key => $input) {
                    if ($quantity[$key]!=null) {
                        $product_images= new ProductFlower();
                        $product_images->product_id = $request->product_id;
                        $product_images->product_flower_name = $quantity[$key];
                        $product_images->save();
                    }
                }
            }
        }
        return back()->with('flash_success', 'Services Added Successfully!');
    }


    public function addmorebuttons(Request $request)
    {

        if ($request->button_name != "") {
            $data1 = $request->all();
            $quantity = $data1['button_name'];
            if (count($quantity)) {
                foreach ($quantity as $key => $input) {
                    if ($quantity[$key]!=null) {
                        $product_images= new ProductVariationButton();
                        $product_images->product_id = $request->product_id;
                        $product_images->button_name = $quantity[$key];
                        $product_images->save();
                    }
                }
            }
        }
        return back()->with('flash_success', 'Services Added Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Product::find($id);
        @unlink(public_path('uploads/images/'.$data->images));
        $datt = ProductImage::where('product_id',$data->id)->delete();
        $data->delete();
        return back()->with('flash_success', ' Deleted  Successfully!');
    }

    public function deleteMultipleImages(Request $request)
    {
       $id = $_REQUEST['id'];
        $dataa = ProductImage::find($id);
        $delete = @unlink(public_path('uploads/images/'.$dataa->images));
        $dataa->delete();
        return back()->with('flash_success', 'Image Deleted Successfully!');
    }

    public function flowerdelete(Request $request)
    {
        $id = $_REQUEST['id'];
        $data = ProductFlower::find($id);
        $data->delete();
        return back()->with('flash_success', ' Deleted Successfully!');
    }

    public function buttondelete(Request $request)
    {
        $id = $_REQUEST['id'];
        $data = ProductVariationButton::find($id);
        $data->delete();
        return back()->with('flash_success', ' Deleted Successfully!');
    }


}
