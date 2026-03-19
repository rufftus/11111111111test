@extends('layouts.master')

@section('content')
    <form method="POST" action="{{ route('valider.inviter') }}">
        @csrf
        <h1>@if($invitation->id_activite_compl != '') Modification @else Ajout @endif d'une Invitation</h1>

        <input type="hidden" name="old_id_activite_compl" value="{{ $invitation->id_activite_compl }}">
        <input type="hidden" name="old_id_praticien" value="{{ $invitation->id_praticien }}">

        <div class="col-md-12 card card-body bg-light">

            <div class="form-group">
                <label class="col-md-3">Activité Complémentaire</label>
                <div class="col-md-6">
                    <select name="id_activite_compl" class="form-control" required>
                        <option value="">-- Choisir une activité --</option>
                        @foreach($activites as $activite)
                            <option value="{{ $activite->id_activite_compl }}" {{ $invitation->id_activite_compl == $activite->id_activite_compl ? 'selected' : '' }}>
                                {{ $activite->id_activite_compl }} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3">Praticien</label>
                <div class="col-md-6">
                    <select name="id_praticien" class="form-control" required>
                        <option value="">-- Choisir un praticien --</option>
                        @foreach($praticiens as $praticien)
                            <option value="{{ $praticien->id_praticien }}" {{ $invitation->id_praticien == $praticien->id_praticien ? 'selected' : '' }}>
                                {{ $praticien->PRA_NOM }} {{ $praticien->PRA_PRENOM }} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            @if($invitation->id_activite_compl != '')
                <div class="form-group">
                    <a href="{{ url('/supprimerInviter/'.$invitation->id_activite_compl.'/'.$invitation->id_praticien) }}"
                       class="btn btn-danger"
                       onclick="return confirm('Voulez-vous vraiment supprimer cette invitation ?')">
                        Supprimer
                    </a>
                </div>
            @endif

            <hr>
            <button type="submit" class="btn btn-primary">Valider</button>
        </div>
    </form>
@endsection
