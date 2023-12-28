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

Route::prefix('bec')->namespace('bec')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/create-relative', [MembersController::class, 'registerRelatives']);
    Route::get('/all-members', [MembersController::class, 'getAllMembers']);
    Route::patch('/update-user-status', [MembersController::class, 'updateUserStatus']);
    Route::patch('/update-relative-status', [MembersController::class, 'updateRelativeStatus']);
    Route::get("/check-user-relationship", [MembersController::class, 'checkUserRelationship']);
    Route::get("/get-user-relatives", [MembersController::class, "getUsersRelatives"]);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/get-registered-user', [AuthController::class, 'getRegisteredUser']);
    });
});
