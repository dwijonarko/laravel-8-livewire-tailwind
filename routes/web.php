<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware'=>'auth'],function(){
    Route::get('/dashboard',function(){
        return view('dashboard');
    })->name('dashboard');
    Route::get('profile',[ProfileController::class,'index'])->name('profile');
    Route::put('profile',[ProfileController::class,'update'])->name('profile.update');

    Route::view('categories','categories')->name('categories.index');
    Route::view('users','users')->name('users.index')->middleware('can:view,App\Models\User');
});
require __DIR__.'/auth.php';
