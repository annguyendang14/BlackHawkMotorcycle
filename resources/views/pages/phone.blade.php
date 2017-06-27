@extends('layouts.app')
@section('content')
	
	<div class="container">
		@if (!$staff) 
			<a class="btn btn-primary" href="{{ route('phones.create') }}">Add new Phone Number</a> 
			<br /><br />
		@endif
		<div class="panel-group">
			@foreach ($phones as $phone)
				@include('partials.phonebox', ['phone' => $phone , 'staff' => $staff])
			@endforeach
		</div>
	</div>
@endsection