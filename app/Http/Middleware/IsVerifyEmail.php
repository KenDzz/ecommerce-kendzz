<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsVerifyEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {

        if (Auth::check() && !Auth::user()->is_email_verified) {
            auth()->logout();
            return redirect()->route('auth-login')
                    ->with('message', 'Kiểm tra hộp thư! Xác minh email của bạn trước khi đăng nhập!');
          }

        return $next($request);
    }
}
