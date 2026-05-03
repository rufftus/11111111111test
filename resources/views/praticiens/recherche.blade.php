@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Recherche de Praticiens</h2>

        <!-- Formulaire de recherche -->
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('praticiens.recherche') }}" method="GET">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="text" name="nom" class="form-control" placeholder="Nom du praticien..." value="{{ request('nom') }}">
                        </div>
                        <div class="col-md-5">
                            <select name="id_type_praticien" class="form-control">
                                <option value="">-- Tous les types --</option>
                                @if(isset($types))
                                    @foreach($types as $type)
                                        <option value="{{ $type->id_type_praticien }}" {{ request('id_type_praticien') == $type->id_type_praticien ? 'selected' : '' }}>
                                            {{ $type->lib_type_praticien }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Rechercher</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tableau des résultats -->
        @if(isset($praticiens) && $praticiens->count() > 0)
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Type</th>
                    <th>Ville</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($praticiens as $p)
                    <tr>
                        <td>{{ $p->nom_praticien }}</td>
                        <td>{{ $p->prenom_praticien }}</td>
                        <td>{{ $p->typePraticien ? $p->typePraticien->lib_type_praticien : 'Non renseigné' }}</td>
                        <td>{{ $p->ville_praticien }}</td>
                        <td>
                            <!-- Bouton qui mène au CRUD des invitations -->
                            <a href="{{ route('invitations.index', $p->id_praticien) }}" class="btn btn-info btn-sm">Gérer les invitations</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @elseif(isset($praticiens))
            <div class="alert alert-warning">Aucun praticien trouvé pour cette recherche.</div>
        @endif
    </div>
@endsection
