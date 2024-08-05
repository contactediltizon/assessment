<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\Auth\LoginController;
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

Route::view('/sample', 'sample');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');//login

Route::get('/stores', [StoreController::class, 'index'])->middleware('auth'); //displaying store
// Route::post('/stores/export', [StoreController::class, 'export'])->middleware('auth'); 
Route::post('/stores/export', [StoreController::class, 'export'])->name('stores.export');//export funcitonality

Route::get('/stores/{id}', [StoreController::class, 'show'])->middleware('auth');

Route::get('/test-email', function () {
    $details = [
        'title' => 'Mail from Laravel',
        'body' => 'This is for testing email using smtp.'
    ];
   
    \Mail::to('test@example.com')->send(new \App\Mail\TestMail($details));
   
    return 'Email sent successfully!';
});