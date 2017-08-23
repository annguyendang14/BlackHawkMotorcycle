<?php use Carbon\Carbon ; 
use App\User;?>
@extends('layouts.app')

@section('content')
    
	<div class="container">
		
		
		<!-- 'row', 'col', 'note', 'price', 'availability','user_id' -->
		{{-- LIST ALL THE spaceS --}}
		<table class="table table-hover table-striped table-border">
			<thead>
				<tr>
					<th>Row</th>
					<th>Collum</th>
					<th>Note</th>
					<th>Price</th>
					<th>Last Updated</th>
					<th></th>
				</tr>
			</thead>

			<tbody>
				@foreach ($spaces as $space)
				<tr>
					<td>{{ $space->row }}</td>
					<td>{{ $space->col }}</td>
					<td>{{ $space->note }}</td>
					<td>{{ $space->price }}</td>
					
					<td>{{ $space->updated_at->diffForHumans() }}</td>
					
					
					<td>
						<ul class="list-inline list-unstyled">
							<!--<li><a href="/spaces/{{ $space->id }}" class="btn btn-link">View</a></li>-->
							
							
							@if( ! Cart::checkById($space->id))
								<li>
									<form method="POST" action="{{url('cart')}}">
										<input type="hidden" name="space_id" value="{{$space->id}}">
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<button type="submit" class="btn btn-fefault add-to-cart">
											<i class="fa fa-shopping-cart"></i>
											Add to cart
										</button>
									</form>
								</li>
							@else 
								<li>
									<button type="button" class="btn btn-default" disabled="disabled"><i class="fa fa-shopping-cart"></i>
											Added to cart</button>
								</li>
							@endif
							
						</ul>
					</td>
				</tr>
				@endforeach 
			</tbody>
		</table>
		<div class="text-center">{{ $spaces->appends(Request::except('page'))->links() }}<div>
	</div>

@endsection