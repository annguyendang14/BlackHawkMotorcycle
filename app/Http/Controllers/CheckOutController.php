<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Order;
use App\SpaceOrderLine;
use App\Space;
use App\User;

class CheckOutController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('email')){
			$user = User::where('email','=',$request->email)->first();
			if ($user === null){
				$error = array('email' => 'The email entered does not match with any user in the database. Please try again');
				return redirect()->back()->withErrors($error)->withInput();
			}
			
		} else {
			$user = \Auth::user();
		}
		$request['user_id'] = $user->id;
		$request['status'] = "pending";
		$request['total_price'] = Cart::total();
		$request['unpaid_price'] = Cart::total();
		$order = Order::create($request->all());
		
		$cart = Cart::content();
		foreach ($cart as $item){
			SpaceOrderLine::create(array(
			'order_id' => $order->id,
			'space_id' => $item->id,
			'price' => $item->price,
			));
			Space::find($item->id)->update(array('availability' => 'Reserved', 'user_id' => $user->id));
			/* $space = Space::find($item->id);
			$space[availability] = "Reserved";
			$space[user_id] = \Auth::user()->id;
			$space->save(); */
		}
		Cart::destroy();
		Cart::unstore(\Auth::user()->id);
		return redirect('order/'.$order->id);
    }
}
