<?php use Carbon\Carbon ; 
use App\User;?>
@extends('layouts.app')

@section('content')
    
	<div class="container">
		@if ($staff)
			<a href="/spaces/create" class="btn btn-sm btn-success">
				Create a space
			</a>
		@endif
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
					@if ($space->user->staff)
						<td>Admin</td>
					@else
						<td><a href="/users/{{ $space->user_id }}">{{ $space->user->email }}</a></td>
					@endif
					<td>{{ $space->updated_at->diffForHumans() }}</td>
					
					
					<td>
						<ul class="list-inline list-unstyled">
							<!--<li><a href="/spaces/{{ $space->id }}" class="btn btn-link">View</a></li>-->
							@if ($staff)
								<li><a href="/spaces/{{ $space->id }}/edit" class="btn btn-link">Edit</a></li>

								<li><form action="/spaces/{{ $space->id }}" method="POST">
									{!! csrf_field() !!}
									<input type="hidden" name="_method" value="DELETE">
									<button type="submit" class="btn btn-link">Delete</button>
								</form></li>
							@endif
						</ul>
					</td>
				</tr>
				@endforeach 
			</tbody>
		</table>
		<div class="text-center">{{ $spaces->links() }}<div>
	</div>

@endsection