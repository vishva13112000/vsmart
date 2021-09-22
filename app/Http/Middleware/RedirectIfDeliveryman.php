<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfDeliveryman
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @param  string|null  $guard
	 * @return mixed
	 */
	public function handle($request, Closure $next, $guard = 'deliveryman')
	{
	    if (Auth::guard($guard)->check()) {
	        return redirect('deliveryman/home');
	    }

	    return $next($request);
	}
}