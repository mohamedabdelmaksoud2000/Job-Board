<?php

use App\Http\Controllers\Api\AttributeController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\LanguageController;
use App\Http\Controllers\Api\LocationController;
use Illuminate\Support\Facades\Route;

Route::apiResources([
    'languages' => LanguageController::class,
    'locations' => LocationController::class,
    'categories' => CategoryController::class,
    'jobs' => JobController::class,
    'attributes' => AttributeController::class
]);
