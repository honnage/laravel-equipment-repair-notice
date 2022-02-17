<?php

use Illuminate\Support\Facades\Route;
// use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CustomerController;

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TypeEquipmentController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\VerifyIsStatus;



Route::get('/', function () {
    return view('welcome');
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     // $users = User::all();
//     $users = DB::table('users')->get();
//     return view('dashboard', compact('users'));
// })->name('dashboard');

Route::middleware(['auth:sanctum', 'admin'])->group(function(){
    // transactions
    // Route::get('/dashboard',[TransactionController::class,'index'])->name('dashboard');
    Route::get('/transaction/all',[TransactionController::class,'index'])->name('transaction');
    Route::get('/transaction/createByAdmin',[TransactionController::class,'createByAdmin'])->name('createTransactionByAdmin');
    Route::post('/transaction/add',[TransactionController::class,'store'])->name('addTransaction');
    Route::get('/transaction/editByAdmin/{id}',[TransactionController::class,'editByAdmin']);
    Route::post('/transaction/update/{id}',[TransactionController::class,'update']);
    Route::get('/transaction/destroy/{id}',[TransactionController::class,'destroy']);
    Route::get('/transaction/admin/query/{status}',[TransactionController::class,'queryByAdmin']);
    Route::get('/transaction/details/{id}',[TransactionController::class,'details']);
    Route::get('/transaction/downloadPDF/{id}',[TransactionController::class,'downloadPDF']);
    
    Route::get('/equipment/all',[EquipmentController::class,'index'])->name('equipment');
    Route::get('/equipment/create',[EquipmentController::class,'create'])->name('createEquipment');
    Route::post('/equipment/add',[EquipmentController::class,'store'])->name('addEquipment');
    Route::get('/equipment/edit/{id}',[EquipmentController::class,'edit']);
    Route::post('/equipment/update/{id}',[EquipmentController::class,'update']);
    Route::get('/equipment/destroy/{id}',[EquipmentController::class,'destroy']);
    Route::get('/equipment/query/{id}',[EquipmentController::class,'query']);

    Route::get('/type/all',[TypeEquipmentController::class,'index'])->name('type');
    Route::get('/type/create',[TypeEquipmentController::class,'create'])->name('createType');
    Route::post('/type/add',[TypeEquipmentController::class,'store'])->name('addType');
    Route::get('/type/edit/{id}',[TypeEquipmentController::class,'edit']);
    Route::post('/type/update/{id}',[TypeEquipmentController::class,'update']);
    Route::get('/type/destroy/{id}',[TypeEquipmentController::class,'destroy']);
    Route::get('/type/query/{id}',[TypeEquipmentController::class,'query']);

    Route::get('/category/all',[CategoryController::class,'index'])->name('category');
    Route::get('/category/create',[CategoryController::class,'create'])->name('createCategory');
    Route::post('/category/add',[CategoryController::class,'store'])->name('addCategory');
    Route::get('/category/edit/{id}',[CategoryController::class,'edit']);
    Route::post('/category/update/{id}',[CategoryController::class,'update']);
    Route::get('/category/destroy/{id}',[CategoryController::class,'destroy']);
    Route::get('/category/query/{id}',[CategoryController::class,'query']);
    
    Route::get('/user/all',[UserController::class,'index'])->name('user');
    Route::get('/user/edit/{id}',[UserController::class,'edit']);
    Route::post('/user/update/{id}',[UserController::class,'update']);
    Route::get('/user/query/{id}',[UserController::class,'query']);
    Route::get('/user/query/{id}/status/{status}',[UserController::class,'queryStatus']);
    Route::get('/user/destroy/{id}',[UserController::class,'destroy']);

});


Route::middleware(['auth:sanctum'])->group(function(){

    Route::get('/dashboard',[TransactionController::class,'user'])->middleware('auth', 'verified')->name('dashboard');
    Route::get('/transaction/details/user/{id}',[TransactionController::class,'userDetail']);
    Route::get('/transaction/downloadPDF/{id}',[TransactionController::class,'downloadPDF']);

    Route::get('/transaction/create',[TransactionController::class,'create'])->name('createTransaction');
    Route::post('/transaction/add',[TransactionController::class,'store'])->name('addTransaction');
    Route::get('/transaction/edit/{id}',[TransactionController::class,'edit']);
    Route::post('/transaction/update/{id}',[TransactionController::class,'update']);
    Route::get('/transaction/destroy/{id}',[TransactionController::class,'destroy']);
    Route::get('/transaction/user/query/{id}',[TransactionController::class,'queryByuser']);
    Route::get('/transaction/details/{id}',[TransactionController::class,'details']);
});
