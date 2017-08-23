<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SystemDate;

class SystemDateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('staff');
    }
	
	public function show()
	{
		$currentYear = date('Y');
		$dates = SystemDate::where('year', '=', $currentYear)->first();
		if ($dates == null){
			$eMes = 'System date is corrupted or not available for the current year, please check the database for problem';
			return view('error\custom-error', compact('eMes') );
		} else {
			$current = date_create(date("Y-m-d"));
			$open = date_create($dates->open_register);
			$start = date_create($dates->conference_start);
			$end = date_create($dates->conference_end);
			$sysStat;
			if ($current < $open){
				$sysStat = 'closeRegister';
			} else if ($current < $start){
				$sysStat = 'openRegister';
			} else if ($current < $end){
				$sysStat = 'duringConference';
			} else {
				$sysStat = 'afterConference';
			}
			
			return view('pages\admin\systemdate', compact('dates', 'currentYear', 'sysStat'));
		}
	}
	
	public function update(Request $request)
	{
		$open = date_create($request->open);
		$start = date_create($request->start);
		$end = date_create($request->end);
		$current = date_create(date("Y-m-d"));
		$currentYear = date('Y');
		
		
		$systemdate = SystemDate::where('year', '=', $currentYear)->first();
		
		$preparedError = array("openCurrent" => "Open Registration date is earlier than current date. " , 
		"startCurrent" => "Conference Start date is earlier than current date. " ,		
		"endCurrent" =>	"Conference End date is earlier than current date. " ,	
		"endOrder" => "Conference End date is earlier than Conference Start date." ,
		"startOrder" => "Conference Start date is earlier than Open Registration date.");
	
		$error = array();
		//separate system status - kinda messy code, hope to make a more precise version later
		//after conference end 
		$success = false;
		if ($current > date_create($systemdate->conference_end)){
			$eMes = 'Cannot update System date after the conference has ended';
			return view('error\custom-error', compact('eMes') );
		}
		//during conference
		else if ($current > date_create($systemdate->conference_start)) {
			if ($end < $current){
				$error["end"] = $preparedError["endCurrent"];
			} else {
				$systemdate->conference_end = $end;
				$systemdate->save();
				$success = true;
			}
		}
		//durring open registration
		else if ($current > date_create($systemdate->open_register)) {
			$checkEnd = false;
			$checkStart = false;
			if ($end < $current){
				$error["end"] = $preparedError["endCurrent"];
			} else if ($end < $start) {
				$error["end"] = $preparedError["endOrder"];
			} else {
				$checkEnd = true;
			}
			
			if ($start < $current) {
				$error["start"] = $preparedError["startCurrent"];
			} else {
				$checkStart = true;
			}
			
			if ($checkEnd and $checkStart){
				$systemdate->conference_end = $end;
				$systemdate->conference_start = $start;
				$systemdate->save();
				$success = true;
			}				
			
		
		} 
		//before open registration
		else {
			$checkEnd = false;
			$checkStart = false;
			$checkOpen = false;
			
			if ($end < $current){
				$error["end"] = $preparedError["endCurrent"];
			} else if ($end < $start) {
				$error["end"] = $preparedError["endOrder"];
			} else {
				$checkEnd = true;
			}
			
			if ($start < $current){
				$error["start"] = $preparedError["startCurrent"];
			} else if ($start < $open) {
				$error["start"] = $preparedError["startOrder"];
			} else {
				$checkStart = true;
			}
			
			if ($open < $current){
				$error["open"] = $preparedError["openCurrent"];
			} else {
				$checkOpen = true;
			}
			
			if ($checkEnd and $checkOpen and $checkStart){
				$systemdate->conference_end = $end;
				$systemdate->conference_start = $start;
				$systemdate->open_register = $open;
				$systemdate->save();
				$success = true;
			}
			
			
		}  
		
		
		if ($success){
			return redirect()->back()->with('status','System Date changed successfully');
		} else {
			return redirect()->back()->withErrors($error)->withInput(); 
		}
		
		
	}
}
