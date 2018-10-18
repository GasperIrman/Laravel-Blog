@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <a class="btn btn-primary" href="/posts/create">Create Post</a>
                        <br><br>
                        @if(isset($_POST['query']))
                            <h3 style="display: inline-block">Results</h3>
                        @else
                             <h3 style="display: inline-block">Your Blog posts</h3>
                        @endif
                        {{Form::open(['action' => 'DashboardController@searchPosts', 'method' => 'POST', 'style' => 'width: 70%; float: right; text-align: right']) }}
                            <div class="form-group" style="width: 50%; display: inline-block">
                                {{Form::text('query', '', ['class' => 'form-control', 'placeholder' => 'Search Posts'])}}
                            </div>
                            {{Form::submit('Submit', ['class' => 'btn btn-primary', 'style' => ''])}}
                            {!! Form::close() !!}  
                        @if(count($posts) > 0)  
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th></th>   
                                <th></th>
                            </tr>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{$post->title}}</td>
                                    <td>@if($post->user_id == Auth()->user()->id || Auth()->user()->admin)
                                            <a href="/posts/{{$post->id}}/edit" class="btn btn-secondary">Edit</a></td>
                                            <td>{!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                                                    {{Form::hidden('_method', 'DELETE')}}
                                                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                                {!!Form::close()!!}</td>
                                        @else
                                            <td></td><td></td>
                                        @endif

                                    
                                </tr>
                            @endforeach
                        </table>
                        @else
                            <p>You have no posts</p>
                        @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
