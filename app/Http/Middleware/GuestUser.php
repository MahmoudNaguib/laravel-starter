<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Auth;

class GuestUser{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $row = auth()->user();
        if (!$row) {
            if ($request->expectsJson()) {
                return response()->json(['message' => trans('app.Unauthorized user')], 401);
            }
            return redirect('auth/login');
        }
        if($row->type!='guest'){
            if ($request->expectsJson()) {
                return response()->json(['message' => trans('app.You do not have access to this action')], 403);
            }
            flash()->error(trans('app.You do not have access to this action'));
            return redirect('/');
        }
        return $next($request);
    }

}
