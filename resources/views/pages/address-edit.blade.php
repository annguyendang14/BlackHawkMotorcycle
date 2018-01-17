@extends('layouts.app')
@section('content')
<div class="container">
	<form action="{{ route('addresses.update', ['id' => $address->id] ) }}" method="POST">
		{!! csrf_field() !!}
		
		<input type="hidden" name="_method" value="PATCH">
		
		<div class="form-group">
			<label>Street line 1</label>
			<input type="text" name="addr1" class="form-control" value="{{ $address->addr1 }}" required autofocus>
		</div>
		<div class="form-group">
			<label>Street line 2</label>
			<input type="text" name="addr2" class="form-control" value="{{ $address->addr2 }}" >
		</div>
		<div class="form-group">
			<label>City</label>
			<input type="text" name="city" class="form-control"  value="{{ $address->city }}" required autofocus>
		</div>
		<div class="form-group">
			<label>State</label>
			<input type="text" name="state" class="form-control"  value="{{ $address->state }}" >
		</div>
		<div class="form-group">
			<label>Country</label>
			<input type="text" name="country" class="form-control" value="{{ $address->country }}"  required autofocus>
		</div>
		<div class="form-group">
			<label>Postal Code</label>
			<input type="text" name="postalCode" class="form-control"  value="{{ $address->postalCode }}" >
		</div>
		
		<div class="form-group">
			<label>Address Type</label>
			<select name="addType">
				@foreach ($addTypes as $addType)
					@if ($addType->addType == $address->addType)
						<option value="{{ $addType->addType }}" selected>{{ $addType->addType }}</option>
					@else
						<option value="{{ $addType->addType }}">{{ $addType->addType }}</option>
					@endif
				@endforeach
			</select>
		</div>
		
		
		<div class="form-group">
			<button type="submit" class="btn btn-block btn-primary">Submit Edit</button>
		</div>
		
		
	</form>
</div>
	
@endsection