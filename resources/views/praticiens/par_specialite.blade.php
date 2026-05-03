@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Praticiens par Spécialité</h2>

        <form action="{{ route('praticiens.specialite') }}" method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-8">
                    <select name="id_specialite" class="form-control" required>
                        <option value="">-- Sélectionnez une spécialité --</option>
                        @if(isset($specialites))
                            @foreach($specialites as $spe)
                                <option value="{{ $spe->id_specialite }}" {{ request('id_specialite') == $spe->id_specialite ? 'selected' : '' }}>
                                    {{ $spe->lib_specialite }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary w-100">Afficher les praticiens</button>
                </div>
            </div>
        </form>

        @if(isset($praticiens))
            @if($praticiens->count() > 0)
                <div class="list-group">
                    @foreach($praticiens as $p)
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>Dr. {{ $p->nom_praticien }} {{ $p->prenom_praticien }}</strong><br>
                                <small class="text-muted">{{ $p->adresse_praticien }}, {{ $p->cp_praticien }} {{ $p->ville_praticien }}</small>
                            </div>
                            <a href="{{ route('invitations.index', $p->id_praticien) }}" class="btn btn-outline-info btn-sm">Invitations</a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info">Aucun praticien n'a cette spécialité.</div>
            @endif
        @endif
    </div>
@endsection
