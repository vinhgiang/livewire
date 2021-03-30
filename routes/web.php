<?php

use App\Http\Livewire\Home;
use App\Http\Livewire\Login;
use App\Http\Livewire\Register;
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
//    $comments = Comment::latest()->get();
//    return view('welcome', compact('comments'));
    return view('welcome');
});*/

// Single Page Application
Route::get('/', Home::class);
Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class);
