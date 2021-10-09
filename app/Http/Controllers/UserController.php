<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\UserRegisterRequest;
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

    public function create(UserRegisterRequest $request)//указываем реквест всегда когда надо собрать данные
    {
        //
        $data=$request->validated();
       User::create([
           'surname'=>$data['surname'],
            'Date_Birth'=>$data['Date_Birth'],
            'patronymic'=>$data['patronymic'],
            'name'=>$data['name'],
            'password'=>Hash::make($data['password']),
            'email'=>$data['email']
             ]);
return redirect(route('autho'));

    }

    public function authorizationIndex(){
        return view('users.authorization');
    }
   public function autho(AuthRequest $request){ //функция авторизации
           $data=$request->validated();

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
       ],
           isset($data['remember']))){  //isset проверяет если галочка 'Запомнить меня' нажата,то возвращает тру
           return back()->withErrors([
                       'message' => 'Неверный логин или пароль'
               ]);
       }
       return redirect(route('index'));
   }
   public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate(); //Чистим данные во внутреннем хранилище
        $request->session()->regenerateToken();//Убираем токен запонить пароль
       return redirect(route('authorization'));
   }
   public function show(){
        $data = User::select('id','name','surname', 'patronymic', 'Date_Birth','email' )
        ->find(Auth::id());//параметры для авторизованоного айди
        return view('users.show',['user'=>$data]);
   }
}
