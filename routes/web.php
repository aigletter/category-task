<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Middleware\LocaleMiddleware;
use Illuminate\Routing\Router;
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

Route::get('/', function () {
    return view('welcome');
});

//Route::middleware(LocaleMiddleware::class)->group(function () {
    Route::prefix('categories')->group(function (Router $router) {
        $router->get('/{language?}', [CategoriesController::class, 'index'])->name('categories.index');
        $router->put('/{language?}', [CategoriesController::class, 'update'])->name('categories.update');
    });
//});
