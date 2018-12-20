@extends('layouts.admin')

@section('content')
    <div class="container">
       <h2 class="card-title">Creation d'un nouveau jiri</h2>
        <section class="card-body" style="border: 1px solid dimgrey; border-radius: 3px">
            <h3>Titre, date et heure du jiri</h3>
            <div class="card-body">
                <label for="title">titre</label>
                <input class="form-control" type="text" name="title" id="title">
            </div>
            <div class="card-body">
                <label for="date">date</label>
                <input class="form-control" type="text" name="date" id="date" placeholder="jj/mm/aaaa">
            </div>
            <div class="card-body">
                <label for="time">heure</label>
                <input class="form-control" type="time" id="time" name="time">
            </div>
        </section>
        <br>
        <section class="card-body" style="border: 1px solid dimgrey; border-radius: 3px">
            <h3>Ajouter des jurés</h3>
            <div class="card-body">
                <label for="judgesName">nom du juré</label>
                <input class="form-control" type="search" name="judgesName" id="judgesName">
            </div>
            <div class="card-body">
                <label for="judgesEmail">email du juré</label>
                <input class="form-control" type="text" name="judgesEmail" id="judgesEmail">
            </div>
            <div class="card-body">
                <h4>Apercu des jurés ajouté</h4>
                <br>
                <ul>
                    <li>Gilles Delmotte || <button class="btn btn-danger">supprimer ce juré</button></li>
                    <br>
                    <li>Charlotte Toussaint || <button class="btn btn-danger">supprimer ce juré</button></li>
                    <br>
                    <li>Dominique Vilain || <button class="btn btn-danger">supprimer ce juré</button></li>
                </ul>
            </div>
        </section>
        <br>
        <section class="card-body" style="border: 1px solid dimgrey; border-radius: 3px">
            <h3>Ajouter des étudiants</h3>
            <div class="card-body">
                <label for="studentName">nom de l'étudiant</label>
                <input class="form-control" type="search" name="studentName" id="studentName">
            </div>
            <div class="card-body">
                <label for="studentEmail">email de l'étudiant</label>
                <input class="form-control" type="text" name="studentEmail" id="studentEmail">
            </div>
            <div class="card-body">
                <h4>Apercu des étudiants ajouté</h4>
                <br>
                <ul>
                    <li>Gilles Delmotte || <button class="btn btn-danger">supprimer cet étudiant</button></li>
                    <br>
                    <li>Charlotte Toussaint || <button class="btn btn-danger">supprimer cet étudiant</button></li>
                    <br>
                    <li>Dominique Vilain || <button class="btn btn-danger">supprimer cet étudiant</button></li>
                </ul>
            </div>
        </section>
        <br>
        <section class="card-body" style="border: 1px solid dimgrey; border-radius: 3px">
            <h3>Ajouter des travaux</h3>
            <div class="card-body">
                <label for="workName">nom du travail</label>
                <input class="form-control" type="search" name="workName" id="workName">
            </div>
            <div class="card-body">
                <h4>Apercu des travaux ajouté</h4>
                <br>
                <ul>
                    <li>jiri || <button class="btn btn-danger">supprimer ce travail</button></li>
                    <br>
                    <li>pfe || <button class="btn btn-danger">supprimer ce travail</button></li>
                    <br>
                    <li>la cité école vivante || <button class="btn btn-danger">supprimer ce travail</button></li>
                </ul>
            </div>
        </section>
    </div>
@endsection

