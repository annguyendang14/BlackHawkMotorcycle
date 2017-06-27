@extends('layouts.app')
@section('content')
<div class="container">
	<form action="/phones/{{ $phone->id }}" method="POST">
		{!! csrf_field() !!}
		
		<input type="hidden" name="_method" value="PATCH">
		
		<div class="form-group">
			<label>Number</label>
			<input type="text" name="number" class="form-control" value="{{ $phone->number }}"  required autofocus>
		</div>
		
		<div class="form-group">
			<label>Phone Type</label>
			<select name="phoneType">
				@foreach ($phoneTypes as $phoneType)
					@if ($phoneType->phoneType == $phone->phoneType)
						<option value="{{ $phoneType->phoneType }}" selected>{{ $phoneType->phoneType }}</option>
					@else
						<option value="{{ $phoneType->phoneType }}">{{ $phoneType->phoneType }}</option>
					@endif
				@endforeach
			</select>
		</div>
		
		<div class="form-group">
			<input type="hidden" name="user_id" class="form-control" value={{ $user->id }} >
		</div>
		
		<div class="form-group">
			<button type="submit" class="btn btn-block btn-primary">Submit Edit</button>
		</div>
		
		
	</form>
</div>
	
@endsection