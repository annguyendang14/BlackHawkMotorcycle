<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Staff
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
         if(!Auth::check()){
			
            return redirect('/');
        }
        
        if(!Auth::user()->staff){
			
            return redirect('home');
        } 
    $user = Auth::user();
		return $next($request);
		
    }
}
