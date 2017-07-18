@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Profile Update</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="\user\{{ $user->id }}">
                        {{ csrf_field() }}
						<input type="hidden" name="_method" value="PATCH">

                        <div class="form-group{{ $errors->has('firstName') ? ' has-error' : '' }}">
                            <label for="firstName" class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <input id="firstName" type="text" class="form-control" name="firstName" value="{{ $user->firstName }}" required autofocus>

                                @if ($errors->has('firstName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
						<div class="form-group{{ $errors->has('lastName') ? ' has-error' : '' }}">
                            <label for="lastName" class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                <input id="lastName" type="text" class="form-control" name="lastName" value="{{ $user->lastName }}" required autofocus>

                                @if ($errors->has('lastName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
						<div class="form-group{{ $errors->has('middleInitial') ? ' has-error' : '' }}">
                            <label for="middleInitial" class="col-md-4 control-label">Middle Initial</label>

                            <div class="col-md-6">
                                <input id="middleInitial" type="text" class="form-control" name="middleInitial" maxlength="1" value="{{ $user->middleInitial }}" >

                                @if ($errors->has('middleInitial'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('middleInitial') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
						<div class="form-group{{ $errors->has('Nickname') ? ' has-error' : '' }}">
                            <label for="Nickname" class="col-md-4 control-label">Nickname</label>

                            <div class="col-md-6">
                                <input id="Nickname" type="text" class="form-control" name="Nickname" value="{{ $user->Nickname }}" >

                                @if ($errors->has('Nickname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Nickname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
						<div class="form-group{{ $errors->has('CompanyName') ? ' has-error' : '' }}">
                            <label for="CompanyName" class="col-md-4 control-label">Company Name</label>

                            <div class="col-md-6">
                                <input id="CompanyName" type="text" class="form-control" name="CompanyName" value="{{ $user->CompanyName }}" >

                                @if ($errors->has('CompanyName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('CompanyName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						<div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update profile
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection