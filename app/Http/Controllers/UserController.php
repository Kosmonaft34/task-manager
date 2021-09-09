<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function index(){         //view страницы регистрации
        return view('users.registers');
    }

    public function create(Request $request)//указываем реквест всегда когда надо собрать данные
    {
        //
        $data=$request->all();
       User::create([
            'name'=>$data['name'],
            'password'=>Hash::make($data['password']),
            'email'=>$data['email']
             ]);
return redirect(route('autho'));

    }

    public function authorizationIndex(){
        return view('users.authorization');
    }
   public function autho(Request $request){ //функция авторизации
           $data=$request->all();
//---------------Ручной вариант-----------------------------
//           $user=User::select('id','password','email')
//               ->where('email','=',$data['email'])
//               ->first();

//           if(!isset($user)){//если мы не нашли имэйл
//               return back()->withErrors([
//                   'message' => 'Неверный логин или пароль'
//               ]);
//           }else {
//               if (!Hash::check($data['password'], $user->password)){//если пароль неверный
//                   return back()->withErrors([
//                       'message' => 'Неверный логин или пароль'
//                   ]);
//               }
//            }
       if(!Auth::attempt([
           'email'=>$data['email'],
           'password'=>$data['password']
       ])){
           return back()->withErrors([
                       'message' => 'Неверный логин или пароль'
               ]);
       }
       return redirect(route('index'));
   }
}
