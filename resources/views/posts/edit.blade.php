@extends('layouts.app')

@section('content')
<div class="card">

    <div class="card-header text-left font-weight-bold">
        <h1>Edit Post</h1>
    </div>
    <div class="card-body">
        <form action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Tajuk</label>
            <input type="text" class="form-control" name="tajuk" value="{{$post->tajuk}}">
                @error('tajuk')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Kandungan</label>
            <textarea name="kandungan" class="form-control" required="">{{$post->kandungan}}</textarea>
                @error('kandungan')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Upload Photo</label>
                <input type="file" name="photo" class="form-control">
                @error('photo')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</div>

@endsection