@extends('layouts.app')
@section('content')
<div class="container">
	<form action="/addresses" method="POST">
		{!! csrf_field() !!}
		<div class="form-group">
			<label>Street line 1</label>
			<input type="text" name="addr1" class="form-control" required autofocus>
		</div>
		<div class="form-group">
			<label>Street line 2</label>
			<input type="text" name="addr2" class="form-control">
		</div>
		<div class="form-group">
			<label>City</label>
			<input type="text" name="city" class="form-control" required autofocus>
		</div>
		<div class="form-group">
			<label>State</label>
			<input type="text" name="state" class="form-control" >
		</div>
		<div class="form-group">
			<label>Country</label>
			<input type="tecouxt" name="country" value="USA" class="form-control" required autofocus>
		</div>
		<div class="form-group">
			<label>Postal Code</label>
			<input type="text" name="postalCode" class="form-control">
		</div>
		
		<div class="form-group">
			<label>Address Type</label>
			<select name="addType">
				@foreach ($addTypes as $addType)
					<option value="{{ $addType->addType }}">{{ $addType->addType }}</option>
				@endforeach
			</select>
		</div>
		
		<div class="form-group">
			<button type="submit" class="btn btn-block btn-primary">Add Address</button>
		</div>
		
		
	</form>
</div>
	
@endsection