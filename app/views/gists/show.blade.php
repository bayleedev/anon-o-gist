@extends('layouts.master')

@section('title')
Edit Code
@stop

@section('content')
	@if($errors->any())
	<div class="row">
		<div class="col-md-4">
			<h4>{{$errors->first()}}</h4>
		</div>
	</div>
	@endif
	{{ Form::open(array('method' => 'put', 'action' => array('GistsController@update', $gist->id))) }}
		<div class="row">
			<div class="col-md-8">
				<div class="field flags">
					<span>Flags</span>
					{{ $gist->flags }}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<div class="field name">
					{{ Form::text('name', $gist->name, array('placeholder' => 'Filename')) }}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<div class="field body">
					{{ Form::textarea('body', $gist->body, array('placeholder' => 'Code contents', 'id' => 'code')) }}
				</div>
			</div>
		</div>
		@if($gist->hasPassword())
		<div class="row">
			<div class="col-md-8">
				<div class="field password">
					{{ Form::password('password', null, array('placeholder' => 'password')) }}
				</div>
				<div class="field buttons submit">
					{{ Form::submit('Update') }}
				</div>
		@endif
	{{ Form::close() }}

	@if($gist->hasPassword())
		{{ Form::open(array('action' => array('GistsController@flag', $gist->id))) }}
				<div class="field buttons submit">
					{{ Form::submit('Flag') }}
				</div>
		{{ Form::close() }}
			</div>
		</div>
	@endif
@stop
