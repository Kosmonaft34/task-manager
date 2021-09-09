<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index(){
        return view('users.registers');
    }

    public function create(Request $request)//указываем реквест всегда когда надо собрать данные
    {
        //
        $data=$request->all();
       User::create([
            'name'=>$data['name'],
            'password'=>$data['password'],
            'email'=>$data['email']
             ]);
return redirect(route('tasks.index'));

    }
}