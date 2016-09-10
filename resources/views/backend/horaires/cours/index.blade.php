@extends('layouts.private')

@section('content')
    <p class="text-center">
        <a href="#" class="btn btn-info btn-raised" role="button">Gérer les types de cours</a>
        <a href="{{ URL::route('admin_horaire_cours.create') }}" class="btn btn-success btn-raised" role="button">Créer un nouvel horaire</a>
    </p>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr class="text-center">
                        <th>Jour</th>
                        <th>Début</th>
                        <th>Fin</th>
                        <th>Type de cours</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($horaires as $horaire)
                        <tr data-id="{{ $horaire->id_cours }}">
                            <td>{{ $horaire->jour_cours }}</td>
                            <td>{{ $horaire->debut_cours }}</td>
                            <td>{{ $horaire->fin_cours }}</td>
                            <td>{{ $horaire->type->libelle_typeC }}</td>
                            <td>
                                <a style="margin: 0px;" data-id="{{ $horaire->id_cours }}" class="btn btn-info edit_horaire" href="{{ URL::route('admin_horaire_cours.edit', $horaire->id_cours) }}">
                                    Modifier
                                </a>
                                <a style="margin: 0px;" data-id="{{ $horaire->id_cours }}" class="btn btn-danger remove_horaire" href="{{ URL::route('admin_horaire_cours.remove', $horaire->id_cours) }}">
                                    Supprimer
                                </a>
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
                var tr = $('tr[data-id="'+ id +'"]');
                tr.fadeOut(300, function() {
                    $(this).remove();
                });
            }
        });
    </script>
@endsection