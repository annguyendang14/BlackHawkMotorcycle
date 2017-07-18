<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;
use App\AddType;

class AddressController extends Controller
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
		if(\Auth::check()) {
            $user = \Auth::user();
			$staff = $user->staff;
			if($staff){
				$addresses = Address::get();				
			}
			else {
				$addresses = $user->address;				
			}
			$addresses = $addresses->sortBy(function($address)
				{
				  return $address->addType;
				});
			return view('pages\address', compact('staff', 'addresses'));
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$user = \Auth::user();
		$addTypes = AddType::get();
        return view('pages\address-create', compact('user', 'addTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['user_id'] = \Auth::user()->id;
		Address::create($request->all());
		return redirect('/users/'.\Auth::user()->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('/users/'.\Auth::user()->id);
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
		$address = Address::find($id);
		if ($user->id == $address->user_id){
			$addTypes = AddType::get();
			return view('pages\address-edit', compact('user', 'address', 'addTypes'));
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
        $address = Address::find($id);
		$request['user_id'] = \Auth::user()->id;
		$addressData = array_filter($request->all());
		$address->fill($addressData);
		$address->save();
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
		//IMPORTANT: this will fail if address attached to an shipping order, but since it not implemented, it should be fine
        $address = Address::find($id);
		$address->delete();
		return redirect('/users/'.\Auth::user()->id);
    }
}
