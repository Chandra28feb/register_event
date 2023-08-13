<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterEventController;



Route::get('/',[RegisterEventController::class,'index'])->name('register.index');
Route::post('register/store',[RegisterEventController::class,'store'])->name('register.store');