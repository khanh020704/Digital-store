<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Member
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
   public function handle(Request $request, Closure $next): Response
{
    if (!Auth::check()) {

        // Nếu là AJAX → trả JSON
        if ($request->ajax()) {
            return response()->json([
                'message' => 'Vui lòng đăng nhập'
            ], 401);
        }

        return redirect('/members/login');
    }

    if (Auth::user()->level != 0) {

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Bạn không có quyền'
            ], 403);
        }
        return redirect('/members/login');
    }

    return $next($request);
}
}
