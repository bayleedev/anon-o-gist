@extends('layouts.master')

@section('sidebar')
	<ul id="sidebar">
		@foreach ($gists as $gist)
			<li>
				<a href="/gist/{{ $gist->id }}">{{ $gist->name }}</a>
				<p>{{ $gist->excerpt() }}</p>
			</li>
		@endforeach
	</ul>
@stop

@section('content')
	@if($errors->any())
		<h4>{{$errors->first()}}</h4>
	@endif
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