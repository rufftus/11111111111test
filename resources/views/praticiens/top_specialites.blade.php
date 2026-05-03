@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Top 5 des Spécialités</h2>
        <p class="text-muted">Spécialités comptant le plus de praticiens invités à des activités complémentaires.</p>

        <table class="table table-bordered table-striped mt-4">
            <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Nom de la spécialité</th>
                <th>Nombre de praticiens invités</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($topSpecialites) && $topSpecialites->count() > 0)
                @foreach($topSpecialites as $index => $ts)
                    <tr>
                        <td><strong>{{ $index + 1 }}</strong></td>
                        <td>{{ $ts->lib_specialite }}</td>
                        <td>
                        <span class="badge badge-success" style="font-size: 14px;">
                            {{ $ts->nb_invites }} praticien(s)
                        </span>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3" class="text-center">Aucune donnée disponible.</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
@endsection
