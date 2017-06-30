@extends('layouts.app')
@section('content')
<div class="container">
	<form action="/phones" method="POST">
		{!! csrf_field() !!}
		
		<div class="form-group">
			<label>Phone Number</label>
			<input type="tel" name="number" class="form-control" required autofocus>
		</div>
		
		<div class="form-group">
			<label>Phone Type</label>
			<select name="phoneType">
				@foreach ($phoneTypes as $phoneType)
					<option value="{{ $phoneType->phoneType }}">{{ $phoneType->phoneType }}</option>
				@endforeach
			</select>
		</div>
		
		
		<div class="form-group">
			<button type="submit" class="btn btn-block btn-primary">Add Phone</button>
		</div>
		
		
	</form>
</div>
	
@endsection