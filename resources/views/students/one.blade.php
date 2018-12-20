@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="/jiri/{{session('jiri_id')}}" class="btn-dark btn">revenir en arrière</a>
        <br>
        <br>
        <h1>{{$student->name}}</h1>
        @if(session('message'))
            <p class="alert alert-info">{{session('message')}}</p>
        @endif
        <ul class="list-group">
            @foreach($student->implementationsForCurrentJiriWithProjectsAndScore as $implementation)
                    <li class="list-group-item">
                        <h2>{{$implementation->project->name}}</h2>

                        <p>{{$implementation->project->description}}</p>

                        @if($implementation->scoreForCurrentUser->first())
                        <p>Note : {{$implementation->scoreForCurrentUser->first()->score}}</p>
                        <p>Commentaire : {{$implementation->scoreForCurrentUser->first()->comment}}</p>
                        <a class="btn btn-danger"
                           href="/score/{{$implementation->scoreForCurrentUser->first()->id}}/edit">
                            Modifier ma note
                        </a>
                        @else
                        <a class="btn btn-primary"
                           href="/student/{{$student->id}}/project/{{$implementation->project->id}}">
                            Ajouter une note
                        </a>
                        @endif
                    </li>

                <br>
            @endforeach
        </ul>
        <br>
        <div>
            @if($impression->first())
                <h2>Modifier la note et le commentaire d'apréciation</h2>
                <form action="/impression/{{$impression->first()->id}}" method="post">
                    @csrf
                    @method('patch')
                    <div>
                        <label for="impression_score">note&nbsp;:</label>
                        <input type="number" id="impression_score" name="impression_score" class="form-control" value="{{$impression->first()->impression_score}}">
                        <br>
                        <label for="impression_comment">Commentaire&nbsp;:</label>
                        <textarea name="impression_comment" id="impression_comment" cols="30" rows="10" class="form-control">{{$impression->first()->impression_comment}}</textarea>
                        <br>
                        <input type="submit" class="btn-primary btn" value="Valider">
                    </div>
                </form>
            @else
                <h2>Note d'appréciation de l'étudiant (facultatif)</h2>
                <form action="/impression" method="post">
                    @csrf
                    <div>
                        <input type="hidden" value="{{session('jiri_id')}}" name="jiri_id">
                        <input type="hidden" value="{{$student->id}}" name="student_id">
                        <input type="hidden" value="{{auth()->id()}}" name="user_id">
                        <label for="impression_score">note&nbsp;:</label>
                        <input type="number" id="impression_score" name="impression_score" class="form-control">
                        <br>
                        <label for="impression_comment">Commentaire&nbsp;:</label>
                        <textarea name="impression_comment" id="impression_comment" cols="30" rows="10" class="form-control"></textarea>
                        <br>
                        <input type="submit" class="btn-primary btn" value="Valider">
                    </div>
                </form>
            @endif

        </div>
    </div>

@endsection


