<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'v1'
], function () {

    Route::get('test', function () {
        return "working";
    });

    Route::group([
        'prefix' => 'auth',
    ], function () {

        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::post('me', [AuthController::class, 'me']);

    });


    Route::group([
        'prefix' => 'task'
    ], function () {
        Route::get('{status}/all', [TaskController::class, 'all']);
        Route::post('store', [TaskController::class, 'store']);
        Route::patch('{id}/edit', [TaskController::class, 'update']);
        Route::post('{id}/delete', [TaskController::class, 'delete']);

        Route::post('{id}/change-status', [TaskController::class, 'changeStatus']);

        Route::get('{term}/search', [TaskController::class, 'search']);
        
    });
});
