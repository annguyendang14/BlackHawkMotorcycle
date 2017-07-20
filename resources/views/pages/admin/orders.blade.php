<?php use Carbon\Carbon ; 
use App\User;?>
@extends('layouts.app')

@section('content')
    
	<div class="container">
		<div class="pull-right">
			<form action="/orders-admin/search" method="GET">
				
				<input type="text" name="keyword">
				<button type="submit" class="btn btn-primary">Search</button>
			</form>
		</div>
		<div class="dropdown">
			<a href="#" class="dropdown-toggle text-center" style="text-decoration: none" data-toggle="dropdown" role="button" aria-expanded="false">
			View Orders by status <span class="caret"></span>
			</a>
			<ul class="dropdown-menu">
			
				@foreach ($statuses as $status1)
					<li><a href="/orders-admin/status/{{ $status1 }}">{{ $status1 }}</a></li>
					
				@endforeach
			
			</ul>
		</div>
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
					
					<td><a href="/users/{{ $order->user_id }}">{{ $order->user->email }}</a></td>
					
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