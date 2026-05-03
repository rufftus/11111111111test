@extends('layouts.master')
@section('content')
    <div class="container mt-5">
        <h2>Recherche de Praticiens</h2>
        <form action="{{ route('praticiens.recherche') }}" method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="nom" class="form-control" placeholder="Nom du praticien" value="{{ request('nom') }}">
                </div>
                <div class="col-md-4">
                    <select name="id_type_praticien" class="form-control">
                        <option value="">Tous les types</option>
                        @foreach($types as $type)
                            <option value="{{ $type->id_type_praticien }}" {{ request('id_type_praticien') == $type->id_type_praticien ? 'selected' : '' }}>
                                {{ $type->lib_type_praticien }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Rechercher</button>
                </div>
            </div>
        </form>

        <table class="table table-bordered">
            <thead>
            <tr><th>Nom</th><th>Prénom</th><th>Type</th><th>Ville</th><th>Actions</th></tr>
            </thead>
            <tbody>
            @foreach($praticiens as $p)
                <tr>
                    <td>{{ $p->nom_praticien }}</td>
                    <td>{{ $p->prenom_praticien }}</td>
                    <td>{{ $p->typePraticien->lib_type_praticien ?? 'N/A' }}</td>
                    <td>{{ $p->ville_praticien }}</td>
                    <td>
                        <a href="{{ route('invitations.index', $p->id_praticien) }}" class="btn btn-info btn-sm">Gérer Invitations</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
