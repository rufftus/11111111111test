@extends('layouts.master')
@section('content')
    <div class="container mt-5">
        <h2>Invitations pour le Dr. {{ $praticien->nom_praticien }}</h2>
        <a href="{{ route('invitations.create', $praticien->id_praticien) }}" class="btn btn-success mb-3">Ajouter une invitation</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
            <tr><th>Activité</th><th>Date</th><th>Spécialiste ?</th><th>Actions</th></tr>
            </thead>
            <tbody>
            @foreach($praticien->activites as $act)
                <tr>
                    <td>{{ $act->theme_activite }}</td>
                    <td>{{ $act->date_activite }}</td>
                    <td>{{ $act->pivot->specialiste == 'O' ? 'Oui' : 'Non' }}</td>
                    <td>
                        <a href="{{ route('invitations.edit', [$act->id_activite_compl, $praticien->id_praticien]) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('invitations.destroy', [$act->id_activite_compl, $praticien->id_praticien]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Sûr de vouloir supprimer ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
