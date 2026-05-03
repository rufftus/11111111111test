@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h4>Ajouter une invitation pour le Dr. {{ $praticien->nom_praticien }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('invitations.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_praticien" value="{{ $praticien->id_praticien }}">

                    <div class="form-group mb-3">
                        <label for="id_activite_compl">Sélectionnez une activité :</label>
                        <select name="id_activite_compl" id="id_activite_compl" class="form-control" required>
                            <option value="">-- Liste des activités disponibles --</option>
                            @foreach($activites as $act)
                                <option value="{{ $act->id_activite_compl }}">
                                    Le {{ \Carbon\Carbon::parse($act->date_activite)->format('d/m/Y') }} : {{ $act->theme_activite }} ({{ $act->lieu_activite }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="specialiste">Convié en tant que spécialiste ?</label>
                        <select name="specialiste" id="specialiste" class="form-control" required>
                            <option value="N">Non</option>
                            <option value="O">Oui</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Enregistrer l'invitation</button>
                    <a href="{{ route('invitations.index', $praticien->id_praticien) }}" class="btn btn-secondary">Annuler</a>
                </form>
            </div>
        </div>
    </div>
@endsection
