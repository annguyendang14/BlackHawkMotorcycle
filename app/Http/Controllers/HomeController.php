<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;

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
		return view('home');
    }
}
