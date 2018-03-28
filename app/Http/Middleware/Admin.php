<?php 

namespace App\Http\Middleware;

use Closure;

class Admin {

    public function handle($request, Closure $next)
    {

        if ( \Auth::check() && \Auth::user()->isActive() )
        {

	        if ( \Auth::user()->isAdmin() )
	        {
	            return $next($request);
	        }
        	return redirect('owner/dashboard');

        }else{

        	die ("Your account has been blocked by admin! ");

        }

    }

}