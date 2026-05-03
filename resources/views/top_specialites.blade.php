@extends('layouts.master')
@section('content')
    <div class="container mt-5">
        <h2>Top 5 des spécialités (Praticiens invités)</h2>
        <table class="table table-striped mt-3">
            <thead>
            <tr><th>Spécialité</th><th>Nombre de praticiens invités</th></tr>
            </thead>
            <tbody>
            @foreach($topSpecialites as $ts)
                <tr>
                    <td>{{ $ts->lib_specialite }}</td>
                    <td><span class="badge badge-success">{{ $ts->nb_invites }}</span></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
