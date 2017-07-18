@extends('layouts.app')

@section('content')
	
	<form id="form-change-password" role="form" method="POST" action="\user\password_change\{{ $user->id }}" novalidate class="form-horizontal">
		 {{ csrf_field() }}
		 <input type="hidden" name="_method" value="PATCH">
	  <div class="col-md-9">             
		<label for="current-password" class="col-sm-4 control-label">Current Password</label>
		<div class="col-sm-8">
		  <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}"> 
			<input type="password" class="form-control" id="current-password" name="current-password" placeholder="Password">
			@if ($errors->has('current-password'))
				<span class="help-block">
					<strong>{{ $errors->first('current-password') }}</strong>
				</span>
			@endif
		  </div>
		</div>
		<label for="password" class="col-sm-4 control-label">New Password</label>
		<div class="col-sm-8">
		  <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
			<input type="password" class="form-control" id="password" name="password" placeholder="Password">
			@if ($errors->has('password'))
				<span class="help-block">
					<strong>{{ $errors->first('password') }}</strong>
				</span>
			@endif
		  </div>
		</div>
		<label for="password_confirmation" class="col-sm-4 control-label">Re-enter Password</label>
		<div class="col-sm-8">
		  <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
			<input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Re-enter Password">
			@if ($errors->has('password_confirmation'))
				<span class="help-block">
					<strong>{{ $errors->first('password_confirmation') }}</strong>
				</span>
			@endif
		  </div>
		</div>
	  </div>
	  
	  <div class="form-group">
		<div class="col-sm-offset-5 col-sm-6">
		  <button type="submit" class="btn btn-primary">Submit</button>
		  
		</div>
	  </div>
	</form>


@endsection