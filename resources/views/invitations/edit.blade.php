@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-warning">
                <h4>Modifier l'invitation du Dr. {{ $praticien->nom_praticien }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('invitations.update', [$activite->id_activite_compl, $praticien->id_praticien]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label>Activité concernée :</label>
                        <input type="text" class="form-control" value="{{ $activite->theme_activite }} au {{ $activite->lieu_activite }}" disabled>
                        <small class="form-text text-muted">L'activité ne peut pas être changée. Si c'est une erreur, supprimez l'invitation et recréez-la.</small>
                    </div>

                    <div class="form-group mb-4">
                        <label for="specialiste">Convié en tant que spécialiste ?</label>
                        <select name="specialiste" id="specialiste" class="form-control" required>
                            <option value="O" {{ $invitation->specialiste == 'O' ? 'selected' : '' }}>Oui</option>
                            <option value="N" {{ $invitation->specialiste == 'N' ? 'selected' : '' }}>Non</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-warning">Mettre à jour</button>
                    <a href="{{ route('invitations.index', $praticien->id_praticien) }}" class="btn btn-secondary">Annuler</a>
                </form>
            </div>
        </div>
    </div>
@endsection
