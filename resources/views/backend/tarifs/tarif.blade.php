@extends('layouts.private')

@section('content')

    <p class="text-center">
        <a class="btn btn-lg btn-raised" href="{{ URL::route('admin_tarif') }}">Retour</a>
    </p>

    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="post" action="@if($action == 'edit') {{ URL::route('admin_tarif.update', $tarif->id_tarif) }} @elseif($action == 'create') {{ URL::route('admin_tarif.store') }} @endif">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('libelle') ? ' has-error' : '' }}">
                    <label for="libelle" class="control-label">Nom de la formule :</label>
                    <input type="text" class="form-control input-md" id="libelle" placeholder="Nom de la formule" name="libelle" value="@if( old('libelle') ){{ old('libelle') }}@elseif( $tarif->nom_tarif ){{ $tarif->nom_tarif }}@endif" required="required">
                </div>

                <div class="form-group{{ $errors->has('prix_normal') ? ' has-error' : '' }}">
                    <label for="prix_normal" class="control-label">Prix normal :</label>
                    <input type="number" min="0" class="form-control input-md" id="prix_normal" placeholder="Prix normal" name="prix_normal" value="@if( old('prix_normal') ){{ old('prix_normal') }}@elseif( $tarif->prix_tarif ){{ $tarif->prix_tarif }}@endif" required="required">
                </div>

                <div class="form-group{{ $errors->has('prix_etudiant') ? ' has-error' : '' }}">
                    <label for="prix_etudiant" class="control-label">Prix etudiant :</label>
                    <input type="number" min="0" class="form-control input-md" id="prix_etudiant" placeholder="Prix etudiant" name="prix_etudiant" value="@if( old('prix_etudiant') ){{ old('prix_etudiant') }}@elseif( $tarif->prixEtu_tarif ){{ $tarif->prixEtu_tarif }}@endif" required="required">
                </div>

                <div class="text-center">
                    @if($action == 'edit')
                        <button class="btn btn-raised btn-info btn-lg" type="submit">Modifier</button>
                    @elseif($action == 'create')
                        <button class="btn btn-raised btn-success btn-lg" type="submit">Créer</button>
                    @endif
                </div>

            </form>
        </div>
    </div>
@endsection