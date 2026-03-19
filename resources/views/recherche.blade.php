@extends('layouts.master')
@section('content')

    <h1>Recherche d'un praticien</h1>

    <form action="{{ route('recherche.praticien') }}" method="GET">
        <input type="text" name="laRecherche" value="{{ $query ?? '' }}" placeholder="Nom du praticien">
        <button type="submit">Chercher</button>
    </form>

    <br>

    @if(isset($praticiens) && $praticiens->count() > 0)
        <table>
            <tr>
                <td>Nom praticien</td>
                <td>Prenom praticien</td>
                <td>Adresse praticien</td>
                <td>Formulaire</td>
            </tr>

                @foreach($praticiens as $praticien)

                       <tr><td>{{ $praticien->nom_praticien }}</td>
                        <td>{{ $praticien->prenom_praticien }}</td>
                        <td>({{ $praticien->ville_praticien }})</td>
                           <td><a href="{{url('/editerInvite/'.$praticien->id_frais )}}">Modifier</a> </td>
                       </tr>
                @endforeach
        </table>


    @elseif(isset($query) && $query != '')
        <p>Aucun praticien trouvé pour la recherche "{{ $query }}".</p>
    @endif
@endsection
