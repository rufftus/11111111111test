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
            </tr>
        </thread>
        @foreach($fiches as $fr)
            <tr>
                <td>{{$fr->id_praticien}}</td>
                <td>{{$fr->nom_praticien}}</td>
                <td>{{$fr->prenom_praticien}}</td>
                <td>{{$fr->adresse_praticien}}</td>
            </tr>

        @endforeach
    </table>

@endsection
