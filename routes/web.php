<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('isGuest')->group(function () {
    // isGuest Middleware
    Route::get('/', [RouteController::class, 'login']);
    Route::get('/register', [RouteController::class, 'register']);
    Route::post('/auth', [UserController::class, 'auth']);
    Route::post('/user_register', [UserController::class, 'store']);
});

Route::middleware('isLogin')->group(function () {
    //isLogin Middleware
    Route::middleware('isAdmin:admin,staff')->group(function () {
        Route::get('/buku', [RouteController::class,'buku']);
        Route::get('/peminjaman_admin', [RouteController::class,'data_peminjaman_admin']);
        Route::get('/kategori', [RouteController::class,'kategori']);
        Route::get('/detail_buku/{id}', [RouteController::class,'detail_buku']);
        Route::get('/edit_buku/{id}', [RouteController::class,'edit_buku']);
        Route::get('/edit_kategori/{id}', [RouteController::class,'edit_kategori']);
        Route::get('/export_peminjaman', [RouteController::class,'export_peminjaman']);
        Route::post('/tarik_peminjaman/{id}', [BookController::class,'tarik_peminjaman']);
        Route::post('/add_buku', [BookController::class,'store']);
        Route::put('/update_buku/{id}', [BookController::class,'update']);
        Route::delete('/delete_buku /{id}', [BookController::class,'destroy']);
        Route::post('/add_kategori', [CategoryController::class,'store']);
        Route::put('/update_kategori/{id}', [CategoryController::class,'update']);
        Route::delete('/delete_kategori/{id}', [CategoryController::class,'destroy']);
    });

    Route::middleware('isAdmin:admin,user,staff')->group(function () {
        Route::get('/landing', [RouteController::class,'landing']);
        Route::get('/landing_detail_buku/{id}', [RouteController::class,'landing_detail_buku']);
    });
    
    Route::middleware('isAdmin:admin')->group(function () {
        Route::get('/users', [RouteController::class,'users']);
        Route::post('/user_add', [UserController::class, 'add_user']);
        Route::put('/update_user/{id}', [UserController::class, 'update']);
        Route::delete('/delete_user/{id}', [UserController::class, 'destroy']);
        Route::get('/edit_user/{id}', [RouteController::class,'edit_user']);
        Route::get('/detail_user/{id}', [RouteController::class,'detail_user']);
    });

    Route::middleware('isAdmin:user')->group(function () {
        Route::get('/koleksi', [RouteController::class,'koleksi']);
        Route::get('/peminjaman_user', [RouteController::class,'data_peminjaman_user']);
        Route::post('/pinjam_buku/{id}', [BookController::class,'borrow_book']);
        Route::post('/buku_kembali/{id}', [BookController::class,'return_book']);
        Route::post('/review/{id}', [ReviewController::class,'store']);
        Route::put('/update_review/{id}', [ReviewController::class,'update']);
        Route::post('/koleksi_buku/{id}', [CollectionController::class,'store']);
        Route::delete('/delete_koleksi/{id}', [CollectionController::class, 'destroy']); 
    });
    
});


// outside any middleware
Route::get('/logout', [UserController::class, 'logout']);
Route::get('/error', [RouteController::class, 'error']);







