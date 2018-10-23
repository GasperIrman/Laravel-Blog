
@extends('layouts.app')
@section('content')
	<div class="jumbotron text-center">
    	<h1>Welcome to Laravel</h1>
    	<p>This is the laravel application from the "Laravel form scratch" Youtube series</p>
    	@guest
			<p><a class="btn btn-primary btn-lg" style="margin-right: 10px; min-width: 15%;" href="/login" role="button">Login</a><a style="margin-left: 10px; min-width: 15%;" class="btn btn-success btn-lg" href="/register" role="button">Register</a>
		@else
			<p><a class="btn btn-primary btn-lg" style="margin-right: 10px; min-width: 15%;" href="/posts" role="button">Blog</a><a style="margin-left: 10px; min-width: 15%;" class="btn btn-success btn-lg" href="/dashboard" role="button">Dashboard</a>
		@endguest
    </div>
@endsection