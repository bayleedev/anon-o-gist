@extends('layouts.master')

@section('title')
Anon-O-Gist
@stop

@section('sidebar')
	<h2>Recent Gists</h2>
	<div class="gists row">
		@foreach ($gists as $gist)
			<div class="col-md-2">
				<a href="/gist/{{ $gist->id }}">{{ $gist->name }}</a>
				<p>{{ $gist->excerpt() }}</p>
			</div>
		@endforeach
	</div>
@stop

@section('content')
	@if($errors->any())
		<h4>{{$errors->first()}}</h4>
	@endif
	<h2>Create a gist!</h2>
	{{ Form::open(array('action' => 'GistsController@store')) }}
		<div class="field name form-group">
			{{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Filename')) }}
		</div>
		<div class="row form-group">
			<div class="col-md-8">
				<div class="field body">
					{{ Form::textarea('body', null, array('placeholder' => 'Code contents', 'id' => 'code')) }}
				</div>
			</div>
		</div>
		<div class="field form-group">
			{{ Form::password('password', array('class' => 'form-control', 'placeholder' => '******')) }}
		</div>
		<div class="field buttons form-group">
			{{ Form::submit('Create', array('class' => 'btn btn-default')) }}
		</div>
	{{ Form::close() }}
@stop