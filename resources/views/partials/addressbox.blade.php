<div class="address-box panel panel-info">
    <div class="panel-heading">{{ $address->addType }} Address</div>
    <div class="panel-body">
		<span>Street line 1: {{ $address->addr1 }}</span><br />
		<span>Street line 2: {{ $address->addr2 }}</span><br />
		<span>{{ $address->city }}</span><br />
		<span>{{ $address->state }}</span>
		<span>{{ $address->country }}</span>
		<span>{{ $address->postalCode }}</span><br />
		<span>Prefered: @if ($address->prefered) Yes @else No @endif</span><br />
		@if ($staff)
			<span>User: {{ $address->user->email }}</span>
		@else
			<ul class="list-inline list-unstyled">
				<li><a class="btn btn-primary" href="/addresses/{{ $address->id }}/edit">Edit</a></li>
				<li><form action="/addresses/{{ $address->id }}" method="POST">
					{!! csrf_field() !!}
					<input type="hidden" name="_method" value="DELETE">
					<button class="btn btn-primary" type="submit">Remove</button>
				</form></li>
			</ul>
		@endif
	</div>
</div>