<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class CheckRoleUser
{
    
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){
            if(Auth::user()->role == 1){
                return $next($request);
            }else{
                // điều hướng về trang chủ của user
                return response('Unauthorized', 403); // tạm thời, sau có trang chủ user thì điều hướng về trang chủ user
            }
        }else{
            return redirect()->route('login')->with([
                'message' => 'Bạn cần đăng nhập để truy cập vào trang quản trị',
            ]);
        }
       
    }
}
