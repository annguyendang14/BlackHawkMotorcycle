<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;

class UserAdminController extends Controller
{
	public function __construct()
    {
        $this->middleware('staff');
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(50);
        return view('pages\admin\users', compact('users'));
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
		$addresses = $user->address->sortBy(function($address)
			{
			  return $address->addType;
			});
		$phones = $user->phone->sortBy(function($phone)
			{
			  return $phone->phoneType;
			});
		return view('pages\admin\users-show', compact('user', 'addresses', 'phones'));
    }
	
	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('pages\admin\users-create');
    }
	
	/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // create a new user object
		// 'firstName', 'lastName', 'middleInitial', 'Nickname' ,'CompanyName', 'email', 'password',
        $user           = new User;
        $user->firstName     = $request->input('firstName');
		$user->lastName     = $request->input('lastName');
		$user->middleInitial    = $request->input('middleInitial');
		$user->Nickname     = $request->input('Nickname');
		$user->CompanyName    = $request->input('CompanyName');
        $user->email    = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();
        // redirect back to the users list
        return redirect('users');;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
    public function edit($id)
    {
        //
    }/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
    public function update(Request $request, $id)
    {
        //
    }/

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();        
        return redirect('users');
    }
}
