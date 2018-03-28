<?php 

namespace App\Http\Middleware;

use Closure;

class Owner {

    public function handle($request, Closure $next)
    {

        if ( \Auth::check() && \Auth::user()->isActive() )
        {

	           return $next($request);

        }else{

        	die ("Your account has been blocked by admin! ");

        }

    }

}