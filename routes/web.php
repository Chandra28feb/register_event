<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserRegisterController;
use App\Http\Controllers\RegisterEventController;

Route::group(['middleware'=>'auth_check'],function(){
    Route::get('/',[RegisterEventController::class,'index'])->name('register.index');
    Route::post('register/store',[RegisterEventController::class,'store'])->name('register.store');
    Route::post('user/logout',[UserRegisterController::class,'userLogOut'])->name('user.logout');
});

Route::group(['middleware'=>'guest_user'],function(){
Route::get('user/register',[UserRegisterController::class,'index'])->name('user.register');
Route::post('user/store',[UserRegisterController::class,'userStore'])->name('user.store')->middleware('age_check');

});

