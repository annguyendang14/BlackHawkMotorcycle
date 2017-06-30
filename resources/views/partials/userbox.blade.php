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
		<!-- May implement this for changing password and edit info for normal user later -->
	</div>
</div>