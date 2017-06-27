@extends('layouts.app')
@section('content')
	
	<div class="container">
		@if (!$staff) 
			<a class="btn btn-primary" href="{{ route('addresses.create') }}">Add new Adresss</a> 
			<br /><br />
		@endif
		<div class="panel-group">
			@foreach ($addresses as $address)
				@include('partials.addressbox', ['address' => $address , 'staff' => $staff])
			@endforeach
		</div>
	</div>
@endsection