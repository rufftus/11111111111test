@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        <h1>Liste des Invitations aux Activités</h1>
        <a href="{{ url('/ajouterInviter') }}" class="btn btn-success mb-3">Ajouter une invitation</a>

        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Activité</th>
                <th>Praticien</th>
                <th>Spécialiste</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($invitations as $inv)
                <tr>
                    <td>{{ $inv->theme_activite }} ({{ $inv->lieu_activite }})</td>
                    <td>{{ $inv->nom_praticien }} {{ $inv->prenom_praticien }}</td>
                    <td>{{ $inv->specialiste == 'O' ? 'Oui' : 'Non' }}</td>
                    <td>
                        <a href="{{ url('/editerInviter/'.$inv->id_activite_compl.'/'.$inv->id_praticien) }}" class="btn btn-warning">Modifier</a>
                        <a href="{{ url('/supprimerInviter/'.$inv->id_activite_compl.'/'.$inv->id_praticien) }}" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
