<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;

class Authenticate extends Middleware {
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    public function handle($request, Closure $next, ...$guards) {
        $row = auth()->user();
        if (!$row && token()) {
            $row = \App\Models\User::where('token', token())->first();
        }
        if (!$row) {
            $message = trans('app.Unauthorized user');
            if ($request->expectsJson() || request()->segment(1) == 'api') {
                return response()->json(['message' => $message], 401);
            }
            flash()->error($message);
            return redirect('auth/login');
        }
        if (!$row->is_active) {
            $message = trans('app.Your account is banned');
            if ($request->expectsJson() || request()->segment(1) == 'api') {
                return response()->json(['message' => $message], 401);
            }
            flash()->error($message);
            return redirect('auth/login');
        }
        if (!$row->confirmed) {
            $message = trans('app.This account is not confirmed') . ', ' . trans('app.Please check your email to confirm your account');
            if ($request->expectsJson() || request()->segment(1) == 'api') {
                return response()->json(['message' => $message], 401);
            }
            flash()->error($message);
            return redirect('auth/login');
        }
        if ($request->expectsJson() || request()->segment(1) == 'api') {
            \Auth::login($row);
            request()->headers->set('Authorization', 'Bearer ' . $row->token);
        }
        return $next($request);
    }
}
