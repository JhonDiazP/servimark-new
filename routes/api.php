<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TypeDocumentController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\MunicipalityController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\ItemRolePermissionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderServiceController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use Laravel\Socialite\Facades\Socialite;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['api', 'jwt.auth'])->group(function() {
    Route::apiResource('order', OrderController::class);
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('roles', [UserController::class, 'getRoles']);
Route::put('enable_user/{id}', [UserController::class, 'enable']);
Route::apiResource('document', TypeDocumentController::class);
Route::apiResource('category', CategoryController::class);
Route::apiResource('countries', CountryController::class);
Route::apiResource('department', RegionController::class);
Route::apiResource('municipality', MunicipalityController::class);
Route::apiResource('gender', GenderController::class);
Route::apiResource('order_service', OrderServiceController::class);
Route::apiResource('review', ReviewController::class);
Route::apiResource('user', UserController::class);
Route::apiResource('service', ServiceController::class);
Route::post('hire_service', [ServiceController::class, 'hireService']);
Route::get('item/role/permission/byRole/{roleId}',[ItemRolePermissionController::class, 'getByRole']);


 
