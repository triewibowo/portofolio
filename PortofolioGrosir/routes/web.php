<?php

use App\Http\Livewire\Cart;
use App\Http\Livewire\Product;
use App\Http\Livewire\Category;
use App\Http\Livewire\ProductTransaction;
use App\Http\Livewire\Invoice;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();


Route::group(['middleware' => ['auth']], function(){
    Route::get('/products', Product::class);
    Route::get('/api/products', [App\Http\Livewire\Product::class, 'api']);
    Route::get('/categories', Category::class);
    Route::get('/cart', Cart::class);

    Route::get('/histories', ProductTransaction::class);
    Route::get('/invoices', Invoice::class);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
