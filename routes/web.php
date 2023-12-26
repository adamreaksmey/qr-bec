<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/search-page', function () {
    return view('search');
});

Route::get('/multiple-members', function () {
    return view('multiple-members');
});

Route::get("/checked-in", function () {
    return view('checked-in');
});

Route::get("/login", function () {
    return view('admin.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get("/dashboard", function () {
        return view('admin.dashboard');
    });
});
