@extends('layouts.private')

@section('content')

    <div class="row">
        <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                <li role="presentation" @if( URL::full()  == (URL::route('admin_settings').'?type=info_salle') || URL::full()  == URL::route('admin_settings') ) class="active" @endif>
                    <a href="#info_salle" aria-controls="info_salle" role="tab" data-toggle="tab">Informations de la salle</a>
                </li>
                <li role="presentation" @if( URL::full()  == URL::route('admin_settings').'?type=info_user') ) class="active" @endif>
                    <a href="#info_user" aria-controls="info_user" role="tab" data-toggle="tab">Informations de l'administrateur</a>
                </li>
                <li role="presentation" @if( URL::full() == (URL::route('admin_settings').'?type=update_password') ) class="active" @endif>
                    <a href="#update_password" aria-controls="update_password" role="tab" data-toggle="tab">Changer de mot de passe</a>
                </li>
            </ul>

            @if (count($errors) > 0)
                <br>
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" id="info_salle" class="tab-pane fade @if( URL::full()  == (URL::route('admin_settings').'?type=info_salle') || URL::full()  == URL::route('admin_settings') ) active in @endif">
                    <h2>Informations de la salle :</h2>

                    <form method="post" action="{{ URL::route('informations.update') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="phone" class="control-label">Téléphone :</label>
                            <input type="text" class="form-control input-md" id="phone" placeholder="Téléphone" name="phone" value="{{ $informations->tel_salle }}" required="required">
                        </div>

                        <div class="form-group">
                            <label for="adresse" class="control-label">Adresse :</label>
                            <textarea class="form-control input-md" id="adresse" placeholder="Adresse de la salle" name="adresse" required="required">{{ $informations->adresse_salle }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="email" class="control-label">Email pour la page de contact :</label>
                            <input type="email" class="form-control input-md" id="email" placeholder="Email pour la page de contact" name="email" value="{{ $informations->mail_salle }}" required="required">
                        </div>

                        <div class="text-center">
                            <button class="btn btn-raised btn-success btn-lg" type="submit">Modifier</button>
                        </div>
                    </form>
                </div>

                <div role="tabpanel" id="info_user" class="tab-pane fade @if( URL::full()  == (URL::route('admin_settings').'?type=info_user') ) active in @endif">
                    <h2>Informations de l'administrateur :</h2>

                    <form method="post" action="{{ URL::route('user.update') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name" class="control-label">Prénom - NOM :</label>
                            <input type="text" class="form-control input-md" id="name" placeholder="Prénom NOM" name="name" value="{{ $user->name }}" required="required">
                        </div>

                        <div class="form-group">
                            <label for="email" class="control-label">Email :</label>
                            <input type="email" class="form-control input-md" id="email" placeholder="email" name="email" value="{{ $user->email }}" required="required">
                        </div>

                        <div class="row">
                            <div class="form-group col-xs-6">
                                <label for="last_ip" class="control-label">Dernière IP :</label>
                                <input type="text" class="form-control input-md" id="last_ip" value="{{ $user->last_ip }}" disabled="disabled" readonly>
                            </div>

                            <div class="form-group col-xs-6">
                                <label for="last_ip" class="control-label">Date de dernière modification :</label>
                                <input type="text" class="form-control input-md" id="last_ip" value="Le {{ date_format($user->updated_at, "d-m-Y à H:m:s") }}" disabled="disabled" readonly>
                            </div>
                        </div>

                        <div class="text-center">
                            <button class="btn btn-raised btn-success btn-lg" type="submit">Modifier</button>
                        </div>
                    </form>
                </div>

                <div role="tabpanel" id="update_password" class="tab-pane fade @if( URL::full()  == (URL::route('admin_settings').'?type=update_password') ) active in @endif">
                    <h2>Changer de mot de passe :</h2>

                    <form method="post" action="{{ URL::route('user.password.update') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
                            <label for="old_password" class="control-label">Ancien mot de passe :</label>
                            <input type="password" class="form-control input-md" id="old_password" placeholder="Ancien mot de passe" name="old_password" required="required">
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">Nouveau mot de passe :</label>
                            <input type="password" class="form-control input-md" id="password" placeholder="Nouveau mot de passe" name="password" required="required">
                        </div>

                        <div class="form-group{{ $errors->has('password_confirm') ? ' has-error' : '' }}">
                            <label for="password_confirm" class="control-label">Répéter le nouveau mot de passe :</label>
                            <input type="password" class="form-control input-md" id="password_confirm" placeholder="Répéter le nouveau mot de passe" name="password_confirm" required="required">
                        </div>

                        <div class="text-center">
                            <button class="btn btn-raised btn-success btn-lg" type="submit">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection