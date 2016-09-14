@extends('layouts.private')

@section('content')
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

            <form method="post" action="@if($action == 'edit') {{ URL::route('admin_type_cours.update', $type->id_typeC) }} @elseif($action == 'create') {{ URL::route('admin_type_cours.store') }} @endif">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('libelle') ? ' has-error' : '' }}">
                    <label for="libelle" class="control-label">Libelle :</label>
                    <input type="text" class="form-control input-md" id="libelle" placeholder="Nom du cours" name="libelle" value="@if( old('libelle') ){{ old('libelle') }}@elseif( $type->libelle_typeC ){{ $type->libelle_typeC }}@endif">
                </div>

                <div class="text-center">
                    <a class="btn btn-lg btn-raised" href="{{ URL::route('admin_type_cours') }}">Retour</a>

                    @if($action == 'edit')
                        <button class="btn btn-raised btn-info btn-lg" type="submit">Modifier</button>
                    @elseif($action == 'create')
                        <button class="btn btn-raised btn-success btn-lg button-create" type="submit">Créer</button>
                    @endif
                </div>

            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('form').submit(function(){
                $('button.button-create').attr('disabled','disabled');
            });
        });
    </script>
@endsection