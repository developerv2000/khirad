<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

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

Route::controller(MainController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/contacts', 'contacts')->name('contacts');
    Route::get('/faq', 'faq')->name('faq');

    Route::get('/search', 'search')->name('search');
    Route::post('/send-feedback', 'feedback')->name('feedback');
});

Route::controller(CategoryController::class)->prefix('categories')->name('categories.')->group(function () {
    Route::get('/world-most-readable', 'worldMostReadable')->name('world-most-readable');
    Route::get('/top-books', 'topBooks')->name('top-books');
    Route::get('/{slug}', 'show')->name('show');
});

Route::controller(BookController::class)->name('books.')->group(function () {
    Route::get('/all-books', 'index')->name('index');
    Route::get('/books/{slug}', 'show')->name('show');
    Route::get('/books/read/{slug}', 'read')->name('read');
});

Route::controller(AuthorController::class)->prefix('authors')->name('authors.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{slug}', 'show')->name('show');
});

Route::controller(OrderController::class)->prefix('orders')->name('orders.')->group(function () {
    Route::post('/store', 'store')->name('store');
});


Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/', [BookController::class, 'dashboardIndex'])->name('dashboard.index');

    Route::controller(BookController::class)->prefix('/books')->name('books.')->group(function () {
        Route::get('/create', 'create')->name('create');
        Route::get('/{id}', 'edit')->name('edit');

        Route::post('/store', 'store')->name('store');
        Route::post('/update', 'update')->name('update');
        Route::post('/destroy', 'destroy')->name('destroy');
    });

    Route::controller(AuthorController::class)->prefix('/authors')->name('authors.')->group(function () {
        Route::get('/', 'dashboardIndex')->name('dashboard.index');
        Route::get('/create', 'create')->name('create');
        Route::get('/{id}', 'edit')->name('edit');

        Route::post('/store', 'store')->name('store');
        Route::post('/update', 'update')->name('update');
        Route::post('/destroy', 'destroy')->name('destroy');
    });

    Route::controller(CategoryController::class)->prefix('/categories')->name('categories.')->group(function () {
        Route::get('/', 'dashboardIndex')->name('dashboard.index');
        Route::get('/create', 'create')->name('create');
        Route::get('/{id}', 'edit')->name('edit');

        Route::post('/store', 'store')->name('store');
        Route::post('/update', 'update')->name('update');
        Route::post('/destroy', 'destroy')->name('destroy');
    });

    Route::controller(OrderController::class)->prefix('/orders')->name('orders.')->group(function () {
        Route::get('/', 'dashboardIndex')->name('dashboard.index');
        Route::get('/{id}', 'edit')->name('edit');

        Route::post('/destroy', 'destroy')->name('destroy');
    });
});

require __DIR__.'/auth.php';
