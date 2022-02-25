<?php

use App\Http\Livewire\Cart;
use App\Http\Livewire\Product;
use App\Http\Livewire\Category;
use App\Http\Livewire\Create;
use App\Http\Livewire\ProductTransaction;
use App\Http\Livewire\Invoice; 
use App\Http\Livewire\Chart; 
use App\Http\Livewire\AppLayout; 
use App\Http\Livewire\Role; 
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
    return view('auth.login');
});

Auth::routes();


Route::group(['middleware' => ['auth']], function(){
    
    Route::get('/products', Product::class);
    Route::get('/home', Chart::class);
    Route::get('/create', Create::class);
    Route::get('/api/products', [App\Http\Livewire\Product::class, 'api']);
    Route::get('/api/home', [App\Http\Livewire\Chart::class, 'api']);
    Route::get('/api/role', [App\Http\Livewire\Role::class, 'api']);
    Route::get('/categories', Category::class);
    Route::get('/role', Role::class);

    Route::get('/cart', Cart::class);
    Route::get('/invoices', Invoice::class);
});
