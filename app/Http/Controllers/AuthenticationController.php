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
        $remember = $req->has('remember');

        if(Auth::attempt($dataLogin,$remember)){
            // đăng nhập thành công

            if(Auth::user()->role == 1){
                return redirect()->route('admin.products.index')->with([
                    'message'=>'Đăng nhập thành công'
                ]);
            }else{
                echo "Tài khoản không có quyền truy cập vào trang quản trị";
            }

            
        }else{

            // Đăng nhập thất bại
            return redirect()->back()->with([
                'message' => 'Email hoặc mật khẩu không chính xác',
                
            ]);
            
        }
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with([
            'messageLogout' => 'Đăng xuất thành công',
            
        ]);
    }
}
