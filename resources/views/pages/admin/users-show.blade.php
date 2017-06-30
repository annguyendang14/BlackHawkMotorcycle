@extends('layouts.app')

@section('content')
	<div class="container">
		<h2>{{ $user->firstName }}'s Profile </h2>
		@include('partials.userbox', ['user' => $user ])
		<h3>Contact Information</h3>
		@foreach ($addresses as $address)
			@include('partials.addressbox', ['address' => $address , 'staff' => 1])
		@endforeach
		@foreach ($phones as $phone)
			@include('partials.phonebox', ['phone' => $phone , 'staff' => 1])
		@endforeach
	</div>

@endsection