@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        <h1>{{ isset($invitation) ? 'Modifier' : 'Ajouter' }} une invitation</h1>

        <form action="{{ url('/validerInviter') }}" method="POST">
            @csrf
            @if(isset($invitation))
                <input type="hidden" name="old_id_activite_compl" value="{{ $invitation->id_activite_compl }}">
                <input type="hidden" name="old_id_praticien" value="{{ $invitation->id_praticien }}">
            @endif

            <div class="form-group mb-3">
                <label>Activité Complémentaire :</label>
                <select name="id_activite_compl" class="form-control" required>
                    @foreach($activites as $act)
                        <option value="{{ $act->id_activite_compl }}" {{ (isset($invitation) && $invitation->id_activite_compl == $act->id_activite_compl) ? 'selected' : '' }}>
                            {{ $act->theme_activite }} ({{ $act->lieu_activite }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label>Praticien :</label>
                <select name="id_praticien" class="form-control" required>
                    @foreach($praticiens as $prat)
                        <option value="{{ $prat->id_praticien }}" {{ (isset($invitation) && $invitation->id_praticien == $prat->id_praticien) ? 'selected' : '' }}>
                            {{ $prat->nom_praticien }} {{ $prat->prenom_praticien }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label>Invité en tant que spécialiste ?</label>
                <select name="specialiste" class="form-control" required>
                    <option value="N" {{ (isset($invitation) && $invitation->specialiste == 'N') ? 'selected' : '' }}>Non</option>
                    <option value="O" {{ (isset($invitation) && $invitation->specialiste == 'O') ? 'selected' : '' }}>Oui</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Valider</button>
        </form>
    </div>
@endsection
