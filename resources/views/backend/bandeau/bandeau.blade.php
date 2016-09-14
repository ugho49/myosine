@extends('layouts.private')

@section('style')
    <link rel="stylesheet" href="{{URL::to('/')}}/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
@endsection

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

            <form method="post" action="@if($action == 'edit') {{ URL::route('admin_bandeau.update', $bandeau->id_sb) }} @elseif($action == 'create') {{ URL::route('admin_bandeau.store') }} @endif">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                    <label for="message" class="control-label">Message :</label>
                    <input type="text" class="form-control input-md" id="message" placeholder="Message" name="message" value="@if( old('message') ){{ old('message') }}@elseif( $bandeau->libelle_sb ){{ $bandeau->libelle_sb }}@endif" required="required">
                </div>

                <div class="form-group{{ $errors->has('date_fin') ? ' has-error' : '' }}">
                    <label for="date_fin" class="control-label">Date de fin (Laisser vide si le message est permanent) :</label>
                    <input type="text" class="form-control input-md" id="date_fin" placeholder="Date de fin" name="date_fin" value="@if( old('date_fin') ){{ old('date_fin') }}@elseif( $bandeau->date_fin_sb ){{ date_format(date_create_from_format('Y-m-d', $bandeau->date_fin_sb), 'd/m/Y')}}@endif">
                </div>

                <div class="text-center">
                    <a class="btn btn-lg btn-raised" href="{{ URL::route('admin_bandeau') }}">Retour</a>

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
    <script type="text/javascript" src="{{URL::to('/')}}/bower_components/moment/min/moment.min.js"></script>
    <script type="text/javascript" src="{{URL::to('/')}}/bower_components/moment/locale/fr.js"></script>
    <script type="text/javascript" src="{{URL::to('/')}}/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('form').submit(function(){
                $('button.button-create').attr('disabled','disabled');
            });

            $('#date_fin').datetimepicker({
                useCurrent: false,
                locale: 'fr',
                format: 'DD/MM/YYYY',
                minDate: moment(),
                disabledDates: [moment()]
            });
        });
    </script>
@endsection