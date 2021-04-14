<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Here\HereMapsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\ProductManufacturerController;
use App\Http\Controllers\MeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ShoppingListController;
use App\Http\Controllers\UserPositionController;
use App\Http\Controllers\UserProfileController;
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

Route::resource(    '/',                        LandingController::class)->only(['index'])->middleware(['position.unset']);
Route::get(         '/me',                      MeController::class);
Route::post(        '/position',                [UserPositionController::class, 'store']);
Route::resource(    '/home',                    HomeController::class)->only('index')->middleware(['position.set']);
Route::resource(    '/product/manufacturer',    ManufacturerController::class)->only(['index']);
Route::resource(    '/product/category',        CategoryController::class)->only(['index']);
Route::resource(    '/product',                 ProductController::class)->only(['index', 'create', 'store', 'show'])->middleware('position.set');
Route::resource(    '/shop',                    ShopController::class);
Route::resource(    '/shoppingList',            ShoppingListController::class)->parameter('shoppingList','id')->middleware(['auth']);
Route::get(         '/maps/discover',           [HereMapsController::class, 'discover']);
Route::resource(    '/admin/category' ,         ProductCategoryController::class)->middleware('admin');
Route::resource(    '/admin/manufacturer' ,     ProductManufacturerController::class)->middleware('admin')->only(['index','create','store','edit','update']);
Route::resource(    '/admin/user' ,             AdminUserController::class)->middleware('admin')->only(['index','edit','update','destroy']);
Route::resource(    '/admin' ,                  AdminController::class)->middleware('admin');
Route::resource(    '/user/profile',            UserProfileController::class)->middleware('auth')->only(['show', 'update', 'edit', 'destroy']);



require __DIR__.'/auth.php';
