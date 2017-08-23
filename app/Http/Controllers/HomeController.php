<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\SystemDate;
use App\Space;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Cart::restore(\Auth::user()->id);
		Cart::store(\Auth::user()->id);
		$closeRegistration = false;
		
		$currentYear = date('Y');
		$dates = SystemDate::where('year', '=', $currentYear)->first();
		$current = date_create(date("Y-m-d"));
		$open = date_create($dates->open_register);
		$openString = $dates->open_register;
		$end = date_create($dates->conference_end);
		if ($current < $open or $current > $end){
			$closeRegistration = true;
		}
		$user = \Auth::user();
		$spaces = Space::where('availability', '=', 'Not Available')->where('user_id', '=', $user->id)->orderBy('row', 'asc')->orderBy('col', 'asc')->count();
		return view('home', compact('closeRegistration', 'spaces', 'openString'));
    }
}
