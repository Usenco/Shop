<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ConfirmsPasswords;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

use App\Admin;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $check = Admin::where([
            "login"=>$request->login,
            "password"=>$request->password])->first();

        if(!is_null($check))
        {
            $check->generateToken();
            return $check;
        }
        else
        {
            return null;
        }
        
    }

    public function logout(Request $request)
    {
        if( !is_null(Auth::user()) ){
            Auth::user()->api_token = null;
            Auth::user()->save();
        }
    }
}
