<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\FrontendLoginRequest;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view ('Frontend.Login.login');
    }

     public function login(FrontendLoginRequest $request)
    {
        //
        $login = [
            'email' => $request->email,
            'password' => $request->password,
            'level'=>0
        ];
        
        $remember = false;

        if($request->remember_me){
            // echo "string";
            $remember = true;
        }

        if(Auth::attempt($login, $remember)){
           return redirect('/Frontend/home');
        }else{
            return redirect('/Frontend/Login')->back()->with('error',_('dăng nhap khong thành công'));
        }

    }

    public function logout(Request $request){
        Auth::logout();
        return redirect('/Frontend/Login');
    }
}
