<?php

namespace LaravelCommerce\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use LaravelCommerce\Http\Requests;
use LaravelCommerce\Http\Controllers\Controller;

class TestController extends Controller
{
    public function getExemploTest()
    {
        return "oi";
    }

    public function getLogin()
    {
        $data = [
            'email' => 'andreluiz1013@hotmail.com',
            'password' => 123456
        ];

        if(Auth::attempt($data)){
            return Auth::user();
        }
        return "falhou";

        if(Auth::check($data)){
            return "Logado";
        }
        return "falhou";

    }

    public function getLogout(){
        Auth::logout();
        if(Auth::check()){
            return "Logado";
        }
        return "Não está logado";
    }
}
