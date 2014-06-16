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
	{{ Form::open(['method' => 'put', 'action' => ['GistsController@update', $gist->id]]) }}
		<div class="row">
			<div class="col-md-9">
				<div class="field flags">
					<span>Flags</span>
					{{ $gist->flags }}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-9">
				<div class="field name form-group">
					{{ Form::text('name', $gist->name, ['class' => 'form-control', 'placeholder' => 'Filename']) }}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-9">
				<div class="field form-group">
					Code Syntax: 
					<select id="syntax">
						<option value="application/x-httpd-php">PHP</option>
						<option value="text/x-ruby">RUBY</option>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-9">
				<div class="field body">
					{{ Form::textarea('body', $gist->body, ['placeholder' => 'Code contents', 'id' => 'code']) }}
				</div>
			</div>
		</div>
		@if($gist->hasPassword())
		<div class="row form-group">
			<div class="col-md-6">
				<div class="field password">
					{{ Form::password('password', ['class' => 'form-control', 'placeholder' => '********']) }}
				</div>
				<div class="field buttons submit">
					{{ Form::submit('Update', ['class' => 'btn btn-default']) }}
				</div>
		@endif
	{{ Form::close() }}

	@if($gist->hasPassword())
		{{ Form::open(['action' => ['GistsController@flag', $gist->id]]) }}
				<div class="field buttons submit form-group">
					{{ Form::submit('Flag', ['class' => 'btn btn-default']) }}
				</div>
		{{ Form::close() }}
			</div>
		</div>
	@endif
@stop