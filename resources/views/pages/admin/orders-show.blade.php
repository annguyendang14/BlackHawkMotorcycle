@extends('layouts.app')

@section('content')
	<div class="container">
		<!-- 'paymentType', 'status', 'total_price', 'unpaid_price', 'user_id' -->
		<h2>Order ID: {{ $order->id }}</h2>
		<p><strong>User: </strong>
		@if ($order->user->staff)
			Admin
		@else
			<a href="{{ route('users.show', ['id' => $order->user_id] ) }}">{{ $order->user->email }}</a>
		@endif
		<br />
		<strong>Status: </strong>{{ $order->status }}
		<br />
		<strong>Payment Type: </strong>{{ $order->paymentType }}
		<br />
		<strong>Spaces Quantity: </strong>{{ $order->spaceLine->count() }}
		<br />
		<strong>Total Price: </strong>{{ $order->total_price }}
		<br />
		<strong>Unpaid Price: </strong>{{ $order->unpaid_price }}</p>
		
		<h4>Order Detail</h4>
		<table class="table table-hover table-striped table-border">
			<thead>
				<tr>
					<th>Row</th>
					<th>Collum</th>
					<th>Price</th>					
				</tr>
			</thead>

			<tbody>
				@foreach ($spaceLine as $space)
				<tr>
					<td>{{ $space->space->row }}</td>
					<td>{{ $space->space->col }}</td>
					<td>{{ $space->price }}</td>
					
				</tr>
				@endforeach 
				<tr>
					<td><strong>Total</strong></td>
					<td></td>
					<td>{{ $order->total_price }}</td> 
						{{--- this only valid if the system stay only for space, if implement product, it will fail ---}}
					
				</tr>
			</tbody>
		</table>
	</div>

@endsection