<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\TaskListController as TaskListController;
use App\Http\Controllers\Api\V1\TaskController as TaskController;
use App\Http\Controllers\AuthController as AuthController;
use App\Models\User;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// User Related Routes
Route::post('/register', [AuthController::class, 'register'])->middleware('guest:sanctum')->name('register');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest:sanctum')->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum')->name('logout');

// Task Related Routes
Route::apiResource('task-list', TaskListController::class)->middleware('auth:sanctum');
Route::apiResource('task', TaskController::class)->middleware('auth:sanctum');


Route::get('/user2', function () {
    return User::all();
});

