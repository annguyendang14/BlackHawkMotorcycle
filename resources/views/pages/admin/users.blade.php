<?php use Carbon\Carbon ; ?>
@extends('layouts.app')

@section('content')
    
	<div class="container">
		<div class="pull-right">
			<form action="/users/search" method="GET">
				
				<input type="text" name="keyword">
				<button type="submit" class="btn btn-primary">Search</button>
			</form>
		</div>
		<a href="/users/create" class="btn btn-sm btn-success">
			Create a User
		</a>

		{{-- LIST ALL THE USERS --}}
		<table class="table table-hover table-striped table-border">
			<thead>
				<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Middle</th>
					<th>Nickname</th>
					<th>Company Name</th>
					<th>Email</th>
					<th>Joined</th>
					<th></th>
				</tr>
			</thead>

			<tbody>
				@foreach ($users as $user)
				<tr>
					<td>{{ $user->firstName }}</td>
					<td>{{ $user->lastName }}</td>
					<td>{{ $user->middleInitial }}</td>
					<td>{{ $user->Nickname }}</td>
					<td>{{ $user->CompanyName }}</td>
					<td>{{ $user->email }}</td>
					<td>{{ $user->created_at->diffForHumans() }}</td>
					<td>
						<ul class="list-inline list-unstyled">
							<li><a href="/users/{{ $user->id }}" class="btn btn-link">View</a></li>
							<!--<li><a href="/users/{{ $user->id }}/edit" class="btn btn-link">Edit</a></li>-->

							<li><form class="delete" action="/users/{{ $user->id }}" method="POST">
								{!! csrf_field() !!}
								<input type="hidden" name="_method" value="DELETE">
								<button type="submit" class="btn btn-link">Delete</button>
							</form></li>
						</ul>
					</td>
				</tr>
				@endforeach 
				
			</tbody>
		</table>
		<div class="text-center">{{ $users->appends(Request::except('page'))->links() }}<div>
	</div>
	

@endsection