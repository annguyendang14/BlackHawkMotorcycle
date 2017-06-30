<div class="form-group{{ $errors->has('firstName') ? ' has-error' : '' }}">
                            <label for="firstName" class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <input id="firstName" type="text" class="form-control" name="firstName" value="{{ old('firstName') }}" required autofocus>

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
                                <input id="lastName" type="text" class="form-control" name="lastName" value="{{ old('lastName') }}" required autofocus>

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
                                <input id="middleInitial" type="text" class="form-control" name="middleInitial" maxlength="1" value="{{ old('middleInitial') }}" >

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
                                <input id="Nickname" type="text" class="form-control" name="Nickname" value="{{ old('Nickname') }}" >

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
                                <input id="CompanyName" type="text" class="form-control" name="CompanyName" value="{{ old('CompanyName') }}" >

                                @if ($errors->has('CompanyName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('CompanyName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        