<?php


use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/old', function () {
    return view('welcome');
});


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/admin', [PanelController::class, 'index'])->name('admin');

// Productos Rutas
Route::get('/products', [ProductsController::class, 'index'])->name('products');
Route::delete('/admin/products/{id}', [ProductsController::class, 'destroy'])->name('admin.products.destroy');
Route::post('/admin/products/create', [ProductsController::class, 'store'])->name('admin.products.store'); // Cambiado a POST
Route::put('/admin/products/update/{id}', [ProductsController::class, 'update'])->name('admin.products.update');

// Categorias Rutas
Route::get('/category', [CategoryController::class, 'index'])->name('category');
Route::delete('/admi/category/{id}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');
Route::post('/admin/category/create', [CategoryController::class, 'store'])->name('admin.category.store');
Route::put('/admin/category/update/{id}', [CategoryController::class, 'update'])->name('admin.category.update');


// Customers Rutas
Route::get('/customers', [CustomersController::class, 'index'])->name('customers.index');
Route::delete('/admin/customers/{id}', [CustomersController::class, 'destroy'])->name('admin.customers.destroy');
Route::post('/admin/customers/create', [CustomersController::class, 'store'])->name('admin.customers.store');
Route::put('/admin/customers/update/{id}', [CustomersController::class, 'update'])->name('admin.customers.update');

// Orders Rutas
Route::get('/orders', [OrdersController::class, 'index'])->name('orders');
Route::delete('/admin/orders/{id}', [OrdersController::class, 'destroy'])->name('admin.orders.destroy');
Route::post('/admin/orders/create', [OrdersController::class, 'store'])->name('admin.orders.store');
Route::put('/admin/orders/update/{id}', [OrdersController::class, 'update'])->name('admin.orders.update');

// Suppliers Rutas
Route::get('/suppliers', [SuppliersController::class, 'index'])->name('suppliers');
Route::delete('/admin/suppliers/{id}', [SuppliersController::class, 'destroy'])->name('admin.suppliers.destroy');
Route::post('/admin/suppliers/create', [SuppliersController::class, 'store'])->name('admin.suppliers.store');
Route::put('/suppliers/update/{id}', [SuppliersController::class, 'update'])->name('admin.suppliers.update');

// Users Rutas
Route::get('/user', [UserController::class, 'index'])->name('user');
Route::get('admin/users', [UserController::class, 'inde'])->name('personal');
Route::post('/añadir-usuario', [UserController::class, 'stor'])->name('añadir-usuario');
Route::post('/añadir-aministrador', [UserController::class, 'store'])->name('añadir-aministrador');
Route::post('/añadir-empleado', [UserController::class, 'storee'])->name('añadir-empleado');
Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('destroy');
Route::get('/admin/personal/edit/{id}', [UserController::class, 'edit'])->name('edit');
Route::put('/admin/personal/update/{id}', [UserController::class, 'update'])->name('admin.update');


Route::get('/busqueda', [PanelController::class, 'search'])->name('search');

Auth::routes();

// Route::post('/login', [AuthController::class, 'login'])->name('login');
// Route::post('/register', [AuthController::class, 'register'])->name('register');