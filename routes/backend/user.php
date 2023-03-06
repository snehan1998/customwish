<?php

use App\Http\Controllers\Backend\User\UserDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard',[UserDashboardController::class,'index']);
Route::get('/profilesettings', function () {
    return view('/user/profilesettings');
});
Route::get('/profiledetails', [UserDashboardController::class, 'profiledetails']);
Route::get('/address', [UserDashboardController::class, 'address']);

Route::post('changepassword',[UserDashboardController::class,'changepassword']);
Route::post('updateuserprofile',[UserDashboardController::class,'updateuserpro']);
Route::get('/profiledetails', [UserDashboardController::class, 'profiledetails']);

Route::get('/orders', [UserDashboardController::class, 'orders']);
Route::get('/order/{order_id}',[UserDashboardController::class,'orderDetail']);
