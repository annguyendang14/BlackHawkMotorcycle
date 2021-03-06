<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\User;
use App\PaymentType;
use Session;
use Redirect;
use Request as Re;

class OrderAdminController extends Controller
{
    
	public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('staff')->except(['show']);
    }
	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		/* $statuses = array('all','pending', 'void', 'authorized', 'ready_for_shipment', 'enroute', 'paid', 'confirmed', 'refunded', 'payment_declined', 'shipped', 'archived', 'awaiting_payment', 'partial_payment'); //this array need to be fixed in both index and indexStat, edit
		return view('pages\admin\orders-index', compact('statuses'));  */
		return redirect('orders-admin/status/all');
	}
	
	/**
     * Display a listing of the resource base on status
     *
     * @return \Illuminate\Http\Response
     */
    public function indexStat($status)
    {
        Session::flash('backUrl', Re::fullUrl());
		$statuses = array('all','pending', 'void', 'authorized', 'ready_for_shipment', 'enroute', 'paid', 'confirmed', 'refunded', 'payment_declined', 'shipped', 'archived', 'awaiting_payment', 'partial_payment', 'cancelled');
	
		//using AJAX later maybe, not for initial testing
		if (! in_array($status, $statuses)){
			
			$eMes = 'The status is invalid';
			return view('error\custom-error', compact('eMes') );
		} elseif ($status == 'all') {
			$orders = Order::orderBy('updated_at', 'des')->paginate(50);
			
		} else {
			$orders = Order::where('status', '=', $status)->orderBy('updated_at', 'des')->paginate(50);
			
		}
		return view('pages\admin\orders', compact('orders','status','statuses')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // - it probably best to leave it here for now
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // - it probably best to leave it here for now
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
		$spaceLine = $order->spaceLine->sortBy(function($spaceLine)
			{
			  return $spaceLine->id;
			});
			
		$productLine = $order->productLine->sortBy(function($productLine)
			{
			  return $productLine->id;
			});
		return view('pages\admin\orders-show', compact('order', 'spaceLine', 'productLine'));
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
		$order = order::find($id);
		$paymentTypes = PaymentType::get();
		$statuses = array('pending', 'void', 'authorized', 'ready_for_shipment', 'enroute', 'paid', 'confirmed', 'refunded', 'payment_declined', 'shipped', 'archived', 'awaiting_payment', 'partial_payment', 'cancelled');
		return view('pages\admin\orders-edit', compact('user', 'order', 'paymentTypes','statuses'));
	
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
        if (Session::has('backUrl')) {
		   Session::keep('backUrl');
		}
		
		$order = order::find($id);		
		
		
		if ($request->status == 'paid'){
			$spaceLines = $order->spaceLine;
			foreach ($spaceLines as $spaceLine){
				$spaceLine->space->update(array('availability' => 'Registered'));
			}
		} elseif ($request->status == 'cancel' or $request->status == 'void' or $request->status == 'refunded' ){
			$spaceLines = $order->spaceLine;
			foreach ($spaceLines as $spaceLine){
				$spaceLine->space->update(array('availability' => 'Available'));
			}
		}
		//more to come when mock test with client
		
		if ($request->unpaid_price == 0){
			$request['unpaid_price'] = "00";
		}
		$orderData = array_filter($request->all());
		$order->fill($orderData);
		$order->save();
		return ($url = Session::get('backUrl')) 
		   ? Redirect::to($url) 
		   : Redirect::route('orders-admin.index'); 
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
	
	/**
     * Search the specified user
     *
     *
     */
    public function search(Request $request)
    {
        $keyword = $request->keyword;
		
		$orders = Order::whereIn('user_id', function($query) use ($keyword){
						$query->select('id')
						->from(with(new User)->getTable())
						->where('email','LIKE','%'.$keyword.'%');
					})
					->orwhere('id','=',$keyword)					
					->paginate(50);
		
		$statuses = array('all','pending', 'void', 'authorized', 'ready_for_shipment', 'enroute', 'paid', 'confirmed', 'refunded', 'payment_declined', 'shipped', 'archived', 'awaiting_payment', 'partial_payment', 'cancelled');
		$status = 'all';
		return view('pages\admin\orders', compact('orders','status','statuses')); 
    }
}
