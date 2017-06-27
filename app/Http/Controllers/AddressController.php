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
        Address::create($request->all());
		return redirect('addresses');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('addresses');
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
		$addTypes = AddType::get();
		return view('pages\address-edit', compact('user', 'address', 'addTypes'));
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
		$addressData = array_filter($request->all());
		$address->fill($addressData);
		$address->save();
		return redirect('addresses');
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $address = Address::find($id);
		$address->delete();
		return redirect('addresses');
    }
}
