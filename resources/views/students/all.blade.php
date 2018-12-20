@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{$currentJiri->name}} || {{$currentJiri->createdDate}}</h1>
    <br>
    <ul class="list-group">
        @foreach($currentJiri->students as $student)
            <a href="/student/{{$student->id}}">
                <li class="list-group-item list-group-item-action">
                   {{$student->name}}
                </li>
            </a>
        @endforeach
    </ul>
</div>
@endsection
