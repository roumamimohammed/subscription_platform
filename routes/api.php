<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::post('/website/{id}/post', [PostController::class, 'store']);

Route::post('/website/{id}/subscribe', [SubscriptionController::class, 'store']);
