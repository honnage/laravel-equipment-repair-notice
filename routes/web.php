<?php

use Illuminate\Support\Facades\Route;
// use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\transactionController;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // $users = User::all();
    $users = DB::table('users')->get();
    return view('dashboard', compact('users'));
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    // transactions
    Route::get('/transaction/all',[transactionController::class,'index'])->name('transaction');

    // Department
    Route::get('/category/all',[CategoryController::class,'index'])->name('category');
    Route::post('/category/add',[CategoryController::class,'store'])->name('addCategory');
    Route::get('/category/edit/{id}',[CategoryController::class,'edit']);
    Route::post('/category/update/{id}',[CategoryController::class,'update']);

    // Customer
    Route::get('/customer/all',[CustomerController::class,'index'])->name('customer');
    Route::post('/customer/add',[CustomerController::class,'store'])->name('addCustomer');
    Route::get('/customer/edit/{id}',[CustomerController::class,'edit']);
    Route::get('/customer/detail/{id}',[CustomerController::class,'detail']);
    Route::post('/customer/update/{id}',[CustomerController::class,'update']);

    // Department
    Route::get('/department/all',[DepartmentController::class,'index'])->name('department');
    Route::post('/department/add',[DepartmentController::class,'store'])->name('addDepartment');
    Route::get('/department/edit/{id}',[DepartmentController::class,'edit']);
    Route::post('/department/update/{id}',[DepartmentController::class,'update']);

    Route::get('/department/softdelete/{id}',[DepartmentController::class,'softdelete']);
    Route::get('/department/restore/{id}',[DepartmentController::class,'restore']);
    Route::get('/department/delete/{id}',[DepartmentController::class,'delete']);

    // Service
    Route::get('/service/all',[ServiceController::class,'index'])->name('service');
    Route::post('/service/add',[ServiceController::class,'store'])->name('addService');
    Route::get('/service/edit/{id}',[ServiceController::class,'edit']);
    Route::post('/service/update/{id}',[ServiceController::class,'update']);
    Route::get('/service/delete/{id}',[ServiceController::class,'delete']);

});
