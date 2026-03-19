@extends('layouts.master')

@section('content')
    <form method="POST" action="{{ url('/validInviter') }}">
        @csrf
        <h1>@if($frais->id_frais) Modification @else Ajout @endif Fiche de frais</h1>
        <input type="hidden" name="id" value="{{$frais->id_frais}}">

        <div class="col-md-12 card card-body bg-light">
            <div class="form-group">
                <label class="col-md-3">Mois</label>
                <div class="col-md-6">
                    <input type="text" name="mois" class="form-control" maxlength="7" value="{{$frais->anneemois}}" placeholder="MM-AAAA" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3">titre</label>
                <div class="col-md-6">
                    <input type="text" name="titre" class="form-control" maxlength="7" value="{{$frais->titre}}" placeholder="titre" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3">Montant saisi</label>
                <div class="col-md-6">
                    <input type="number" name="total" class="form-control " min="0" step="0.01" value="" disabled>
                </div>
                <div class="col-md-12 col-md-offset-3">
                    <a href="{{url('/listerFraisHF/'.$frais->id_frais)}}" class="btn btn-info @if(!$frais->id_frais) disabled @endif">Frais hors forfait</a>

                    <a href="" class="btn btn-info @if(!$frais->id_frais)disabled @endif">Frais au forfait</a>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Nb justificatifs</label>
                <div class="col-md-6">
                    <input type="number" name="nbjustif" class="form-control" min="0" value="{{$frais->nbjustificatifs}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Montant validé</label>
                <div class="col-md-6">
                    <input type="number" name="valide" class="form-control" min="0" step="0.01" value="{{$frais->montantvalide}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Etat</label>
                <div class="col-md-6">
                    <select name="etat" id="etat" class="form-control" >
                        @foreach($etats as $etat)
                            <option value="{{ $etat->id_etat }}" {{ $etat->id_etat == $frais->id_etat ? 'selected' : '' }}>
                                {{ $etat->lib_etat }}
                            </option>

                        @endforeach
                    </select>
                </div>
            </div>
            @if(isset($frais->id_frais))
                <div class="form-group">
                    <a href="{{url('/supprimerFrais/'.$frais->id_frais)}}"
                       id="suppr" class="btn btn-danger"
                       onclick="return confirm ('supprimer cette fiche de frais')">
                        Supprimer
                    </a>
                </div>
            @endif

            <hr>

            <button type="submit" class="btn btn-primary">valider</button>



        </div>
    </form>

    @if(isset($erreur))
        <div class="alert alert-danger" role="alert">{{ $erreur }}</div>
    @endif
@endsection
