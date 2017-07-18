<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;

class UserController extends Controller
{
    public function __construct()
    {
		$this->middleware('auth');
	}
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        if (\Auth::user()->id == $id){
			$user = User::find($id);
			return view('pages\user-edit', compact('user'));
		} else {
			$eMes = 'You are not authorize to view this page';
			return view('error\custom-error', compact('eMes') );
		}
		
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
        $user = user::find($id);
		//$request['user_id'] = \Auth::user()->id;
		$userData = array_filter($request->all());
		$user->fill($userData);
		$user->save();
		return redirect('/users/'.\Auth::user()->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
	
	public function editPassword($id){
		if (\Auth::user()->id == $id){
			$user = User::find($id);
			return view('pages\user-change-password', compact('user'));
		} else {
			$eMes = 'You are not authorize to view this page';
			return view('error\custom-error', compact('eMes') );
		}
	}
	
	public function updatePassword(Request $request, $id)
	{
	  
		$request_data = $request->All();
		$validator = $this->changePasswordRules($request_data);
		if($validator->fails())
		{
		  return redirect()->back()->withErrors($validator)->withInput();
		}
		else
		{  
		  $current_password = \Auth::user()->password;           
		  if(\Hash::check($request_data['current-password'], $current_password))
		  {        
			$user_id = \Auth::user()->id;                       
			$obj_user = User::find($user_id);
			$obj_user->password = \Hash::make($request_data['password']);;
			$obj_user->save(); 
			return redirect('/users/'.\Auth::user()->id)->with('status','Password changed successfully');
		  }
		  else
		  {           
			$error = array('current-password' => 'Please enter correct current password');
			return redirect()->back()->withErrors($error)->withInput();
		  }
		}
	 
	}
	
	public function changePasswordRules(array $data)
	{
	  $messages = [
		'current-password.required' => 'Please enter current password',
		'password.required' => 'Please enter password',
	  ];

	  $validator = Validator::make($data, [
		'current-password' => 'required',
		'password' => 'required|same:password',
		'password_confirmation' => 'required|same:password',     
	  ], $messages);

	  return $validator;
	}  
}
