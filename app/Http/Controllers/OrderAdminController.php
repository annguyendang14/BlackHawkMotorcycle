<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\PaymentType;
use Session;
use Redirect;
use Request as Re;

class OrderAdminController extends Controller
{
    
	public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('staff');
    }
	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$statuses = array('all','pending', 'void', 'authorized', 'ready_for_shipment', 'enroute', 'paid', 'confirmed', 'refunded', 'payment_declined', 'shipped', 'archived', 'awaiting_payment', 'partial_payment'); //this array need to be fixed in both index and indexStat, edit
		return view('pages\admin\orders-index', compact('statuses')); 
	}
	
	/**
     * Display a listing of the resource base on status
     *
     * @return \Illuminate\Http\Response
     */
    public function indexStat($status)
    {
        Session::flash('backUrl', Re::fullUrl());
		$statuses = array('all','pending', 'void', 'authorized', 'ready_for_shipment', 'enroute', 'paid', 'confirmed', 'refunded', 'payment_declined', 'shipped', 'archived', 'awaiting_payment', 'partial_payment');
	
		//using AJAX later maybe, not for initial testing
		if (! in_array($status, $statuses)){
			return 'the status is invalid';
		} elseif ($status == 'all') {
			$orders = Order::orderBy('updated_at', 'asc')->paginate(50);
			return view('pages\admin\orders', compact('orders','status')); 
		} else {
			$orders = Order::where('status', '=', $status)->orderBy('updated_at', 'asc')->paginate(50);
			return view('pages\admin\orders', compact('orders','status')); 
		}
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
		$statuses = array('pending', 'void', 'authorized', 'ready_for_shipment', 'enroute', 'paid', 'confirmed', 'refunded', 'payment_declined', 'shipped', 'archived', 'awaiting_payment', 'partial_payment');
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
}
