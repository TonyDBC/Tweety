<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\FollowsController;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware('auth')->group(function(){
    Route::get('/home',[TweetController::class,'index'])->name('home');
    Route::post('/tweets', [TweetController::class,'store']);
    Route::post('/profiles/{user:name}/follow',[FollowsController::class,'store']);
});

// In Laravel 7 and above, can simply add the name attribute after the colon
Route::get('/profiles/{user:name}', [ProfilesController::class,'show'])->name('profile');




