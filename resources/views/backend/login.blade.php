@extends('layouts.private')

@section('section_title', 'Administration')

@section('content')
    <br>
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
            <form method="post" action="{{ URL::route('login') }}">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{ csrf_field() }}
                <div class="jumbotron">
                    <h1>Identification</h1>
                    <div class="form-signin">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">Email :</label>
                            <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required="required">
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">Password :</label>
                            <input id="password" type="password" class="form-control" name="password" placeholder="Password" required="required"/>
                        </div>

                        <p>
                            <button class="btn btn-lg btn-info btn-block btn-raised" type="submit">Connexion</button>
                            <a href="#" class="btn btn-lg btn-warning btn-block" role="button" data-toggle="modal" data-target="#modalResetPassword">Mot de passe oublié</a>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal" id="modalResetPassword" aria-hidden="true" role="dialog">
        <form method="post" action="{{ URL::route('password.reset') }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h1 class="modal-title">Mot de passe oublié</h1>
                    </div>
                    <div class="modal-body">
                        <p>
                            Rentrer votre adresse email afin de réinitialiser votre mot de passe.
                            Un nouveau vous sera envoyé par mail.
                        </p>

                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="email" class="control-label">Email :</label>
                                <input id="email" type="email" class="form-control" placeholder="Email" name="email" required="required">
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-info">Réinitialiser le mot de passe</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection