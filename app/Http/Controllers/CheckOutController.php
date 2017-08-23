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
		
		//check the availability of each space
		$cart = Cart::content();
		$invalidSpace = "";
		$itemIds = [];
		foreach ($cart as $item){
			$itemIds[] = $item->id;
			
		}
		$spaces = Space::whereIn('id', $itemIds)->get();
		foreach ($spaces as $space){
			if (!($space->availability == "Available" or ($space->availability == "Not Available" and $space->user_id == \Auth::user()->id))) {
				$invalidSpace = $invalidSpace . $space->row . $space->col . ", ";
			}
			
		}
		if ($invalidSpace != ""){
			$invalidSpace = 'Spaces (' . substr($invalidSpace,0,-2) . ') are invalid for check out, please remove them from the cart and try again';
			$error = array('general' => $invalidSpace);
			return redirect()->back()->withErrors($error)->withInput(); 
		}
		
		$request['user_id'] = $user->id;
		$request['status'] = "pending";
		$request['total_price'] = Cart::total();
		$request['unpaid_price'] = Cart::total();
		$order = Order::create($request->all());
		
		
		foreach ($cart as $item){
			SpaceOrderLine::create(array(
			'order_id' => $order->id,
			'space_id' => $item->id,
			'price' => $item->price,
			));
			Space::find($item->id)->update(array('availability' => 'Reserved', 'user_id' => $user->id));
			
		}
		Cart::destroy();
		Cart::unstore(\Auth::user()->id);
		return redirect('order/'.$order->id);
    }
}
