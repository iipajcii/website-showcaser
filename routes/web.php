<?php

use Illuminate\Support\Facades\Route;
use App\Models\Website;
use Illuminate\Http\Request;
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
Route::post('/dashboard', function(Request $request) {return view('dashboard');})->name('dashboard');
Route::get( '/dashboard', function(Request $request) {return redirect('login');});
