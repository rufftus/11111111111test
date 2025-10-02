@extends('layouts.master')
@section('content')
    <div>
        <h1>Liste des fichiers de frais</h1>
    </div>
    <table class="table table-bordered table-striped">
        <thread>
            <tr>
                <th>Mois</th>
                <th>Montant saisi</th>
                <th>Nb justificatif</th>
                <th>Montant validé</th>
                <th>Etat</th>
                <th>Modifier</th>
            </tr>
        </thread>
        @foreach($fiches as $fr)
            <tr>
                <td>{{$fr->anneemois}}</td>
                <td>{{$fr->id_frais}}</td>
                <td>{{$fr->nbjustificatifs}}</td>
                <td>{{$fr->montantvalide}}</td>
                <td>{{$fr->etat}}</td>
                <td><a href="{{url('/formFrais/'.$fr->numFrais )}}">Modifier</a> </td>

            </tr>

        @endforeach
    </table>

@endsection
