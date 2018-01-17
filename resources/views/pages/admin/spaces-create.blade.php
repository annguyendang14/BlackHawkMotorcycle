@extends('layouts.app')
@section('content')
<div class="container">
	<form action="{{ route('spaces.index') }}" method="POST">
		{!! csrf_field() !!}
		<div class="form-group">
			<label>Row</label>
			<input type="text" name="row" class="form-control" required autofocus>
		</div>
		<div class="form-group">
			<label>Collum</label>
			<input type="text" name="col" class="form-control" required autofocus>
		</div>
		<div class="form-group">
			<label>Price</label>
			<input type="number" name="price" class="form-control" required autofocus>
		</div>
				
		<div class="form-group">
			<button type="submit" class="btn btn-block btn-primary">Add Space</button>
		</div>
		
		
	</form>
</div>
	
@endsection