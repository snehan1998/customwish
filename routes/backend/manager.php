<?php

use App\Http\Controllers\Backend\Manager\AboutusController;
use App\Http\Controllers\Backend\Manager\AddProductVariantController;
use App\Http\Controllers\Backend\Manager\AttributeController;
use App\Http\Controllers\Backend\Manager\AttributeValueController;
use App\Http\Controllers\Backend\Manager\BannerController;
use App\Http\Controllers\Backend\Manager\BlogCategoryController;
use App\Http\Controllers\Backend\Manager\BlogController;
use App\Http\Controllers\Backend\Manager\CategoryController;
use App\Http\Controllers\Backend\Manager\ChildCategoryController;
use App\Http\Controllers\Backend\Manager\ComboController;
use App\Http\Controllers\Backend\Manager\ContactController;
use App\Http\Controllers\Backend\Manager\CorporateController;
use App\Http\Controllers\Backend\Manager\CouponController;
use App\Http\Controllers\Backend\Manager\DashboardController;
use App\Http\Controllers\Backend\Manager\EventController;
use App\Http\Controllers\Backend\Manager\FaqController;
use App\Http\Controllers\Backend\Manager\LandingCakeController;
use App\Http\Controllers\Backend\Manager\MediaCoverageController;
use App\Http\Controllers\Backend\Manager\OrderController;
use App\Http\Controllers\Backend\Manager\OurRedcordController;
use App\Http\Controllers\Backend\Manager\OurTeamController;
use App\Http\Controllers\Backend\Manager\PageController;
use App\Http\Controllers\Backend\Manager\ProductController;
use App\Http\Controllers\Backend\Manager\ProductSelectOptionController;
use App\Http\Controllers\Backend\Manager\ReviewController;
use App\Http\Controllers\Backend\Manager\Section2Controller;
use App\Http\Controllers\Backend\Manager\Section8Controller;
use App\Http\Controllers\Backend\Manager\SubCategoryController;
use App\Http\Controllers\Backend\Manager\SubChildCategoryController;
use App\Http\Controllers\Backend\Manager\TestimonialController;
use App\Http\Controllers\Backend\Manager\VariationController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard',[DashboardController::class, 'index']);
Route::resource('category',CategoryController::class);
Route::resource('subcategory',SubCategoryController::class);
Route::resource('childcategory',ChildCategoryController::class);
Route::resource('subchildcategory',SubChildCategoryController::class);
Route::resource('banners',BannerController::class);
Route::resource('testimonial',TestimonialController::class);
Route::resource('section2',Section2Controller::class);
Route::resource('section8',Section8Controller::class);
Route::resource('coupons',CouponController::class);
Route::resource('pages',PageController::class);
Route::resource('faq',FaqController::class);
Route::resource('contact',ContactController::class);
Route::resource('about',AboutusController::class);
Route::resource('ourrecord',OurRedcordController::class);
Route::resource('ourteam',OurTeamController::class);
Route::resource('blogcategory',BlogCategoryController::class);
Route::resource('blog',BlogController::class);
Route::resource('landingcake',LandingCakeController::class);
Route::resource('review',ReviewController::class);
Route::resource('media',MediaCoverageController::class);
Route::resource('event',EventController::class);
Route::resource('corporate',CorporateController::class);

Route::resource('giftcard',GiftVoucherController::class);

Route::get('giftvoucherpurchased',[OrderController::class,'giftpurchased']);
Route::post('deletegiftpurchased/{id}',[OrderController::class,'deletegiftpurchased']);


Route::post('corporate/addcorporateImages',[CorporateController::class,'addcorporateImages']);
Route::post('corporate/corporatedeleteimage',[CorporateController::class,'corporatedeleteimage']);

Route::get('order/{order_id}',[OrderController::class,'orderDetail']);
Route::get('orders',[OrderController::class,'orders']);
Route::post('changeOrderStatus',[OrderController::class,'changeOrderStatus']);

Route::resource('productselectoption',ProductSelectOptionController::class);
Route::post('productselectoption/addMoreselection',[ProductSelectOptionController::class,'addmoreselection']);
Route::post('productselectoption/deleteselection',[ProductSelectOptionController::class,'deleteselection']);

Route::resource('attribute',AttributeController::class);
Route::resource('attributevalue',AttributeValueController::class);
Route::get('attributevalue/create/{id}',[AttributevalueController::class,'create']);

Route::resource('products',ProductController::class);
Route::patch('products/bannerproductsupdate/{id}',[ProductController::class,'bannerproductsupdate']);
Route::post('products/addMoreImages',[ProductController::class,'addMoreImages']);
Route::post('products/delete-multiple-image',[ProductController::class,'deleteMultipleImages']);

Route::post('products/addflower',[ProductController::class,'addflower']);
Route::post('products/flowerdelete',[ProductController::class,'flowerdelete']);

Route::post('products/addmorebuttons',[ProductController::class,'addmorebuttons']);
Route::post('products/buttondelete',[ProductController::class,'buttondelete']);

Route::resource('variations',VariationController::class);
Route::get('variations/create/{id}',[VariationController::class,'create']);

Route::get('variations/addvariants/{id}',[VariationController::class,'addvariants']);
Route::post('variations/product', [VariationController::class,'post']);

Route::resource('combo',ComboController::class);
Route::get('combo/create/{id}',[ComboController::class,'create']);


Route::post('variations/addMoreImagesvar',[VariationController::class,'addMoreImagesvar']);
Route::post('variations/delete-multiplevar-image',[VariationController::class,'deleteMultipleImagesvar']);

Route::get('variations/get/productvalues',[AddProductVariantController::class,'getProductValues']);
Route::post('variations/addvariant/{id}',[AddProductVariantController::class,'store'])->name('variations.add.str');
Route::post('variations/update/variant/{id}',[AddProductVariantController::class,'update']);
Route::delete('variations/delete/variant/{id}',[AddProductVariantController::class,'destroy']);

Route::get('/changepassword', function () {
    return view('Manager.changepassword');
});

Route::post('changepasswordd',[DashboardController::class,'changepassword']);


Route::get('careerlist', [DashboardController::class, 'applylist']);
Route::delete('careerdestroy/{id}', [DashboardController::class, 'applydestroy']);

Route::get('leavecomment', [DashboardController::class, 'leavecommentlist']);
Route::delete('leavecommentdestroy/{id}', [DashboardController::class, 'leavecommentdestroy']);
Route::post('changeStatus',[DashboardController::class,'changeStatus']);

Route::get('contactlist', [DashboardController::class, 'contactlist']);
Route::delete('contactlistdestroy/{id}', [DashboardController::class, 'contactlistdestroy']);

Route::get('corporatelist', [DashboardController::class, 'corporatelist']);
Route::delete('corporatedestroy/{id}', [DashboardController::class, 'corporatedestroy']);
