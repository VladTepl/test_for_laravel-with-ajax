<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PersonController;
use App\Http\Controllers\MyAuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\IndexController;

use App\Http\Controllers\TestController;
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

Route::get('/person',[PersonController::class,'show'])->name('person');

Route::get('/home',[IndexController::class,'show'])->name('home'); //маршрут на домашнюю страницу

Route::get('/register',[RegisterController::class,'showRegister'])->name('register');// маршрут на форму регистрации
Route::post('/register',[RegisterController::class,'register']); //маршрут на регистрацию с добавление введенных данных в базу данных

Route::group(['middleware'=>'web'],function()
	{
		Route::get('/login',[MyAuthController::class,'showLogin'])->name('login'); //Маршрут перенаправление не аутентифицированныз пользователей на аутентификацию
		Route::post('/login',[MyAuthController::class,'authenticate']); //маршрут аутентификация,если пользователь был зарегестрирован и есть в базе данных
		Route::get('/logout',[MyAuthController::class,'logout']); //маршрут на выход из системы
	});
	
Route::get('/test',[TestController::class,'show']); //маршрут get-запроса показывает форму
Route::post('/test',[TestController::class,'store']);   //маршрут post-запроса на валидацию и аутентификацию данных из формы