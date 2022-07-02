<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

//контроллер обработки всех запросов из формы

class TestController extends Controller
{
	//функция показывает форму
	
    public function show()
	{
		return view('test',['title'=>'test']);
	}
	
	//функция валидации и аутентификации
	
	public function store(Request $request)
	{	
			// валидация введенных данных в форму
	
			$credentials=Validator::make($request->all(),
			[
			'name'=>'required|max:20',
			'surname'=>'required|max:30',
			'email'=>'required|email:rfc,dns',
			'password'=>'required|min:4|confirmed',
			'password_confirmation'=>'required'
			],
			[
			'required'=>':attribute должен быть заполнен.',
			'email.email'=>'не корректный :attribute',
			'confirmed'=>'пароли не совпадают',
			'password.min'=>'пароль должен быть не меньше 4 символов'
			]); 
		
			if($credentials->fails())
			{
				return response()->json(['errors'=>$credentials->errors()->all()]); //вывод ошибок валидации на front-end
				
				
			}
				//аутентификация пользователя через базу данных
				
				 if (Auth::attempt($request->all(),$request->get('remember')=='on' ? true : false)){
					 
					$request->session()->regenerate();

					return response()->json(['success'=>'Вы успешно вошли в систему']);  //сообщение при успешной аутентификации
					
					}else{
					
					return response()->json(['success'=>'Такого пользователя нет в базе данных']);  //сообщение если пользователя нет в базе данных
				}
	
				
				
	}	
				
				
}
