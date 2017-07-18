
<div class="panel-body" style="padding-bottom: 0" >
	<span><strong>{{ $address->addType }} Address</strong><span><br />
	<span>Street line 1: {{ $address->addr1 }}</span><br />
	<span>Street line 2: {{ $address->addr2 }}</span><br />
	<span>City: {{ $address->city }}</span><br />
	<span>State: {{ $address->state }}, </span>
	<span>{{ $address->country }}, </span>
	<span>{{ $address->postalCode }}</span><br />
	<span>Prefered: @if ($address->prefered) Yes @else No @endif</span><br />
	@if ($address->user->id == Auth::user()->id)
		
		<ul class="list-inline list-unstyled " style="margin-bottom: 0" >
			<li><a class="btn btn-primary" href="/addresses/{{ $address->id }}/edit">Edit</a></li>
			<li><form class="delete" action="/addresses/{{ $address->id }}" method="POST">
				{!! csrf_field() !!}
				<input type="hidden" name="_method" value="DELETE">
				<button class="btn btn-primary" type="submit">Remove</button>
			</form></li>
		</ul>
	@endif
</div>
