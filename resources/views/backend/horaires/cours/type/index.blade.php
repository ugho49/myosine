@extends('layouts.private')

@section('content')
    <p class="text-center">
        <a href="{{ URL::route('admin_type_cours.create') }}" class="btn btn-success btn-raised" role="button">Créer un nouveau type de cours</a>
    </p>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr class="text-center">
                        <th>Nom du cours</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($types as $type)
                        <tr data-id="{{ $type->id_typeC }}">
                            <td>{{ $type->libelle_typeC }}</td>
                            <td>
                                <a style="margin: 0px;" data-id="{{ $type->id_typeC }}" class="btn btn-info edit_type" href="{{ URL::route('admin_type_cours.edit', $type->id_typeC) }}">
                                    Modifier
                                </a>
                                <a style="margin: 0px;" data-id="{{ $type->id_typeC }}" class="btn btn-danger remove_type" href="{{ URL::route('admin_type_cours.remove', $type->id_typeC) }}">
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
    <script>
        $(document).ready(function() {

            $('.remove_type:not("disabled")').click(function(e) {

                e.preventDefault();

                var buttonDelete = $(this);
                var id = buttonDelete.data('id');
                var buttonEdit = $('a.edit_type[data-id="'+ id +'"]');

                if (buttonDelete.attr('disabled')) {
                    return;
                }

                buttonDelete.attr('disabled','disabled');
                buttonEdit.attr('disabled','disabled');

                var url = buttonDelete.attr('href');

                bootbox.setLocale('fr');

                bootbox.confirm("Etes vous sur ?", function(result) {
                    if (result) {
                        $.get( url , function( res ) {
                            if (!res.error) {
                                remove_type(id);
                            } else {
                                bootbox.alert(res.message);
                                buttonDelete.removeAttr('disabled');
                                buttonEdit.removeAttr('disabled');
                            }
                        });
                    }
                    buttonDelete.removeAttr('disabled');
                    buttonEdit.removeAttr('disabled');
                });

            });

            function remove_type (id) {
                var tr = $('tr[data-id="'+ id +'"]');
                tr.fadeOut(300, function() {
                    $(this).remove();
                });
            }
        });
    </script>
@endsection