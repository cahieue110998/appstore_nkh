<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
            if(Auth::user()->role > 0){
                return $next($request);
            }
            else{
                return redirect()->route('login.admin')->with('error','Bạn không có quyền truy cập vào trang này');
            }
        }
        else{
            return redirect()->route('login.admin')->with('error','Đăng nhập để vào trang quản trị');
        }
    }
}
