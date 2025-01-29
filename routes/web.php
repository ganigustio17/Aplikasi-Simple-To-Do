<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\User\ForgotPasswordController;
use App\Http\Controllers\User\UserController;
use App\Models\User;

Route::middleware(['auth'])->group(function(){
Route::get('/todo', [TodoController::class, 'index'])->name('todo');
Route::post('/todo', [TodoController::class, 'store'])->name('todo.post');
Route::put('/todo/{id}', [TodoController::class, 'update'])->name('todo.update');
Route::delete('/todo/{id}', [TodoController::class, 'destroy'])->name('todo.delete');
Route::get('/user/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/user/update-data', [UserController::class, 'updateData'])->name('user.update-data');
Route::post('/user/update-data', [UserController::class, 'doUpdateData'])->name('user.update-data.post');
});

Route::middleware(['geust'])->group(function() {
    Route::get('/user/login', [UserController::class, 'login'])->name('login');
    Route::get('/user/register', [UserController::class, 'register'])->name('register');
    Route::get('/user/verifyaccount/{token}', [UserController::class, 'verifyAccount'])->name('user.verifyAccount');
    Route::get('/user/forgotpassword', [ForgotPasswordController::class, 'forgotPasswordForm'])->name('forgotpassword');
    Route::get('/user/resetpassword/{token}', [ForgotPasswordController::class, 'resetPassword'])->name('resetpassword');
    Route::post('/user/login', [UserController::class, 'doLogin'])->name('login.post');
    Route::post('/user/register', [UserController::class, 'doRegister'])->name('register.post');
    Route::post('/user/forgotpassword', [ForgotPasswordController::class, 'doForgotPasswordForm'])->name('forgotpassword.post');
    Route::post('/user/resetpassword', [ForgotPasswordController::class, 'doResetPassword'])->name('resetpassword.post');
});
