<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/briefs/{id}', [\App\Http\Controllers\Api\BriefController::class, 'show']);
