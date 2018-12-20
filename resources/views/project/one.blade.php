@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{$student->name}} - {{$student->implementationsForCurrentJiriWithProjects->first()->project->name}}</h1>
        <p>{{$student->implementationsForCurrentJiriWithProjects->first()->project->description}}</p>
        <hr>
        <form action="/score" method="post">
            @csrf
            <input type="hidden" name="user_id" value="{{auth()->user()->getAuthIdentifier()}}">
            <input type="hidden" name="implement_id" value="{{$student->implementationsForCurrentJiriWithProjects->first()->id}}">
            <div class="form-group">
                <label for="score">Note&nbsp;:</label>
                <input name="score" class="form-control" id="score" type="number" min="0" max="20">
            </div>
            <div class="form-group">
                <label for="comment">Commentaire&nbsp;</label>
                <textarea class="form-control" name="comment" id="comment" cols="30" rows="10"></textarea>
            </div>
            <button class='btn btn-primary' type="submit" >Enregister la note</button>
        </form>
    </div>
@endsection
