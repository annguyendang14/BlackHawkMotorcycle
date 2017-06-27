<div class="phone-box panel panel-info">
    <div class="panel-heading">{{ $phone->phoneType }} Phone</div>
    <div class="panel-body">
		<span>Number: {{ $phone->number }}</span><br />
		
		<span>Prefered: @if ($phone->prefered) Yes @else No @endif</span><br />
		@if ($staff)
			<span>User: {{ $phone->user->email }}</span>
		@else
			<ul class="list-inline list-unstyled">
				<li><a class="btn btn-primary" href="/phones/{{ $phone->id }}/edit">Edit</a></li>
				<li><form action="/phones/{{ $phone->id }}" method="POST">
					{!! csrf_field() !!}
					<input type="hidden" name="_method" value="DELETE">
					<button class="btn btn-primary" type="submit">Remove</button>
				</form></li>
			</ul>
		@endif
	</div>
</div>