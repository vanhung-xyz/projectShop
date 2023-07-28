<?php
use App\Http\Controllers\Front;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ShopController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[HomeController::class,'index']);

Route::prefix('shop')->group(function () {
    Route::get('/product/{id}', [ShopController::class, 'show' ]);
    Route::post('/product/{id}', [ShopController::class, 'postComment' ]);

    Route::get('/', [ShopController::class, 'index']);

    Route::get('/{ $category->name }', [ShopController::class, 'category']);
});
