@extends('layouts.app')
@section('content')
<div class="container">
	<form action="{{ route('spaces.update', ['id' => $space->id] ) }}" method="POST">
		{!! csrf_field() !!}
		<input type="hidden" name="_method" value="PATCH">
		<div class="form-group">
			<label>Row</label>
			<input type="text" name="row" class="form-control" value="{{ $space->row }}" required autofocus>
		</div>
		<div class="form-group">
			<label>Collum</label>
			<input type="text" name="col" class="form-control"  value="{{ $space->col }}" required autofocus>
		</div>
		<div class="form-group">
			<label>Note</label>
			<input type="text" name="note" class="form-control" value="{{ $space->note }}"  >
		</div>
		<div class="form-group">
			<label>Price</label>
			<input type="number" name="price" class="form-control"  value="{{ $space->price }}" required autofocus>
		</div>
		<div class="form-group">
			<label>Availability</label>
			<select name="availability">
				@foreach (['Reserved', 'Available', 'Not Available', 'Registered'] as $avaStat)
					@if ($avaStat == $space->availability)
						<option value="{{ $avaStat }}" selected>{{ $avaStat }}</option>
					@else
						<option value="{{ $avaStat }}">{{ $avaStat }}</option>
					@endif
				@endforeach
			</select>
		</div>		
		<div class="form-group">
			<button type="submit" class="btn btn-block btn-primary">Save Edit</button>
		</div>
		
		
	</form>
</div>
	
@endsection