<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\Space;
use App\SystemDate;

class closeRegistration
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
        $currentYear = date('Y');
		$dates = SystemDate::where('year', '=', $currentYear)->first();
		$current = date_create(date("Y-m-d"));
		$open = date_create($dates->open_register);
		$end = date_create($dates->conference_end);
		if ($current < $open or $current > $end){
			return $next($request);
		} else {
			
			return redirect('home') ;
		}
		
		
    }
}
