<?php

use Illuminate\Support\Facades\Route;
use App\Models\Website;
use App\Models\Action;
use Illuminate\Http\Request;
use App\Models\User;
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

Route::get( '/', function() {return view('index')->with('website',Website::all());});
Route::get( '/login', function() {return view('login');})->name('login');
Route::post('/dashboard', function(Request $request) {
    $user = User::where('name',$request->username)->where('password',$request->password)->first();
    if(!$user){return redirect('login');}
    else{
        $recent = Action::recent();
        return view('dashboard')->with('recent',$recent)->with('user',$user)->with('website',Website::get());
    }
})->name('dashboard');
Route::get( '/dashboard', function(Request $request) {return redirect('login');});
