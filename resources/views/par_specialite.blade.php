@extends('layouts.master')
@section('content')
    <div class="container mt-5">
        <h2>Praticiens par Spécialité</h2>
        <form action="{{ route('praticiens.specialite') }}" method="GET" class="mb-4">
            <div class="d-flex">
                <select name="id_specialite" class="form-control w-50 mr-2">
                    <option value="">Choisir une spécialité...</option>
                    @foreach($specialites as $spe)
                        <option value="{{ $spe->id_specialite }}" {{ request('id_specialite') == $spe->id_specialite ? 'selected' : '' }}>
                            {{ $spe->lib_specialite }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Afficher</button>
            </div>
        </form>

        @if($praticiens->isNotEmpty())
            <ul class="list-group">
                @foreach($praticiens as $p)
                    <li class="list-group-item">{{ $p->nom_praticien }} {{ $p->prenom_praticien }} ({{ $p->ville_praticien }})</li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
