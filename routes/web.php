<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SupervisorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

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

Route::controller(AuthController::class)->group(function(){
    Route::get('register','register')->name('register');
    Route::post('register','registerSave')->name('register.save');

    Route::get('login','login')->name('login');
    Route::post('login','loginAction')->name('login.action');

    Route::get('logout','logout')->middleware('auth')->name('logout');
});

//Normal user routes list
Route::middleware(['auth','user-access:user'])->group(function(){
    Route::get('/home',[HomeController::class, 'index'])->name('home');
});


//Admin Routes List
Route::middleware(['auth','user-access:admin'])->group(function(){
    Route::get('/admin/home',[HomeController::class, 'adminHome'])->name('admin/home');
    
    Route::get('/admin/profile',[AdminController::class, 'profilepage'])->name('admin/profile');
    Route::get('/admin/user', [UserController::class, 'index'])->name('admin/user');
    Route::get('/admin/users/create',[UserController::class,'create'])->name('admin/users/create');
    Route::post('/admin/users/store',[UserController::class,'store'])->name('admin/users/store');
    Route::get('/admin/users/show/{id}',[UserController::class,'show'])->name('admin/users/show');
    Route::get('/admin/users/edit/{id}',[UserController::class,'edit'])->name('admin/users/edit');
    Route::put('/admin/users/edit/{id}',[UserController::class,'update'])->name('admin/users/update');
    Route::delete('/admin/users/destroy/{id}',[UserController::class,'destroy'])->name('admin/users/destroy');
});
Route::middleware(['auth','user-access:manager'])->group(function(){
    Route::get('/manager/profile',[ManagerController::class, 'profilepage'])->name('manager/profile');
    Route::get('/manager/home',[HomeController::class, 'managerHome'])->name('manager/home');
    Route::get('/manager/user', [ManagerController::class, 'index'])->name('manager/user');

});
Route::middleware(['auth','user-access:supervisor'])->group(function(){
    Route::get('/supervisor/profile',[SupervisorController::class, 'profilepage'])->name('supervisor/profile');
    Route::get('/supervisor/home',[HomeController::class, 'supervisorHome'])->name('supervisor/home');
    Route::get('/supervisor/user', [SupervisorController::class, 'index'])->name('supervisor/user');
});

