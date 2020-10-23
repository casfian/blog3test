@extends('layouts.app')

@section('content')
<h1>{{ $tajuk }}</h1>
    <p>This is Services</p>
    @if(count($services) > 0)
    <ul>
        @foreach ($services as $service)
            <li>{{ $service }}</li>
        @endforeach
    </ul>
    @endif
@endsection
    
