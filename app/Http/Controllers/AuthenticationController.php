<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function login()
    {
        return view('admin.login-page.login');
    }

    public function postLogin(Request $req){
        $dataLogin = [
            'email' => $req->email,
            'password' => $req->password,
        ];

        if(Auth::attempt($dataLogin)){

        }else{

            // Đăng nhập thất bại
            return redirect()->back()->with([
                'message' => 'Email hoặc mật khẩu không chính xác',
                
            ]);
            
        }
    }
}
