@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        <h1>Les 5 spécialités avec le plus de praticiens invités</h1>

        <table class="table table-bordered table-striped mt-3">
            <thead>
            <tr>
                <th>Classement</th>
                <th>Spécialité</th>
                <th>Total invitations</th>
            </tr>
            </thead>
            <tbody>
            @php $classement = 1; @endphp
            @foreach($specialites as $spec)
                <tr>
                    <td>{{ $classement }}</td>
                    <td>{{ $spec->lib_specialite }}</td>
                    <td>{{ $spec->total_invitations }}</td>
                </tr>
                @php $classement++; @endphp
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
