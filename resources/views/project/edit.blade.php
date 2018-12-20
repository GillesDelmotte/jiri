@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{$student->name}} - {{$student->implementationsForCurrentJiriWithProjects->first()->project->name}}</h1>
        <p>{{$student->implementationsForCurrentJiriWithProjects->first()->project->description}}</p>
        <hr>
        <form action="/score/{{$score->id}}" method="post">
            @csrf
            @method('patch')
            <div class="form-group">
                <label for="score">Note&nbsp;:</label>
                <input name="score" class="form-control" id="score" type="number" min="0" max="20" value="{{$score->score}}">
            </div>
            <div class="form-group">
                <label for="comment">Commentaire&nbsp;</label>
                <textarea class="form-control" name="comment" id="comment" cols="30" rows="10">{{$score->comment}}</textarea>
            </div>
            <button class='btn btn-primary' type="submit" >enregister la note</button>
        </form>
    </div>
@endsection
