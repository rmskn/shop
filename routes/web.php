<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
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
    return redirect('catalog');
})->name('home');

Route::get('catalog', [ProductController::class, 'getCatalogPage'])->name('catalog');
Route::get('cart', [CartController::class, 'getCartPage'])->name('cart');

Route::group(['middleware' => 'auth', 'namespace' => 'App\Http\Controllers'], function () {
    Route::group(['middleware' => 'administrate', 'namespace' => 'App\Http\Controllers'], function () {
        Route::get('manager', function () {
            return view('admin.admin-panel');
        })->name('manager');

        Route::name('manager.')
            ->prefix('manager')
            ->group(
                function () {
                    Route::get('new-product', [AdminController::class, 'getNewProductPage'])
                        ->name('new-product');
                    Route::post('new-product', [AdminController::class, 'createProduct'])
                        ->name('create-product');
                    Route::get('edit-products', [AdminController::class, 'getEditProductsPage'])
                        ->name('edit-products');
                    Route::get('edit-products/edit', [AdminController::class, 'getEditProductPage'])
                        ->name('edit-product');
                    Route::post('edit-products/edit', [AdminController::class, 'updateProduct'])
                        ->name('update-product');
                    Route::get('edit-products/delete', [AdminController::class, 'deleteProduct'])
                        ->name('delete-product');
                }
            );
    });


    Route::get('orders', [OrderController::class, 'getOrdersPage'])->name('orders');
    Route::post('create-order', [OrderController::class, 'createOrder'])->name('create-order');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
