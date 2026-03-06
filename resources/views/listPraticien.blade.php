@extends('layouts.master')
@section('content')
    <div>
        <h1>Liste des praticiens</h1>
    </div>
    <table class="table table-bordered table-striped">
        <thread>
            <tr>
                <th>Numero praticien</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Adresse</th>
                <th>Spécialité</th>
                <th>Modifier</th>

            </tr>
        </thread>
        @foreach($fiches as $fr)
            <tr>
                <td>{{$fr->id_praticien}}</td>
                <td>{{$fr->nom_praticien}}</td>
                <td>{{$fr->prenom_praticien}}</td>
                <td>{{$fr->adresse_praticien}}</td>
                <td>{{$fr->lib_specialite}}</td>
                <td><a href="{{url('/editerFrais/'.$fr->id_frais )}}">Modifier</a> </td>

            </tr>

        @endforeach
    </table>

@endsection
