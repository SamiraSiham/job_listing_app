<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;


Route::get('/', [ListingController::class, 'index']);

Route::get('/listing/{listing}', [ListingController::class, 'show']);

Route::get('/listings/create',[ListingController::class, 'create'])->middleware('auth');

Route::post('/listings',[ListingController::class, 'store'])->middleware('auth');

Route::get('/listings/{listing}/edit',[ListingController::class, 'edit']);

Route::put('/listings/{listing}',[ListingController::class, 'update'])->middleware('auth');

Route::delete('/listings/{listing}',[ListingController::class, 'destroy'])->middleware('auth');

Route::get('/listings/manage',[ListingController::class, 'manage'])->middleware('auth');


Route::get('/register', [UserController::class, 'create'])->middleware('guest');
Route::post('/users', [UserController::class, 'store']);

Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

Route::post('/logout', [UserController::class, 'logout']);