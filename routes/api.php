<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    UserController,
    UserAddressController,
    RoleController,
    MenuController,
    Auth\LoginController,
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('login', [LoginController::class, 'unauthenticated'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.post');

Route::middleware('auth:api')->get('/profile', function (Request $request) {
    return $request->user();
});

Route::apiResources([
    'user' => UserController::class,
    'address' => UserAddressController::class,
    'role'  => RoleController::class,
]);

Route::apiResource('menu', MenuController::class)->only(['index', 'show']);
