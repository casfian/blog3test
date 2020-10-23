@extends('layouts.app')
@section('content')
    <h1>Posts</h1>

    <a href="posts/create">Create Post</a>    

    <a href="/download">Download Posts in Excel</a>  

    <a href="/posts/importexcel">Import Posts in Excel</a>  

    @if(count($posts) > 0)
        @foreach ($posts as $post)
        <h3>{{$post->tajuk}}</h3>
        <p>{{$post->kandungan}}</p> 
        <p>Photo: {{$post->photo}}</p> 

        <img style="width: 20%" src="public/uploads/{{$post->photo}}">

        <p>user id: {{$post->user_id}}</p>

        <a href="posts/{{$post->id}}">Show Post</a><br>
        
        {{-- @hasanyrole('editor|admin') --}}
        <a href="posts/{{$post->id}}/edit">Edit Post</a><br>
        {{-- @endhasanyrole --}}
        
        @hasanyrole('user|admin')
        <form action="{{ route('posts.destroy', $post->id) }}" method="post">
            @csrf
            @method('DELETE')
        <input type="submit" value="Delete" onclick="return confirm('Are you Sure?')">
        </form>
        @endhasanyrole

        <hr>   
        @endforeach
    @endif
    
    {!! $posts->links() !!}
    
@endsection