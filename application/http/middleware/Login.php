<?php

namespace app\http\middleware;

class Login
{
    public function handle($request, \Closure $next)
    {
        if(!session('name')){
           return redirect('/admin/login');
        }

        return $next($request);
    }
}
