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
		@if ($user->id == Auth::user()->id)
		
		<ul class="list-inline list-unstyled " style="margin-bottom: 0" >
			<li><a class="btn btn-primary" href="/user/{{ $user->id }}/edit">Edit profile</a></li>
			<li><a class="btn btn-primary" href="/user/password_change/{{ $user->id }}/edit">Change Password</a></li>
			
		</ul>
	@endif
	</div>
</div>