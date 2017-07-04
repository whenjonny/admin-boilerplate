<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class ApiAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        #session(['user' => \App\Models\Access\User\User::first()]);
        #session()->save();
        #access()->loginUsingId(5);
        if(access()->guest()) {
            return expire('请先登录');
        }
        $request->setRequestFormat('json');
        return $next($request);
    }
}
