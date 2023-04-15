<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
class UserController extends Controller
{
    public function create(){
    return view('user.create');
    }
    public function store(UserRequest $request){
    $user = User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>bcrypt($request->password),
    ]);
        Auth::login($user);
        return redirect('home')->with('success','Регистрация пройдена');
    }

    public function home(){
    return view('welcome');
    }

    public function loginForm(){
        return view('user.login');
    }

    public function login(LoginRequest $request){
    if(Auth::attempt($request->only('email','password'))){
        if(Auth::user()->is_admin){
            return redirect()->route('admin.index')->with('success','Авторизация пройдена');
        }
        return redirect('home')->with('success','Авторизация пройдена');
    }
    return redirect()->back()->with('error','Вы неверно ввели email или пароль');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login.create');
    }
}
