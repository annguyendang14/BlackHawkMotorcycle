<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Request as Re;
use Illuminate\Support\Facades\Redirect;
use Cart;
use App\Space;
use App\PaymentType;

class CartController extends Controller
{
    public function addToCart() {
		if (Re::isMethod('post')) {
			$space_id = Re::get('space_id');
			$space = Space::find($space_id);
			$name = $space->row . $space->col;
			
			//check if the space already added to cart
			//Cart::restore(\Auth::user()->id);
			$cart = Cart::content();
			
			if (! Cart::checkById($space->id)){
				Cart::add(array('id' => $space_id, 'name' => $name, 'qty' => 1, 'price' => $space->price));
				
				Cart::store(\Auth::user()->id);
				
			}
		}


		//return view('cart', array('cart' => $cart, 'title' => 'Welcome', 'description' => '', 'page' => 'home'));
		return back();
	}
	
	public function show() {
		
		$cart = Cart::content();
		$subtotal = Cart::subtotal();
		$tax = Cart::tax();
		$total = Cart::total();
		$paymentTypes = PaymentType::get();
		
		Cart::store(\Auth::user()->id);
		
		return view('pages\cart', compact('cart', 'subtotal', 'tax', 'total', 'paymentTypes'));
	}
	
	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
		Cart::remove($id);
		
		Cart::store(\Auth::user()->id);
		
		return redirect('cart');
	}
	
}
