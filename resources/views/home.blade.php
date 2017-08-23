@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
					@if ($closeRegistration and $spaces > 0)
						<p> You have {{ $spaces }} space(s) reserved for registration before Open Registration on {{ $openString }}</p>
						<a href="/reserve" class="btn btn-primary" role="button">View Reserved Spaces</a>
					@endif
					
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
