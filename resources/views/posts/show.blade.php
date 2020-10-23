@extends('layouts.app')

@section('content')
    <h1>{{$post->tajuk}}</h1>
    <p>{{$post->kandungan}}</p>
@endsection