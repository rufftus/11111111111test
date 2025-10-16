@extends('layouts.master')
@section('content')
    <div>
        <h1>Liste des Frais Hors forfait de la fiche :</h1>
    </div>
    <table class="table table-bordered table-striped">
        <thread>
            <tr>
                <td>Date</td>
                <td>Libelle</td>
                <td>Montant</td>
                <td>🖊️</td>
                <td>🗑️</td>
            </tr>
            @foreach($listeHF as $fr)
                <tr>
                    <td>{{$fr->date_fraishorsforfait}}</td>
                    <td>{{$fr->lib_fraishorsforfait}}</td>
                    <td>{{$fr->montant_fraishorsforfait}}</td>
                    <td></td>
                    <td></td>
                </tr>
            @endforeach



        </thread>
        <button type="submit" class="btn btn-primary">valider</button>


    </table>

@endsection
