@extends('layouts.app')

@section('content')
	<h3>Hello {{$user->name}}</h3>
	<div><img src="/storage/profile_pictures/{{$user->profile_picture}}" alt="woops"></div>
	
	@if($user->id == Auth::user()->id)
	<h5>Edit Profile</h5>
	{!! Form::open(['action'=> ['UsersController@update', $user->id], 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
	    <div class="form-group">
    	{{Form::label('ppshow', 'Show profile picture to other users?')}}&nbsp; 
    	{{Form::checkbox('ppshow', 'checkbox', $user->ppshow)}}<br>
        {{Form::label('pnshow', 'Show your name to other users?')}}&nbsp; 
    	{{Form::checkbox('pnshow', 'checkbox', $user->pnshow)}}<br>
       	{{Form::label('peshow', 'Show your email to other users?')}}&nbsp; 
    	{{Form::checkbox('peshow', 'checkbox', $user->peshow)}}
    </div>
    <div class="form-group">
    	{{Form::label('name', 'Name')}}
    	{{Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'Enter Name'])}}
    </div>
    <div class="form-group">
    	{{Form::label('email', 'Email')}}
    	{{Form::text('email', $user->email, ['class' => 'form-control', 'placeholder' => 'Enter email'])}}
    </div>
    <div class="form-group">
    	{{Form::label('bio', 'About me')}}
    	{{Form::textarea('bio', $user->bio, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Enter email'])}}
    </div>
    {{Form::hidden('_method', 'PUT')}}
    <div class="form-group">
        {{Form::file('profile_picture')}}
    </div>
    {{Form::submit('Submit', ['class' => 'btn btn-info'])}}
	{!! Form::close() !!}
	@else
		<div class="well">
			<br><br>
			<div class="panel">
				<h3><b>Name: </b>{{$user->name}}</h3>
			</div>
			<hr>
			<div class="panel">
				<h4><b>Email address: </b>{{$user->email}}</h4>
			</div>
			<hr>
		</div>
	@endif
@endsection