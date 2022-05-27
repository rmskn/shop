<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


/* Auth not required  */
Route::group(
    [
    ],
    function (Router $api) {
        $api->get(
            'catalog',
            ProductController::class . '@getApiCatalogPage'
        );

//        $api->get(
//            'cart',
//            CartController::class . '@getCartPage'
//        );

    }
);
