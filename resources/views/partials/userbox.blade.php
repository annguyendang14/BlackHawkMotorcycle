<div class="user-box panel panel-info">
	<!-- 'firstName', 'lastName', 'middleInitial', 'Nickname' ,'CompanyName', 'email', 'password', -->
    <div class="panel-heading">Personal Information</div>
    <div class="panel-body">
		<span>First Name: {{ $user->firstName }}</span><br />
		<span>Last Name: {{ $user->lastName }}</span><br />
		<span>Middle Initial: {{ $user->middleInitial }}</span><br />
		<span>Nickname: {{ $user->Nickname }}</span><br />
		<span>Company Name: {{ $user->CompanyName }}</span><br />
		<span>Email: {{ $user->email }}</span><br />
		<span>Status:
			@if ($user->active)
				Active
			@else
				Inactive
			@endif
			@if ($user->staff)
				, Staff
			@endif
		</span><br />
		@if ($user->id == Auth::user()->id)
		
		
			<ul class="list-inline list-unstyled " style="margin-bottom: 0" >
				<li><a class="btn btn-primary" href="{{ route('user.edit', ['id' => $user->id] ) }}">Edit profile</a></li>
				<li><a class="btn btn-primary" href="{{ route('user.password', ['id' => $user->id] ) }}">Change Password</a></li>
				
			</ul>
		@endif
		@if (Auth::user()->staff)
			
			<ul class="list-inline list-unstyled " style="margin-bottom: 0" >
				<li><form class="togglestaff" action="{{ route('users.togglestaff', ['id' => $user->id] ) }}" method="POST">
					{!! csrf_field() !!}
					<input type="hidden" name="_method" value="PATCH">
					<button type="submit" class="btn btn-primary">
						@if (!$user->staff)
							Set as Staff
						@else
							Remove Staff
						@endif
					</button>
				</form></li>
				
				<li><form class="toggleactive" action="{{ route('users.toggleactive', ['id' => $user->id] ) }}" method="POST">
					{!! csrf_field() !!}
					<input type="hidden" name="_method" value="PATCH">
					<button type="submit" class="btn btn-primary">
						@if ($user->active)
							Deactivate user
						@else
							Reactivate user
						@endif
					</button>
				</form></li>
			</ul>
		@endif
	</div>
</div>