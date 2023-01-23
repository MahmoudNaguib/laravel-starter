<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Auth;

class IsAdmin{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (auth()->user()->type=='admin') {
            return $next($request);
        }
        flash()->error(trans('app.You are not authorized to do this action'));
        return redirect('/');
    }

}
