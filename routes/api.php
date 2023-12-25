<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MembersController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('bec')->namespace('bec')->group(function () {

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/refresh', [AuthController::class, 'refresh']);

    Route::middleware(['auth:api'])->group(function () {
        Route::get('/hello', function () {
            return [
                "message" => "hello world"
            ];
        });
        
        Route::post('/create-relative', [MembersController::class, 'registerRelatives']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/requested-users', [AuthController::class, 'requested']);
    });
});
