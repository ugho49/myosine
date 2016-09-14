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

            <form method="post" action="@if($action == 'edit') {{ URL::route('admin_users.update', $user->id) }} @elseif($action == 'create') {{ URL::route('admin_users.store') }} @endif">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="control-label">Nom :</label>
                    <input type="text" class="form-control input-md" id="name" placeholder="Prénom NOM" name="name" value="@if( old('name') ){{ old('name') }}@elseif( $user->name ){{ $user->name }}@endif" required="required">
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="control-label">Email :</label>
                    <input type="email" class="form-control input-md" id="email" placeholder="Email" name="email" value="@if( old('email') ){{ old('email') }}@elseif( $user->email ){{ $user->email }}@endif" required="required">
                </div>

                <div class="form-group{{ $errors->has('enabled') ? ' has-error' : '' }}">
                    <label class="control-label">Statut</label>

                    <div class="radio radio-primary">
                        <label>
                            <input type="radio" name="enabled" required="required" id="optionActivate" value="1" @if( (old('enabled') && old('enabled') == 1) or $user->enabled )checked="checked" @endif>
                            Utilisateur activé
                        </label>
                    </div>
                    <div class="radio radio-primary">
                        <label>
                            <input type="radio" name="enabled" required="required" id="optionDesactivate" value="0" @if( (old('enabled') && old('enabled') == 0) or !$user->enabled )checked="checked" @endif>
                            Utilisateur désactivé
                        </label>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('roles') ? ' has-error' : '' }}">
                    <label for="roles" class="control-label">Rôle(s)</label>

                    <select id="roles" name="roles[]" multiple="multiple" class="form-control" required="required">
                        @foreach($roles as $role)
                            @if( ($action == 'edit' && $user->hasRole($role->name)) )
                                <option selected="selected" value="{{ $role->name }}">{{ $role->label }}</option>
                            @else
                                <option value="{{ $role->name }}">{{ $role->label }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="text-center">
                    <a class="btn btn-lg btn-raised" href="{{ URL::route('admin_users') }}">Retour</a>

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