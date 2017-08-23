<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Space;

class PreRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
		$this->middleware('closeRegistration');
    }
	
	public function show()
	{
		$user = \Auth::user();
		$spaces = Space::where('availability', '=', 'Not Available')->where('user_id', '=', $user->id)->orderBy('row', 'asc')->orderBy('col', 'asc')->paginate(50);
		return view('pages\spaces-pre-register', compact('spaces'));
	}
	
	
}
