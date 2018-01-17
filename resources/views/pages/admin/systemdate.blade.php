@extends('layouts.app')

@section('content')
	<div class="container">
		@if (session('status'))
			<div class="alert alert-success">
				{{ session('status') }}
			</div>
		@endif
	<form action="{{ route('systemdate') }}" method="POST">
		{!! csrf_field() !!}
		<input type="hidden" name="_method" value="PATCH">
		<div class="form-group{{ $errors->has('open') ? ' has-error' : '' }}">
			<label>Open Registration</label>
			@if ($sysStat == 'closeRegister')
				<input type="date" name="open" class="form-control" value="{{ old('open') ? old('open') : $dates->open_register }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" max="{{ $currentYear }}-12-31" required autofocus>
				
			@else 
				<input type="date" name="open" class="form-control" value="{{ $dates->open_register }}" disabled >
			@endif
			@if ($errors->has('open'))
					<span class="help-block">
						<strong>{{ $errors->first('open') }}</strong>
					</span>
				@endif
		</div>
		
		<div class="form-group{{ $errors->has('start') ? ' has-error' : '' }}">
			<label>Conference Start</label>
			@if ($sysStat == 'closeRegister' or $sysStat == 'openRegister')
				<input type="date" name="start" class="form-control" value="{{ old('start') ? old('start') : $dates->conference_start }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" max="{{ $currentYear }}-12-31" required autofocus>
				
			@else 
				<input type="date" name="start" class="form-control" value="{{ $dates->conference_start }}" disabled >
			@endif
			@if ($errors->has('start'))
					<span class="help-block">
						<strong>{{ $errors->first('start') }}</strong>
					</span>
				@endif
		</div>
		
		<div class="form-group{{ $errors->has('end') ? ' has-error' : '' }}">
			<label>Conference End</label>
			@if ($sysStat != 'afterConference')
				<input type="date" name="end" class="form-control" value="{{ old('end') ? old('end') : $dates->conference_end }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" max="{{ $currentYear }}-12-31" required autofocus>
				
			@else 
				<input type="date" name="end" class="form-control" value="{{ $dates->conference_end }}" disabled >
			@endif
			@if ($errors->has('end'))
					<span class="help-block">
						<strong>{{ $errors->first('end') }}</strong>
					</span>
				@endif
		</div>	
		
		<div class="form-group">
			@if ($sysStat != 'afterConference')
				<button type="submit" class="btn btn-block btn-primary">Save new system date</button>
			@else
				<button disabled class="btn btn-block btn-primary">Save new system date</button>
			@endif
		</div>
		
		
	</form>
</div>
@endsection