<?php use Carbon\Carbon ; 
use App\User;?>
@extends('layouts.app')

@section('content')
    
	<div class="container">
		
		@if ($staff)
			<a href="{{ route('spaces.create' ) }}" class="btn btn-sm btn-success">
				Create a space
			</a><br />
		@endif
		
		<div class="dropdown">
			<div class="pull-right">
				<form action="{{ route('spaces.search' ) }}" method="GET">
					
					<input type="text" name="keyword">
					<button type="submit" class="btn btn-primary">Search</button>
				</form>
			</div>
			<a href="#" class="dropdown-toggle text-center" style="text-decoration: none" data-toggle="dropdown" role="button" aria-expanded="false">
			View Spaces by availabilities <span class="caret"></span>
			</a>
			<ul class="dropdown-menu">
			
				@foreach ($availabilities as $key => $val)
					<li><a href=" {{ route('spaces.availability', ['id' => $key] ) }}">{{ $val }}</a></li>
					
				@endforeach
			
			</ul>
		</div>
		<!-- 'row', 'col', 'note', 'price', 'availability','user_id' -->
		{{-- LIST ALL THE spaceS --}}
		<table class="table table-hover table-striped table-border">
			<thead>
				<tr>
					<th>Row</th>
					<th>Collum</th>
					<th>Note</th>
					<th>Price</th>
					<th>Availability</th>
					<th>User</th>
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
					<td>{{ $space->availability }}</td>
					@if ($space->user == null)
						<td> </td>
					@elseif ($space->user->staff and !Auth::user()->staff)
						<td>Admin</td>
					@elseif ($staff)
						<td><a href="{{ route('users.show', ['id' => $space->user_id] ) }}">{{ $space->user->email }}</a></td>
					@else
						<td>{{ $space->user->firstName }} {{ $space->user->lastName }}</td>
					@endif
					<td>{{ $space->updated_at->diffForHumans() }}</td>
					
					
					<td>
						<ul class="list-inline list-unstyled">
							<!--<li><a href="/spaces/{{ $space->id }}" class="btn btn-link">View</a></li>-->
							@if ($staff)
								<li><a href="{{ route('spaces.edit', ['id' => $space->id] ) }}" class="btn btn-link">Edit</a></li>

								<li><form class="delete" action="{{ route('spaces.destroy', ['id' => $space->id] ) }}" method="POST">
									{!! csrf_field() !!}
									<input type="hidden" name="_method" value="DELETE">
									<button type="submit" class="btn btn-link">Delete</button>
								</form></li>
							@endif	
							@if($space->availability == 'Available')
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