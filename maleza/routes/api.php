<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CustomersController;
use App\Http\Controllers\Api\InventoryController;
use App\Http\Controllers\Api\OrderdetailsController;
use App\Http\Controllers\Api\OrdersController;
use App\Http\Controllers\Api\PointshistoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\RewardprogramController;
use App\Http\Controllers\Api\SuppliersController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Events\Login;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/Suppliers', [SuppliersController::class, 'list']);
Route::get('/Suppliers/{id}', [SuppliersController::class, 'item']);
Route::post('/Suppliers/create', [SuppliersController::class, 'create']);

Route::get('/Inventory', [InventoryController::class, 'list']);
Route::get('/Inventory/{id}', [InventoryController::class, 'item']);
Route::post('/Inventory/create', [InventoryController::class, 'create']);

Route::get('/Orderdetails', [OrderdetailsController::class, 'list']);
Route::get('/Orderdetails/{id}', [OrderdetailsController::class, 'item']);
Route::post('/Orderdetails/create', [OrderdetailsController::class, 'create']);

Route::get('/Orders', [OrdersController::class, 'list']);
Route::get('/Orders/{id}', [OrdersController::class, 'item']);
Route::post('/Orders/create', [OrdersController::class, 'create']);

Route::get('/Pointshistory', [PointshistoryController::class, 'list']);
Route::get('/Pointshistory/{id}', [PointshistoryController::class, 'item']);
Route::post('/Pointshistory/create', [PointshistoryController::class, 'create']);
  
Route::get('/Products', [ProductsController::class, 'list']);
Route::get('/Products/{id}', [ProductsController::class, 'item']);
Route::post('/Products/create', [ProductsController::class, 'create']);

Route::get('/Users', [UserController::class, 'list']);
Route::get('/Users/{id}', [UserController::class, 'item']);
Route::post('/Users/create', [UserController::class, 'create']);

Route::get('/Rewardprogram', [RewardprogramController::class, 'list']);
Route::get('/Rewardprogram/{id}', [RewardprogramController::class, 'item']);
Route::post('/Rewardprogram/create', [RewardprogramController::class, 'create']);

Route::get('/Customers', [CustomersController::class, 'list']);
Route::get('/Customers/{id}', [CustomersController::class, 'item']);
Route::post('/Customers/create', [CustomersController::class, 'create']);


Route::get('/Category', [CategoryController::class, 'list']);
Route::get('/Category/{id}', [CategoryController::class, 'item']);
Route::post('/Category/create', [CategoryController::class, 'create']);

Route::post('/Login', [AuthController::class, 'login']);
Route::post('/Register', [AuthController::class, 'register']);

