@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>{{ isset($invitation) ? 'Modifier une invitation' : 'Ajouter une invitation' }}</h2>

        <form action="{{ url('/validerInviter') }}" method="POST">
            @csrf {{-- Champs cachés utiles uniquement pour la modification --}}
            @if(isset($invitation))
                <input type="hidden" name="old_id_activite_compl" value="{{ $invitation->id_activite_compl }}">
                <input type="hidden" name="old_id_praticien" value="{{ $invitation->id_praticien }}">
            @endif

            <div class="form-group mb-3">
                <label for="id_activite_compl">Activité Complémentaire :</label>
                <select name="id_activite_compl" id="id_activite_compl" class="form-control" required>
                    <option value="">-- Sélectionnez une activité --</option>
                    @foreach($activites as $activite)
                        <option value="{{ $activite->id_activite_compl }}"
                            {{ (isset($invitation) && $invitation->id_activite_compl == $activite->id_activite_compl) ? 'selected' : '' }}>
                            {{ $activite->theme_activite ?? $activite->lieu_activite }} (ID: {{ $activite->id_activite_compl }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="id_praticien">Praticien :</label>
                <select name="id_praticien" id="id_praticien" class="form-control" required>
                    <option value="">-- Sélectionnez un praticien --</option>
                    @foreach($praticiens as $praticien)
                        <option value="{{ $praticien->id_praticien }}"
                            {{ (isset($invitation) && $invitation->id_praticien == $praticien->id_praticien) ? 'selected' : '' }}>
                            {{ $praticien->nom_praticien }} {{ $praticien->prenom_praticien }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">
                {{ isset($invitation) ? 'Mettre à jour' : 'Valider' }}
            </button>
            <a href="{{ url('/') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
@endsection
