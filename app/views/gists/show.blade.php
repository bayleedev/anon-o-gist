@extends('layouts.master')

@section('content')
	{{ Form::open(array('method' => 'put', 'action' => array('GistsController@update', $gist->id))) }}
		<div class="field flags">
			<span>Flags</span>
			{{ $gist->flags }}
		</div>
		<div class="field name">
			{{ Form::text('name', $gist->name, array('placeholder' => 'Filename')) }}
		</div>
		<div class="field body">
			{{ Form::textarea('body', $gist->body, array('placeholder' => 'Code contents')) }}
		</div>
		<div class="field password">
			{{ Form::password('password', null, array('placeholder' => 'password')) }}
		</div>
		<div class="field buttons submit">
			{{ Form::submit('Update') }}
		</div>
	{{ Form::close() }}
	{{ Form::open(array('action' => array('GistsController@flag', $gist->id))) }}
		<div class="field buttons submit">
			{{ Form::submit('Flag') }}
		</div>
	{{ Form::close() }}
@stop