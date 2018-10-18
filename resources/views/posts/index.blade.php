@extends('layouts.app')

@section('content')
	<h1 style="display: inline-block;">Posts</h1>
	@if(count($posts) > 0)
		@foreach($posts as $post)
		<div class="well">
			<hr>
			<h3><a href="/posts/{{$post->id}}"><img style="width: 10%" src="/storage/cover_images/{{$post->cover_image}}" alt="Whoopsie">&nbsp;&nbsp;{{$post->title}}</a></h3><br>
			<small>Written on {{date('d m Y, H:i:s', strtotime($post->created_at))}}<br>By {{$post->user->name}}</small>
		</div>
		@endforeach
		{{$posts->links()}}
	@else
		<p>No posts found</p>
	@endif
@endsection