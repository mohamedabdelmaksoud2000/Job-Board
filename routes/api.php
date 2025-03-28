<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')
->group(function(){
    require 'Api/v1.php';
});