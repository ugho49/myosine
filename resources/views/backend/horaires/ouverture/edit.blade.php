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

            <form method="post" action="{{ URL::route('admin_horaire_ouv.update', $horaire->id_horaire) }}">
                {{ csrf_field() }}

                <div class="row">
                    <div class="form-group col-xs-6">
                        <label for="jour" class="control-label">Jour :</label>
                        <input type="text" class="form-control input-md" id="jour" value="{{ $horaire->jour_horaire }}" disabled="disabled" readonly>
                    </div>

                    <div class="form-group col-xs-6">
                        <label for="type" class="control-label">Matin / Après-midi :</label>
                        <input type="text" class="form-control input-md" id="type" value="@if($horaire->isMatin_horaire) Matin @else Après-midi @endif" disabled="disabled" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-6 form-group{{ $errors->has('horaire_debut') ? ' has-error' : '' }}">
                        <label for="horaire_debut" class="control-label">Horaire Début :</label>
                        <input type="text" class="form-control input-md" id="horaire_debut" placeholder="Horaire de début au format : ..h.." name="horaire_debut" value="@if( old('horaire_debut') ){{ old('horaire_debut') }}@elseif( $horaire->debut_horaire ){{ $horaire->debut_horaire }}@endif">
                    </div>

                    <div class="col-xs-6 form-group{{ $errors->has('horaire_fin') ? ' has-error' : '' }}">
                        <label for="horaire_fin" class="control-label">Horaire Fin :</label>
                        <input type="text" class="form-control input-md" id="horaire_fin" placeholder="Horaire de fin au format : ..h.." name="horaire_fin" value="@if( old('horaire_fin') ){{ old('horaire_fin') }}@elseif( $horaire->fin_horaire ){{ $horaire->fin_horaire }}@endif">
                    </div>
                </div>

                <div class="text-center">
                    <a class="btn btn-lg btn-raised" href="{{ URL::route('admin_horaire_ouv') }}">Retour</a>
                    <button class="btn btn-raised btn-info btn-lg" type="submit">Modifier</button>
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