@extends('layouts.app')
@section('content')
<div class="container">
	<h2>Order ID: {{ $order->id }}</h2>
	<form action="{{ route('orders-admin.update', ['id' => $order->id] ) }}" method="POST">
		{!! csrf_field() !!}
		
		<input type="hidden" name="_method" value="PATCH">
		
		
		
		<div class="form-group">
			<label>Payment Type</label>
			<select name="paymentType">
				@foreach ($paymentTypes as $paymentType)
					@if ($paymentType->paymentType == $order->paymentType)
						<option value="{{ $paymentType->paymentType }}" selected>{{ $paymentType->paymentType }}</option>
					@else
						<option value="{{ $paymentType->paymentType }}">{{ $paymentType->paymentType }}</option>
					@endif
				@endforeach
			</select>
		</div>
		
		<div class="form-group">
			<label>Status</label>
			<select name="status">
				@foreach ($statuses as $status)
					@if ($status == $order->status)
						<option value="{{ $status }}" selected>{{ $status }}</option>
					@else
						<option value="{{ $status }}">{{ $status }}</option>
					@endif
				@endforeach
			</select>
		</div>
		
		<div class="form-group">
			<label>Total Price</label>
			<input class="form-control" id="disabledInput" type="text" value="{{ $order->total_price }}" disabled>
		</div>
		
		<div class="form-group">
			<label>Unpaid Price</label>
			<input type="number" step="0.01" min="0" max="{{ $order->total_price }}" name="unpaid_price" class="form-control" value="{{ $order->unpaid_price }}" required autofocus>
		</div>
		
		<div class="form-group">
			<button type="submit" class="btn btn-block btn-primary">Submit Edit</button>
		</div>
		
		
	</form>
</div>
	
@endsection