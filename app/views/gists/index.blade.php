@extends('layouts.master')

@section('sidebar')
	<div id="sidebar">
		@foreach ($gists as $gist)
			<p>This is gist {{ $gist->id }}</p>
		@endforeach
	</div>
@stop

@section('content')
	{{ Form::open(array('action' => 'GistsController@store')) }}
		<div class="field name">
			{{ Form::text('name', null, array('placeholder' => 'Filename')) }}
		</div>
		<div class="field body">
			{{ Form::textarea('body', null, array('placeholder' => 'Code contents')) }}
		</div>
		<div class="field password">
			{{ Form::password('password', null, array('placeholder' => 'password')) }}
		</div>
		<div class="field buttons submit">
			{{ Form::submit('Create') }}
		</div>
	{{ Form::close() }}
@stop