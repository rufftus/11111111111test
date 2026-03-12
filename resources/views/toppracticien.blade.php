@extends('layouts.master')
@section('content')
    <div>
        <h1>Liste des praticiens</h1>
    </div>
    <table class="table table-bordered table-striped">
        <thread>
            <tr>
                <th>Numero spécialité</th>
                <th>Spécialité</th>
                <th>Theme de l'activite</th>
                <th>Motif</th>
                <th>Nombre de praticiens invités à des
                    activités complémentaires. </th>

            </tr>
        </thread>
        @foreach($fiches as $fr)
            <tr>
                <td>{{$fr->id_specialite}}</td>
                <td>{{$fr->lib_specialite}}</td>
                <td>{{$fr->theme_activite}}</td>
                <td>{{$fr->motif_activite}}</td>
                <td>{{$fr->total_invitations}}</td>
            </tr>

        @endforeach
    </table>

@endsection
