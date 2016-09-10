@extends('layouts.private')

@section('style')
    <link rel="stylesheet" href="{{URL::to('/')}}/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
@endsection

@section('content')

    <p class="text-center">
        <a class="btn btn-lg btn-raised" href="{{ URL::route('admin_horaire_cours') }}">Retour</a>
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

            <form method="post" action="@if($action == 'edit') {{ URL::route('admin_horaire_cours.update', $horaire->id_cours) }} @elseif($action == 'create') {{ URL::route('admin_horaire_cours.store') }} @endif">
                {{ csrf_field() }}

                <div class="row">
                    <div class="col-xs-6 form-group{{ $errors->has('num_jour') ? ' has-error' : '' }}">
                        <label for="jour" class="control-label">Jour :</label>

                        <select id="type" class="form-control" name="num_jour" @if($action == 'edit')disabled="disabled" readonly @endif>
                            @if($action == 'create')
                                <option selected="selected" disabled="disabled">Séléctionner un jour</option>
                            @endif

                            @foreach($jours as $jour)
                                @if( ($action == 'edit' && $jour['num'] == $horaire->num_jour) || $jour['num'] == old('num_jour') )
                                    <option selected="selected" value="{{ $jour['num'] }}">{{ $jour['name'] }}</option>
                                @else
                                    <option value="{{ $jour['num'] }}">{{ $jour['name'] }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="col-xs-6 form-group{{ $errors->has('type_cours') ? ' has-error' : '' }}">
                        <label for="type" class="control-label">Type :</label>

                        <select id="type" class="form-control" name="type_cours">
                            @if($action == 'create')
                                <option selected="selected" disabled="disabled">Séléctionner un type de cours</option>
                            @endif

                            @foreach($types as $type)
                                @if( ($action == 'edit' && $horaire->id_typeC == $type->id_typeC) || $type->id_typeC == old('type_cours') )
                                    <option selected="selected" value="{{ $type->id_typeC }}">{{ $type->libelle_typeC }}</option>
                                @else
                                    <option value="{{ $type->id_typeC }}">{{ $type->libelle_typeC }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-6 form-group{{ $errors->has('horaire_debut') ? ' has-error' : '' }}">
                        <label for="horaire_debut" class="control-label">Horaire Début :</label>
                        <input type="text" class="form-control input-md" id="horaire_debut" placeholder="Horaire de début au format : ..h.." name="horaire_debut" value="@if( old('horaire_debut') ){{ old('horaire_debut') }}@elseif( $horaire->debut_cours ){{ $horaire->debut_cours }}@endif">
                    </div>

                    <div class="col-xs-6 form-group{{ $errors->has('horaire_fin') ? ' has-error' : '' }}">
                        <label for="horaire_fin" class="control-label">Horaire Fin :</label>
                        <input type="text" class="form-control input-md" id="horaire_fin" placeholder="Horaire de fin au format : ..h.." name="horaire_fin" value="@if( old('horaire_fin') ){{ old('horaire_fin') }}@elseif( $horaire->fin_cours ){{ $horaire->fin_cours }}@endif">
                    </div>
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

@section('script')
    <script type="text/javascript" src="{{URL::to('/')}}/bower_components/moment/min/moment.min.js"></script>
    <script type="text/javascript" src="{{URL::to('/')}}/bower_components/moment/locale/fr.js"></script>
    <script type="text/javascript" src="{{URL::to('/')}}/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

    <script type="text/javascript">
        $(function () {
            $('#horaire_debut').datetimepicker({
                locale: 'fr',
                format: 'HH[h]mm'
            });

            $('#horaire_fin').datetimepicker({
                locale: 'fr',
                format: 'HH[h]mm',
                useCurrent: false
            });

            $("#horaire_debut").on("dp.change", function (e) {
                $('#horaire_fin').data("DateTimePicker").minDate(e.date);
            });
            $("#horaire_fin").on("dp.change", function (e) {
                $('#horaire_debut').data("DateTimePicker").maxDate(e.date);
            });
        });
    </script>
@endsection