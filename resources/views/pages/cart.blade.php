@extends('layouts.app')

@section('content')
<section id="cart_items">
    <div class="container">
        
        <div class="table-responsive cart_info">
            @if(count($cart))
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        
                        <td class="description">Space</td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $item)
                    <tr>
                        <td class="cart_description">
                            <h4>{{$item->name}}</h4>
                        </td>
                        <td class="cart_price">
                            <p>${{$item->price}}</p>
                        </td>
                        <td class="cart_quantity">
                            <p>{{$item->qty}}</p>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">${{$item->subtotal}}</p>
                        </td>
                        <td class="cart_delete col-xs-1">
                            <form class="col-xs-12" action="/cart/{{ $item->rowId }}" method="POST">
								{!! csrf_field() !!}
								<input type="hidden" name="_method" value="DELETE">
								<button type="submit" class="btn btn-link"><i class="fa fa-times"></i></button>
							</form>
                        </td>
                    </tr>
                    @endforeach
					<tr>
						<td><strong>Sub Total:</strong></td>
						<td></td>
						<td></td>						
						<td><strong class="cart_total_price">${{ $subtotal }}</strong></td>
						<td></td>		
						
					</tr>
					<tr>
						<td><strong>Tax:</strong></td>
						<td></td>
						<td></td>						
						<td><strong class="cart_total_price">${{ $tax }}</strong></td>
						<td></td>		
						
					</tr>
					<tr>
						<td><strong>Total:</strong></td>
						<td></td>
						<td></td>						
						<td><strong class="cart_total_price">${{ $total }}</strong></td>
						<td></td>		
						
					</tr>
				</tbody>
			</table>
			<div>
				<form action="/checkout" method="POST">
					{!! csrf_field() !!}
					
					<div class="form-group">
						<label>Payment Type</label>
						<select name="paymentType">
							@foreach ($paymentTypes as $paymentType)
								<option value="{{ $paymentType->paymentType }}">{{ $paymentType->paymentType }}</option>
							@endforeach
						</select>
					</div>
					
					<div class="form-group">
						<button type="submit" class="btn btn-block btn-primary">Check Out</button>
					</div>
					
					
				</form>
			</div>
			@else
			<p>You have no items in the shopping cart</p>
			@endif
                
            
        </div>
    </div>
</section> <!--/#cart_items-->


@endsection