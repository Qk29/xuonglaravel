<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Session;


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

            // logout hết các tài khoản khác 
            Session::where('user_id', Auth::id())->delete();
            // Tạo phiên đăng nhập mới
            session()->put('user_id',Auth::id());


            // đăng nhập thành công
            if(Auth::user()->role == 1){
                return redirect()->route('admin.products.index')->with([
                    'message'=>'Đăng nhập thành công'
                ]);
            }else{
                echo "Trang chủ của User";
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

    public function register(){
        return view('admin.login-page.register');
    }

    public function postRegister(Request $req){
        $check = User::where('email',$req->email)->exists();
        if($check){
            return redirect()->back()->with([
                'message' => "Email đã tồn tại, vui lòng đổi email khác"
            ]);
        }else{
            $data = [
                'name' => $req->name,
                'email' => $req->email,
                'password' => Hash::make($req->password)
            ];
            $newUser = User::create($data);

            return redirect()->route('login')->with([
                'messageRegister' => 'Register successfully'
            ]);
        }
    }
}
