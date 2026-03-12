@extends('layouts.master')
@section('content')
    <div>
        <h1>Top spécialité</h1>
    </div>
    <table class="table table-bordered table-striped">
        <thread>
            <tr>
                <th>Spécialité</th>
                <th>Nombre total de praticiens invités</th>
            </tr>
        </thread>
        @foreach($fiches as $fr)
            <tr>
                <td>{{$fr->lib_specialite}}</td>
                <td>{{$fr->total_invitations}}</td>
            </tr>

        @endforeach
    </table>

@endsection
