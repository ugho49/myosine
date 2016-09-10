@extends('layouts.private')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr class="text-center">
                        <th>Jour</th>
                        <th>Début</th>
                        <th>Fin</th>
                        <th>Matin/Après-midi</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($horaires as $horaire)
                        <tr data-id="{{ $horaire->id_horaire }}">
                            <td>{{ $horaire->jour_horaire }}</td>

                            @if($horaire->debut_horaire)
                                <td class="horaire_removable">{{ $horaire->debut_horaire }}</td>
                                <td class="horaire_removable">{{ $horaire->fin_horaire }}</td>
                            @else
                                <td>-</td>
                                <td>-</td>
                            @endif


                            @if($horaire->isMatin_horaire)
                                <td>Matin</td>
                            @else
                                <td>Après-midi</td>
                            @endif

                            <td>
                                <a style="margin: 0px;" data-id="{{ $horaire->id_horaire }}" class="btn btn-info edit_horaire" href="{{ URL::route('admin_horaire_ouv.edit', $horaire->id_horaire) }}">
                                    Modifier
                                </a>
                                @if($horaire->debut_horaire)
                                    <a style="margin: 0px;" data-id="{{ $horaire->id_horaire }}" class="btn btn-danger remove_horaire" href="{{ URL::route('admin_horaire_ouv.remove', $horaire->id_horaire) }}">
                                        Supprimer
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{URL::to('/')}}/bower_components/bootbox.js/bootbox.js"></script>

    <script>
        $(document).ready(function() {

            $('.remove_horaire:not("disabled")').click(function(e) {

                e.preventDefault();

                var buttonDelete = $(this);
                var id = buttonDelete.data('id');
                var buttonEdit = $('a.edit_horaire[data-id="'+ id +'"]');

                if (buttonDelete.attr('disabled')) {
                    return;
                }

                buttonDelete.attr('disabled','disabled');
                buttonEdit.attr('disabled','disabled');

                var url = buttonDelete.attr('href');

                console.log(url);

                bootbox.setLocale('fr');

                bootbox.confirm("Etes vous sur ?", function(result) {
                    if (result) {
                        $.get( url , function( data ) {
                            if (data) {
                                remove_horaire(id);
                            } else {
                                alert('erreur interne intervenue lors de la suppression');
                                buttonDelete.removeAttr('disabled');
                                buttonEdit.removeAttr('disabled');
                            }
                        });
                    }
                    buttonDelete.removeAttr('disabled');
                    buttonEdit.removeAttr('disabled');
                });

            });

            function remove_horaire (id) {
                var td = $('tr[data-id="'+ id +'"] td.horaire_removable');

                td.each(function() {
                    $(this).html('-');
                });

                var buttonDelete = $('tr[data-id="'+ id +'"] a.remove_horaire');
                buttonDelete.hide();
            }
        });
    </script>
@endsection