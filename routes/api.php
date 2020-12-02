<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Website;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('create-website', function (Request $request){
    $path = $request->file('image')->store('public/showcase-images');
    $request->image = $path;
    Website::add_website($request);
    return $request;
})->name('api-create-website');
Route::post('edit-website', function (Request $request){
    $path = $request->file('image')->store('public/showcase-images');
    $request->image = $path;
    Website::edit_website($request);
    return $request;
})->name('api-edit-website');

Route::get('websites',function(){return Website::all();})->name('api-websites');
