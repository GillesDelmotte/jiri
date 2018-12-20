@extends('layouts.admin')

@section('content')
    <div class="container">
        @foreach($user->jiries as $jiri)
            <div class="card-body" style="border: 1px solid dimgrey; margin-bottom: 1em; border-radius: 3px">
                <h1>
                    {{$jiri->name}}
                </h1>
                <button class="btn btn-primary">démarrer le jiri</button>
                <button class="btn btn-primary">voir le jiri</button>
            </div>
        @endforeach
    </div>
@endsection

