@extends('layouts.private')

@section('style')
    <style>
        #edit_users tr td {
            vertical-align: middle !important;
        }
    </style>
@endsection

@section('content')
    <p class="text-center">
        <a href="{{ URL::route('admin_users.create') }}" class="btn btn-success btn-raised" role="button">Créer un nouvel utilisateur</a>
    </p>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-hover table-striped" id="edit_users">
                    <thead>
                    <tr class="text-center">
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Créé le</th>
                        <th>Dernière IP</th>
                        <th>Statut</th>
                        <th>Rôles</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr data-id="{{ $user->id }}" @if(!$user->enabled) class="danger" @endif>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ date_format($user->created_at, "d-m-Y") }}</td>
                            <td>{{ $user->last_ip }}</td>
                            <td>
                                @if($user->enabled)
                                    <span class="status">Activé</span>
                                @else
                                    <span class="status">Désactivé</span>
                                @endif
                            </td>
                            <td>
                                @foreach($user->getRoles() as $role)
                                    <span>{{ $role->label }} </span>
                                @endforeach
                            </td>
                            <td>
                                @if(Auth::user()->id != $user->id)
                                    <a style="margin: 0px;" data-id="{{ $user->id }}" class="btn btn-info edit_user" href="{{ URL::route('admin_users.edit', $user->id) }}">
                                        Modifier
                                    </a>
                                    <a style="margin: 0px; @if(!$user->enabled) display:none; @endif;" data-id="{{ $user->id }}" data-activate="false" class="btn btn-danger activate_user" href="{{ URL::route('admin_users.desactivate', $user->id) }}">
                                        Désactiver
                                    </a>
                                    <a style="margin: 0px; @if($user->enabled) display:none; @endif;" data-id="{{ $user->id }}" data-activate="true" class="btn btn-success activate_user" href="{{ URL::route('admin_users.activate', $user->id) }}">
                                        Activer
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

            $('.activate_user:not("disabled")').click(function(e) {

                e.preventDefault();

                var buttonDelete = $(this);
                var id = buttonDelete.data('id');
                var buttonEdit = $('a.edit_user[data-id="'+ id +'"]');

                if (buttonDelete.attr('disabled')) {
                    return;
                }

                buttonDelete.attr('disabled','disabled');
                buttonEdit.attr('disabled','disabled');

                var url = buttonDelete.attr('href');
                var activate = buttonDelete.data('activate');

                bootbox.setLocale('fr');

                bootbox.confirm("Etes vous sur ?", function(result) {
                    if (result) {
                        $.get( url , function( res ) {
                            if (!res.error) {
                                activate_user(id, activate);
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

            function activate_user(id, activate) {
                var tr = $('tr[data-id="'+ id +'"]');
                var buttonActivate = $('tr[data-id="'+ id +'"] a[data-activate="true"]');
                var buttonDesactivate = $('tr[data-id="'+ id +'"] a[data-activate="false"]');
                var spanStatus = $('tr[data-id="'+ id +'"] span.status');

                if (activate) {
                    buttonDesactivate.show();
                    buttonActivate.hide();
                    spanStatus.html('Activé');
                    tr.removeClass('danger');
                } else {
                    buttonDesactivate.hide();
                    buttonActivate.show();
                    spanStatus.html('Désactivé');
                    tr.addClass('danger');
                }
            }
        });
    </script>
@endsection