<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// isGuest Middleware
Route::get('/', [RouteController::class, 'login']);
Route::get('/register', [RouteController::class, 'register']);
Route::post('/auth', [UserController::class, 'auth']);
Route::post('/user_register', [UserController::class, 'store']);

//isLogin Middleware
Route::get('/landing', [RouteController::class,'landing']);
Route::get('/buku', [RouteController::class,'buku']);
Route::get('/kategori', [RouteController::class,'kategori']);
Route::get('/detail_buku/{id}', [RouteController::class,'detail_buku']);
Route::get('/landing_detail_buku/{id}', [RouteController::class,'landing_detail_buku']);
Route::get('/edit_buku/{id}', [RouteController::class,'edit_buku']);
Route::get('/edit_kategori/{id}', [RouteController::class,'edit_kategori']);

// Buku
Route::post('/add_buku', [BookController::class,'store']);
Route::post('/pinjam_buku/{id}', [BookController::class,'borrow_book']);
Route::post('/buku_kembali/{id}', [BookController::class,'return_book']);
Route::put('/update_buku/{id}', [BookController::class,'update']);
Route::delete('/delete_buku /{id}', [BookController::class,'destroy']);

// Kategori
Route::post('/add_kategori', [CategoryController::class,'store']);
Route::put('/update_kategori/{id}', [CategoryController::class,'update']);
Route::delete('/delete_kategori/{id}', [CategoryController::class,'destroy']);

// Review
Route::post('/review/{id}', [ReviewController::class,'store']);

// Koleksi


// outside any middleware
Route::get('/logout', [UserController::class, 'logout']);





