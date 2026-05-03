@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Invitations pour le Dr. {{ $praticien->nom_praticien }} {{ $praticien->prenom_praticien }}</h2>
            <a href="{{ route('praticiens.recherche') }}" class="btn btn-secondary">Retour à la recherche</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="mb-3">
            <a href="{{ route('invitations.create', $praticien->id_praticien) }}" class="btn btn-success">
                + Nouvelle Invitation
            </a>
        </div>

        <table class="table table-hover">
            <thead class="thead-dark">
            <tr>
                <th>Activité</th>
                <th>Lieu</th>
                <th>Date</th>
                <th>Invité comme Spécialiste ?</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($praticien->activites as $act)
                <tr>
                    <td>{{ $act->theme_activite }}</td>
                    <td>{{ $act->lieu_activite }}</td>
                    <td>{{ \Carbon\Carbon::parse($act->date_activite)->format('d/m/Y') }}</td>
                    <td>
                        @if($act->pivot->specialiste == 'O')
                            <span class="badge badge-primary">Oui</span>
                        @else
                            <span class="badge badge-secondary">Non</span>
                        @endif
                    </td>
                    <td>
                        <!-- Bouton Modifier -->
                        <a href="{{ route('invitations.edit', [$act->id_activite_compl, $praticien->id_praticien]) }}" class="btn btn-warning btn-sm">Modifier</a>

                        <!-- Bouton Supprimer -->
                        <form action="{{ route('invitations.destroy', [$act->id_activite_compl, $praticien->id_praticien]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cette invitation ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Ce praticien n'a reçu aucune invitation pour le moment.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
