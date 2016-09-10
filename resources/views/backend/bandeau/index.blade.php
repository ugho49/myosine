@extends('layouts.private')

@section('content')
    <p class="text-justify">
        Cette page permet de gérer les news diffusées via le bandeau déroulant visible sur la page d'accueil.
        Ce bandeau n'est visible que lorsqu'il y a une ou plusieurs news active.
        Le bouton permanent signifie que la news sera visible en permanence sur la page tant que l'administrateur ne la supprime pas.
        Sinon une news possède une date de fin et ne sera plus affichée lorsque celle ci sera dépassé.
        Vous pouvez cumuler les news et les modifier via cette page.
    </p>
    <p class="text-justify">
        Uniquement les news actives sont affichés dans cette page de gestion !!
    </p>

    <p class="text-center">
        <a href="{{ URL::route('admin_bandeau.create') }}" class="btn btn-success btn-raised" role="button">Créer un nouveau message</a>
    </p>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>Libellé</th>
                            <th>Date fin</th>
                            <th>Permanent</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bandeaux as $b)
                            <tr data-id="{{ $b->id_sb }}">
                                <td><p>{{ $b->libelle_sb }}</p></td>
                                @if ($b->date_fin_sb != null)
                                    <td>{{ date_format(date_create_from_format('Y-m-d', $b->date_fin_sb), 'd/m/Y') }}</td>
                                    <td>Non</td>
                                @else
                                    <td>-</td>
                                    <td>Oui</td>
                                @endif
                                <td>
                                    <a style="margin: 0px;" data-id="{{ $b->id_sb }}" class="btn btn-info edit_bandeau" href="{{ URL::route('admin_bandeau.edit', $b->id_sb) }}">
                                        Modifier
                                    </a>
                                    <a style="margin: 0px;" data-id="{{ $b->id_sb }}" class="btn btn-danger remove_bandeau" href="{{ URL::route('admin_bandeau.remove', $b->id_sb) }}">
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
    <script src="{{URL::to('/')}}/bower_components/dropzone/dist/min/dropzone.min.js"></script>

    <script>
        $(document).ready(function() {

            $('.remove_bandeau:not("disabled")').click(function(e) {

                e.preventDefault();

                var buttonDelete = $(this);
                var id = buttonDelete.data('id');
                var buttonEdit = $('a.edit_bandeau[data-id="'+ id +'"]');

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
                                remove_photo(id);
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

            function remove_photo (id) {
                var tr = $('tr[data-id="'+ id +'"]');
                tr.fadeOut(300, function() {
                    $(this).remove();
                });
            }
        });
    </script>
@endsection