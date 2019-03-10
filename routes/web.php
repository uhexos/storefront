<?php

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
    return view('welcome');
});

Route::get('/login', function () {return view('login');})->name('login');
Route::get('/test', function () {return view('admin.test');})->name('test');
Route::get('/register', function () {return view('register');})->name('register');
Route::get('/admin/', function () {return view('admin.home');})->name('admin.home');
// Route::get('/admin/category/new', function () {return view('admin.category.createCategory');})->name('admin.createCategory');
// Route::get('/admin/category/all', function () {return view('admin.category.allCategory');})->name('admin.allCategory');
// Route::get('/admin/product/new', function () {return view('admin.product.createProduct');})->name('admin.createProduct');
// Route::get('/admin/products', function () {return view('admin.product.allProduct');})->name('admin.allProduct');
Route::get('/admin/user/new', function () {return view('admin.user.createUser');})->name('admin.createUser');
Route::get('/admin/users', function () {return view('admin.user.allUser');})->name('admin.allUser');
// Route::get('/admin/new/supplier', function () {return view('admin.supplier.createSupplier');})->name('admin.createSupplier');
// Route::get('/admin/suppliers', function () {return view('admin.supplier.allSupplier');})->name('admin.allSupplier');

Route::get('/staff', function () {return view('staff.home');})->name('staff.home');
Route::get('/staff/product/new/auto', function () {return view('staff.product.newAuto');})->name('staff.product.auto');
Route::get('/staff/product/new/manual', function () {return view('staff.product.newManual');})->name('staff.product.manual');
Route::get('/staff/profile', function () {return view('staff.profile');})->name('staff.profile');

Route::prefix('admin')->group(function () {
    Route::name('admin.')->group(function () {
         Route::resource('/category', 'CategoryController');
    });    
});
Route::prefix('admin')->group(function () {
    Route::name('admin.')->group(function () {
         Route::resource('/product', 'ProductController');
    });    
});

Route::prefix('admin')->group(function () {
    Route::name('admin.')->group(function () {
         Route::resource('/supplier', 'SupplierController');
    });    
});