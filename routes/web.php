<?php

use App\Http\Controllers\Backend\User\UserDashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ManagerLoginController;
use App\Http\Controllers\ManagerRegisterController;
use App\Http\Controllers\OrderConfirmController;
use App\Http\Controllers\RegisterNewUserController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/corporategift', function () {
    return view('corporategift');
});
Route::get('/giftvoucher', function () {
    return view('giftvoucher');
});
Route::get('/corporateproductdetails', function () {
    return view('corporateproductdetails');
});
Route::get('google-autocomplete', [WebsiteController::class, 'google']);
Route::post('/locationcheck',[WebsiteController::class, 'pushlocation']);

Route::post('/addwishlist',[CartController::class,'addtowishlist']);
Route::get('/load-cart-data',[CartController::class,'cartcount']);
Route::get('/load-wishlist-data',[CartController::class,'wishlistcount']);
Route::get('/user/wishlist', [WebsiteController::class, 'wishlist']);
Route::get('/delwish/{id}', [CartController::class, 'deletewishlist']);
Route::post('/applyCoupon',[CartController::class,'applyCoupon']);
Route::get('delCoupon/{user_id}',[CartController::class,'removeCoupon']);

Route::get('prnpriview/{order_id}',[UserDashboardController::class,'print']);

Route::get('/cart', [CartController::class, 'cart']);
Route::get('/checkout', [WebsiteController::class,'checkout']);
Route::get('/checkout/{id}', [WebsiteController::class,'checkoutbuy']);
Route::post('placeorder',[OrderConfirmController::class,'confirmorder']);// Add to cart then place order
Route::Post('placeorderbuy/{id}',[OrderConfirmController::class,'confirmorderbuy']); // Buy now place order

Route::get('orderconfirmed/{id}',[WebsiteController::class,'orderconfirmed']);
Route::get('/inc/{id}/user_id/{user_id}',[CartController::class,'increaseCartQuantity']);
Route::get('/dec/{id}/user_id/{user_id}',[CartController::class,'decreaseCartQuantity']);
Route::get('/del/{id}/user_id/{user_id}',[CartController::class,'deleteCartQuantity']);
Route::get('/deletecartalldata/{id}/user_id/{user_id}',[CartController::class,'deletecartalldata']);

Route::post('notifyinstock',[WebsiteController::class,'notifyinstock']);

Route::get('/redirect',[GoogleController::class,'redirect']); // Google Login
Route::get('/callback',[GoogleController::class,'callback']); // Google Login

Route::get('/facebook', [FacebookController::class, 'redirectToFacebook']); // Facebook Login
Route::get('/facebook/callback', [FacebookController::class, 'handleFacebookCallback']); // Facebook Login

Route::post('/productreview',[WebsiteController::class,'productreview'])->middleware(['honey']);

Route::get('searcha',[WebsiteController::class,'search']);
Route::get('products',[WebsiteController::class,'productindex'])->name('products.productindex');//sortby else condition redirection

Route::get('/products/{id}', [FilterController::class, 'list']); // Child Category Product List Filter Page
Route::get('/subproducts/{id}', [FilterController::class, 'subproductlist']); // Sub Category Product List Filter Page
Route::get('searchproductfilter', [FilterController::class, 'searchproductlist']);
Route::get('/cat/{id}', [WebsiteController::class, 'subcategory']);
Route::get('/sub/{id}', [WebsiteController::class, 'childcategory']);
Route::get('/sp/{id}', [WebsiteController::class, 'subproductlist']); // Subcategory wise Product Listing
Route::get('/p/{id}', [WebsiteController::class, 'productlist']); // Child Category Wise Product List
Route::get('/cp/{id}', [WebsiteController::class, 'trendproductlist']); // Trending ,You may Also Like ,New Arival wise Product Listing
Route::get('/offers', [WebsiteController::class, 'offerproductlist']); // ]Offer Product Listing
Route::get('/pro/{slug}', [WebsiteController::class, 'productdetail']);

Route::get('/', [WebsiteController::class, 'index']);
Route::get('/contactus', [WebsiteController::class, 'contactus']);
Route::get('/aboutus', [WebsiteController::class, 'aboutus']);
Route::get('/pages/{id}', [WebsiteController::class, 'dynamicpage']);
Route::get('/blogs', [WebsiteController::class, 'bloglist']);
Route::get('/blogcat/{id}', [WebsiteController::class, 'blogcat']);
Route::get('/blog/{slug}', [WebsiteController::class, 'blogdetails']);
Route::get('/faq', [WebsiteController::class, 'faq']);
Route::get('/client', [WebsiteController::class, 'testimonial']);
Route::get('/careeropportunity', [WebsiteController::class, 'career']);
Route::get('/media', [WebsiteController::class, 'medialist']);
Route::get('/media/{slug}', [WebsiteController::class, 'mediadetail']);
Route::get('/event', [WebsiteController::class, 'eventlist']);
Route::get('/event/{slug}', [WebsiteController::class, 'eventdetail']);

Route::post('/contactform',[WebsiteController::class,'contactform'])->middleware(['honey']);
Route::post('/leaveacomment',[WebsiteController::class,'leaveacomment'])->middleware(['honey']);
Route::post('/careerform',[WebsiteController::class,'careerform'])->middleware(['honey']);

Route::post('storerr',[CartController::class,'storerr']);

Route::post('/comboloadd',[WebsiteController::class,'comboloadd']);

Route::post('/loadd',[WebsiteController::class,'loadd']);
Route::post('/charmloadd',[WebsiteController::class,'charmloadd']);

Route::post('/fetchproduct', [WebsiteController::class,'fetchproduct']);
Route::post('/fetchimages', [WebsiteController::class,'fetchimages']);

//Route::post('varadd-to-cart',[CartController::class,'combovaraddToCart']);

Route::post('varadd-to-cart',[CartController::class,'varaddToCart']); // variation with combo add to cart
Route::post('add-to-cart',[CartController::class,'addToCart']);
Route::post('comadd-to-cart',[CartController::class,'comboaddToCart']); // combo with simple product add to cart
Route::post('checkoutadd-to-cart',[CartController::class,'checkoutaddToCart']); // direct checkout page buy now functionality for simple product
Route::post('checkoutvaradd-to-cart',[CartController::class,'checkoutvaraddToCart']); // direct checkout page buy now functionality for variation product


Route::post('registerNewUser',[RegisterNewUserController::class,'register']);
Route::post('/login/custom',[LoginController::class,'login'])->name('login.custom');
Route::get('/managerregister', [ManagerRegisterController::class, 'index']);
Route::post('managerregistersubmit',[ManagerRegisterController::class,'register']);
Route::post('managerloginsubmit', [ManagerLoginController::class, 'login']);
Route::get('/managerlogin', function () {
    return view('managerlogin');
});

Route::group([
    'namespace' => '',
    'prefix' => 'user',
    'as' => 'user.',
    'middleware' => ['auth','user']],
    function () {

       require base_path('/routes/backend/user.php');
    });

Route::group([
    'namespace' => '',
    'prefix' => 'manager',
    'as' => 'manager.',
    'middleware' => ['auth','manager']],
    function () {

       require base_path('/routes/backend/manager.php');
    });


Route::group([
    'namespace' => '',
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => ['auth','admin']],
    function () {

       require base_path('/routes/backend/admin.php');
    });


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
