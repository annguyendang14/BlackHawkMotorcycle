<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;

class UserAdminController extends Controller
{
	public function __construct()
    {
        $this->middleware('staff')->except(['show']);
		$this->middleware('auth');
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
        $currentUser = \Auth::user();
		if ($currentUser->staff){
			$user = User::find($id);
		} elseif ($currentUser->id == $id){
			$user = $currentUser;
		} else {
			$eMes = 'You are not authorize to view this page';
			return view('error\custom-error', compact('eMes') );
		}
		$staff = $currentUser->staff;
		$addresses = $user->address->sortBy(function($address)
			{
			  return $address->addType;
			});
		$phones = $user->phone->sortBy(function($phone)
			{
			  return $phone->phoneType;
			});
		return view('pages\users-show', compact('user', 'addresses', 'phones', 'staff'));
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
        $this->validate($request, [
			'firstName' => 'required|string|max:255',
			'lastName' => 'required|string|max:255',
			'middleInitial' => 'nullable|string|max:1',
			'Nickname' => 'nullable|string|max:255',
			'CompanyName' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
		]);
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
	
	/**
     * Search the specified user
     *
     *
     */
    public function search(Request $request)
    {
        $keyword = $request->keyword;
		
		$users = User::where('firstName','LIKE','%'.$keyword.'%')
					->orwhere('lastName','LIKE','%'.$keyword.'%')
					->orwhere('email','LIKE','%'.$keyword.'%')
					->orwhere('middleInitial','LIKE','%'.$keyword.'%')
					->orwhere('Nickname','LIKE','%'.$keyword.'%')
					->orwhere('CompanyName','LIKE','%'.$keyword.'%')
					->paginate(50);
		
		return view('pages\admin\users', compact('users'));
		
    }
	
	/**
     * toggle user staff status
     *
     *
     */
    public function toggleStaffStatus(Request $request, $id){
		$user = User::find($id);
		$staff = $user->staff;
		$user->staff = !$staff;
		$user->save();
		return \Redirect::back();
	}
	
	/**
     * toggle user active status
     *
     *
     */
    public function toggleActiveStatus(Request $request, $id){
		$user = User::find($id);
		$active = $user->active;
		$user->active = !$active;
		$user->save();
		return \Redirect::back();
	}
}
