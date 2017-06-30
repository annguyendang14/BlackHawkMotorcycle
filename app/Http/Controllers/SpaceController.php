<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Space;

class SpaceController extends Controller
{
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
        $spaces = Space::orderBy('row', 'asc')->orderBy('col', 'asc')->paginate(50);
		$staff = \Auth::user()->staff;
        return view('pages\spaces', compact('spaces', 'staff'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		
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
        try {
			$request['user_id'] = \Auth::user()->id;
			$space = Space::create($request->all());
			
			return redirect('spaces'); 
		}catch(\Exception $e) {
			$e = 'The space you try to create already exsisted or there are some other errors';
			return view('error\custom-error', compact('e') );
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
		
		$space = Space::find($id);		
		$spaceData = array_filter($request->all());
		$space->fill($spaceData);
		$space->save();
		return redirect('spaces');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $space = Space::find($id);
		$space->delete();
		return redirect('spaces');
    }
}
