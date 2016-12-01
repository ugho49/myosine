@extends('layouts.private')

@section('content')
    <p class="text-center">
        <a href="{{ URL::route('admin_tarif.create') }}" class="btn btn-success btn-raised" role="button">Créer un nouveau tarif</a>
    </p>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr class="text-center">
                        <th>Libellé</th>
                        <th>Tarif Plein</th>
                        <th>Tarif Etudiant</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tarifs as $tarif)
                        <tr data-id="{{ $tarif->id_tarif }}">
                            <td><p>{{ $tarif->nom_tarif }}</p></td>
                            <td>{{ $tarif->prix_tarif }} €</td>
                            <td>{{ $tarif->prixEtu_tarif }} €</td>
                            <td>
                                <a style="margin: 0px;" data-id="{{ $tarif->id_tarif }}" class="btn btn-info edit_tarif" href="{{ URL::route('admin_tarif.edit', $tarif->id_tarif) }}">
                                    Modifier &nbsp;<i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>
                                <a style="margin: 0px;" data-id="{{ $tarif->id_tarif }}" class="btn btn-danger remove_tarif" href="{{ URL::route('admin_tarif.remove', $tarif->id_tarif) }}">
                                    Supprimer &nbsp;<i class="fa fa-trash" aria-hidden="true"></i>
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
    <script>
        $(document).ready(function() {

            $('.remove_tarif:not("disabled")').click(function(e) {

                e.preventDefault();

                var buttonDelete = $(this);
                var id = buttonDelete.data('id');
                var buttonEdit = $('a.edit_tarif[data-id="'+ id +'"]');

                if (buttonDelete.attr('disabled')) {
                    return;
                }

                buttonDelete.attr('disabled','disabled');
                buttonEdit.attr('disabled','disabled');

                var url = buttonDelete.attr('href');

                bootbox.setLocale('fr');

                bootbox.confirm("Etes vous sur ?", function(result) {
                    if (result) {
                        $.get( url , function( data ) {
                            if (data) {
                                remove_tarif(id);
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

            function remove_tarif (id) {
                var tr = $('tr[data-id="'+ id +'"]');
                tr.fadeOut(300, function() {
                    $(this).remove();
                });
            }
        });
    </script>
@endsection