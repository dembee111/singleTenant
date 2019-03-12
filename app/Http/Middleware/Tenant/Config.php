<?php

namespace App\Http\Middleware\Tenant;

use Closure;

class Config
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
        /* tenant() method oor tenant medeelliig awj bna*/
        $tenant = $request->tenant();
        // awsan medeellee app.name luu onooj bna
        config()->set('app.name', $tenant->name);
        
        return $next($request);
    }
}
