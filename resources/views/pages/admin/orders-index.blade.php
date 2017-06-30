<?php use Carbon\Carbon ; 
use App\User;?>
@extends('layouts.app')

@section('content')
    
	<div class="container">
		
		<div class="dropdown">
			<a href="#" class="dropdown-toggle text-center" style="text-decoration: none" data-toggle="dropdown" role="button" aria-expanded="false">
			View Orders by status <span class="caret"></span>
			</a>
			<ul class="dropdown-menu">
			
				@foreach ($statuses as $status)
					<li><a href="/orders-admin/status/{{ $status }}">{{ $status }}</a></li>
					
				@endforeach
			
			</ul>
		</div>
	
	</div>

@endsection