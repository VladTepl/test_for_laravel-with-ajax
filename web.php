<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TestController;

	
Route::get('/test',[TestController::class,'show']); //маршрут get-запроса показывает форму
Route::post('/test',[TestController::class,'store']);   //маршрут post-запроса на валидацию и аутентификацию данных из формы
