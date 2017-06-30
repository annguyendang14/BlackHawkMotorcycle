<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Phone;
use App\PhoneType;

class PhoneController extends Controller
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
        if(\Auth::check()) {
            $user = \Auth::user();
			$staff = $user->staff;
			if($staff){
				$phones = Phone::get();				
			}
			else {
				$phones = $user->phone;				
			}
			$phones = $phones->sortBy(function($phone)
				{
				  return $phone->phoneType;
				});
			return view('pages\phone', compact('staff', 'phones'));
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
		$phoneTypes = PhoneType::get();
        return view('pages\phone-create', compact('user', 'phoneTypes'));
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
		Phone::create($request->all());
		return redirect('phones');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('phones');
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
		$phone = Phone::find($id);
		$phoneTypes = PhoneType::get();
		return view('pages\phone-edit', compact('user', 'phone', 'phoneTypes'));
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
        $phone = Phone::find($id);
		$request['user_id'] = \Auth::user()->id;
		$phoneData = array_filter($request->all());
		$phone->fill($phoneData);
		$phone->save();
		return redirect('phones');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $phone = Phone::find($id);
		$phone->delete();
		return redirect('phones');
    }
}
