
<div class="panel-body" style="padding-bottom: 0">
	<span><strong>{{ $phone->phoneType }} Phone</strong></span><br />
	<span>Number: {{ $phone->number }}</span><br />
	
	<span>Prefered: @if ($phone->prefered) Yes @else No @endif</span><br />
	@if ($phone->user->id == Auth::user()->id)
		
		<ul class="list-inline list-unstyled" style="margin-bottom: 0" >
			<li><a class="btn btn-primary" href="{{ route('phones.edit', ['id' => $phone->id] ) }}">Edit</a></li>
			<li><form class="delete" action="{{ route('phones.destroy', ['id' => $phone->id] ) }}" method="POST">
				{!! csrf_field() !!}
				<input type="hidden" name="_method" value="DELETE">
				<button class="btn btn-primary" type="submit">Remove</button>
			</form></li>
		</ul>
	@endif
</div>
