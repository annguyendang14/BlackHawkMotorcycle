@extends('layouts.app')

@section('content')
	<div class="container">
		@if (session('status'))
			<div class="alert alert-success">
				{{ session('status') }}
			</div>
		@endif
		<h2>{{ $user->firstName }}'s Profile </h2>
		@include('partials.userbox', ['user' => $user ])
		<h3>Contact Information</h3>
		<div class="address-box panel panel-info">
			<div class="panel-heading" style="overflow: auto">
				@if ($user->id == Auth::user()->id) 
					<a class="btn btn-primary pull-right" href="{{ route('addresses.create') }}">Add new Adresss</a> 
				@endif
				<h5>Addresses</h5>				
			</div>
			<div style="padding-bottom: 15px">
			@foreach ($addresses as $address)
			
				@include('partials.addressbox', ['address' => $address , 'staff' => $staff])
			@endforeach
			</div>
		</div>
		<div class="address-box panel panel-info">
			<div class="panel-heading" style="overflow: auto">
				@if ($user->id == Auth::user()->id) 
					<a class="btn btn-primary pull-right" href="{{ route('phones.create') }}">Add new Number</a> 
				@endif
				<h5>Phones</h5>
			</div>
			<div style="padding-bottom: 15px">
			@foreach ($phones as $phone)
				@include('partials.phonebox', ['phone' => $phone , 'staff' => $staff])
			@endforeach
			</div>
		</div>
	</div>

@endsection