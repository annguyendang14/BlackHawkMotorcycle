<?php use Carbon\Carbon ; 
use App\User;?>
@extends('layouts.app')

@section('content')
    
	<div class="container">
		<h1>{{ ucfirst($status) }} Orders</h1>
		
		<!-- <a href="/orders-admin/create" class="btn btn-sm btn-success">
			Create a order
		</a> -->
		
		
		{{-- LIST ALL THE orderS --}}
		<table class="table table-hover table-striped table-border">
			<thead>
				<tr>
					<th>Order ID</th>
					<th>Status</th>
					<th>User</th>
					<th>Payment Type</th>
					<th>Spaces Quantity</th>
					<th>Total Price</th>
					<th>Unpaid Price</th>
					<th>Last Updated</th>
					<th></th>
				</tr>
			</thead>

			<tbody>
				@foreach ($orders as $order)
				<tr>
					<td>{{ $order->id }}</td>
					<td>{{ $order->status }}</td>
					@if ($order->user->staff)
						<td>Admin</td>
					@else
						<td><a href="/users/{{ $order->user_id }}">{{ $order->user->email }}</a></td>
					@endif
					<td>{{ $order->paymentType }}</td>
					<td>{{ $order->spaceLine->count() }}</td>
					<td>{{ $order->total_price }}</td>
					<td>{{ $order->unpaid_price }}</td>
					
					<td>{{ $order->updated_at->diffForHumans() }}</td>
					
					
					<td>
						<ul class="list-inline list-unstyled">
							<li><a href="/orders-admin/{{ $order->id }}" class="btn btn-link">View</a></li>
							
							<li><a href="/orders-admin/{{ $order->id }}/edit" class="btn btn-link">Edit</a></li>

							<!--<li><form action="/orders-admin/{{ $order->id }}" method="POST">
								{!! csrf_field() !!}
								<input type="hidden" name="_method" value="DELETE">
								<button type="submit" class="btn btn-link">Delete</button>
							</form></li>-->
							
						</ul>
					</td>
				</tr>
				@endforeach 
			</tbody>
		</table>
		<div class="text-center">{{ $orders->links() }}<div>
	</div>

@endsection