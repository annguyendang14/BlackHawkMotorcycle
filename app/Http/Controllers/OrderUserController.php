<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class OrderUserController extends Controller
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
        
		$user = \Auth::user();
		if ($user->staff){
			return view('error\404');
		}
		$userId = $user->id;
		$orders = Order::where('user_id', '=', $userId)->orderBy('updated_at', 'des')->paginate(50);
			
		
		return view('pages\admin\orders', compact('orders')); 
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
        $order = Order::find($id);
		if ($order->user_id == \Auth::user()->id){
			$spaceLine = $order->spaceLine->sortBy(function($spaceLine)
				{
				  return $spaceLine->id;
				});
				
			$productLine = $order->productLine->sortBy(function($productLine)
				{
				  return $productLine->id;
				});
			return view('pages\admin\orders-show', compact('order', 'spaceLine', 'productLine'));
		} else {
			
			return view('error\404');
		}
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
