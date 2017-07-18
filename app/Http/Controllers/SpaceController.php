<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Space;
use Session;
use Redirect;
use Request as Re;

class SpaceController extends Controller
{
    //['Reserved', 'Available', 'Not Available', 'Registered']
	
	public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('staff')->only('create','store','destroy');
    }
	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* $spaces = Space::orderBy('row', 'asc')->orderBy('col', 'asc')->paginate(50);
		$staff = \Auth::user()->staff;
        return view('pages\spaces', compact('spaces', 'staff')); */
		return redirect('spaces/availability/all');
    }
	
	/**
     * Display a listing of the resource base on status
     *
     * @return \Illuminate\Http\Response
     */
	public function indexStat($availability)
    {
        Session::flash('backUrl', Re::fullUrl());
		$availabilities = ['all' => 'all', 'reserved' => 'Reserved', 'available' => 'Available', 'not_available' => 'Not Available', 'registered' => 'Registered'];
	
		//using AJAX later maybe, not for initial testing
		if (! array_key_exists($availability, $availabilities)){
			$eMes = 'The status is invalid';
			return view('error\custom-error', compact('eMes') );
		} elseif ($availability == 'all') {
			$spaces = Space::orderBy('row', 'asc')->orderBy('col', 'asc')->paginate(50);
			
		} else {
			$spaces = Space::where('availability', '=', $availabilities[$availability])->orderBy('row', 'asc')->orderBy('col', 'asc')->paginate(50);
			
		}
		$staff = \Auth::user()->staff;
        return view('pages\spaces', compact('spaces', 'staff', 'availabilities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		if (Session::has('backUrl')) {
		   Session::keep('backUrl');
		}
		$user = \Auth::user();
		return view('pages\admin\spaces-create', compact('user'));
		
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Session::has('backUrl')) {
		   Session::keep('backUrl');
		}
		try {
			$request['user_id'] = \Auth::user()->id;
			$space = Space::create($request->all());
			
			return ($url = Session::get('backUrl')) 
		   ? Redirect::to($url) 
		   : Redirect::route('spaces.index');
		}catch(\Exception $e) {
			$eMes = 'The space you try to create already exsisted or there are some other errors';
			return view('error\custom-error', compact('eMes') );
		} 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       if (Session::has('backUrl')) {
		   Session::keep('backUrl');
		}
		$user = \Auth::user();
		// for admin
		if ($user->staff) {
			$space = space::find($id);
			return view('pages\admin\spaces-edit', compact('user', 'space'));
		}
		//for user -> later will be buy page, but now just an error page
		return view('error\404');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //only for admin for now, but available for user later to buy
		if (Session::has('backUrl')) {
		   Session::keep('backUrl');
		}
		$space = Space::find($id);		
		$spaceData = array_filter($request->all());
		$space->fill($spaceData);
		$space->save();
		return ($url = Session::get('backUrl')) 
		   ? Redirect::to($url) 
		   : Redirect::route('spaces.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Session::has('backUrl')) {
		   Session::keep('backUrl');
		}
		$space = Space::find($id);
		$space->delete();
		return ($url = Session::get('backUrl')) 
		   ? Redirect::to($url) 
		   : Redirect::route('spaces.index');
    }
	
	/**
     * Search the specified space
     *
     *
     */
    public function search(Request $request)
    {
        $keyword = $request->keyword;
		$where = 'CONCAT(ROW, COL)';
		$spaces = Space::where(DB::raw($where),'LIKE', $keyword)
				->orWhere('row', 'LIKE', $keyword)
				->orWhere('col', 'LIKE', $keyword)
				->paginate(50);
		
		Session::flash('backUrl', Re::fullUrl());
		$availabilities = ['all' => 'all', 'reserved' => 'Reserved', 'available' => 'Available', 'not_available' => 'Not Available', 'registered' => 'Registered'];
	
		
		$staff = \Auth::user()->staff;
        return view('pages\spaces', compact('spaces', 'staff', 'availabilities'));  
		
    }
}
