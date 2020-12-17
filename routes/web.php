<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\FollowsController;
use App\Http\Controllers\ExploreController;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/home', function () {
    return view('home');
});

Route::get('/dashboard', function(){
    return view('dashboard');
})->name('dashboard');

Route::middleware('auth')->group(function(){
    // The route name is defined with ->name('route_name)
    Route::get('/home',[TweetController::class,'index'])->name('home');
    Route::post('/tweets', [TweetController::class,'store']);
    Route::post('/profiles/{user:username}/follow',[FollowsController::class,'store'])->name('follow');
    Route::get('/profiles/{user:username}/edit',[ProfilesController::class,'edit'])->middleware('can:edit,user');
    Route::patch('/profiles/{user:username}',[ProfilesController::class,'update'])->middleware('can:edit,user');
});

Route::get('/explore',[ExploreController::class,'index']);

// In Laravel 7 and above, can simply add the name attribute after the colon
Route::get('/profiles/{user:username}', [ProfilesController::class,'show'])->name('profile');


