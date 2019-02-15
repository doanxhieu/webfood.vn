<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class SentinelCheckLogin
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
        if (Sentinel::check()) {
            $user = Sentinel::getUser();
            if ($user->hasAnyAccess(['admin','employee'])) {
                return $next($request);
            }else{
                return redirect(route('admin.login'));
            }
        }else{
            return redirect(route('admin.login'));
        }
        
    }
}
