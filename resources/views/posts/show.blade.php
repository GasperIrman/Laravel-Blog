@extends('layouts.app')

@section('content')
	<a href="/posts" class="btn btn-info">Go back</a>
	<h1>{{$post->title}}</h1>
		<div class="well">
			<div>
				@if($post->cover_image != "noimage.jpg")
				<img style="max-width: 500px;" src="/storage/cover_images/{{$post->cover_image}}" alt="Whoopsie">
				@endif
				{!! $post->body !!}
			</div>
		</div>
		<hr>
		<small>Written on {{date('d m Y, H:i:s', strtotime($post->created_at))}}<br>By {{$post->user->name}}</small>
		<hr>
		@if(!Auth::guest())
			@if(Auth::user()->id == $post->user_id || Auth::user()->admin)
				<a href="/posts/{{$post->id}}/edit" class="btn btn-info">Edit</a>

				{!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right'])!!}
					{{Form::hidden('_method', 'DELETE')}}
					{{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
				{!!Form::close()!!}
			@endif
				<hr>
					<div class="col-md-8" style="margin: auto">
						<h2>Create Comment</h2>
						{!! Form::open(['action'=> 'CommentsController@store', 'method' => 'POST']) !!}
					    <div class="form-group">
					    	{{Form::textarea('comment', '', ['class' => 'form-control', 'placeholder' => 'Comment text', 'rows' => '5'])}}
					    	{{Form::hidden('post_id', $post->id) }}
					    </div>
					    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
						{!! Form::close() !!}
					</div>
		@endif
		<div class="col-md-8" style="margin: auto;padding-top: 20px">
			@if($post->comments->count() != 0)
				@foreach($post->comments as $comment)
					<div style="margin-top: 5px; margin-bottom: 5px">{{$comment->comment}}</div>
					<small>By <a href="/users/{!! $comment->user->id !!}">{{$comment->user->name}}</a>, on {{date('d m Y, H:i:s', strtotime($comment->created_at))}}</small>
					@if($comment->user_id === auth()->user()->id|| Auth::user()->admin)
					{!!Form::open(['action' => ['CommentsController@destroy', $comment->id], 'method' => 'POST', 'class' => 'float-right'])!!}
					{{Form::hidden('_method', 'DELETE')}}
					{{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
				{!!Form::close()!!}
				@endif
					<hr>
				@endforeach
			@else
				<div style="text-align: center; margin-top: 10px; margin-bottom: 100px">Be the first one to comment! :D</div> 	
			@endif
		</div>
@endsection