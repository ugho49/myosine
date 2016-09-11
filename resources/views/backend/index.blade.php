@extends('layouts.private')

@section('style')
    <link rel="stylesheet" href="{{URL::to('/')}}/css/admin.css">
@endsection

@section('admin_menu')
    <br>
    <div class="row">
        <div class="col-lg-10 col-md-9 col-sm-9 col-xs-7">
            <p>Connecté : {{ Auth::user()->name }}</p>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-5">
            <a href="{{ URL::route('logout') }}" class="btn btn-danger btn-raised btn-sm" role="button" style="margin: 0px;">
                Déconnexion
            </a>
        </div>
    </div>
    <hr style="margin-bottom: 10px; margin-top: 0px;">
@endsection

@section('content')

    <div class="row admin_menu">
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
            <a href="{{  URL::route('admin_bandeau') }}" class="thumbnail">
                <div class="caption text-center">
                    <h4>Bandeau déroulant</h4>
                </div>

                <img src="{{URL::to('/')}}/icons/vector_news.png" />
            </a>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
            <a href="{{  URL::route('admin_photo') }}" class="thumbnail">
                <div class="caption text-center">
                    <h4>Photos</h4>
                </div>

                <img src="{{URL::to('/')}}/icons/vector_photo.png" />
            </a>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
            <a href="{{  URL::route('admin_tarif') }}" class="thumbnail">
                <div class="caption text-center">
                    <h4>Tarifs</h4>
                </div>

                <img src="{{URL::to('/')}}/icons/vector_tarif.png" />
            </a>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
            <a href="{{  URL::route('admin_horaire_ouv') }}" class="thumbnail">
                <div class="caption text-center">
                    <h4>Horaires d'ouverture</h4>
                </div>

                <img src="{{URL::to('/')}}/icons/vector_horaire_ouv.png" />
            </a>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
            <a href="{{  URL::route('admin_horaire_cours') }}" class="thumbnail">
                <div class="caption text-center">
                    <h4>Horaires des cours</h4>
                </div>

                <img src="{{URL::to('/')}}/icons/vector_horaire_cours.png" />
            </a>
        </div>

        @if(Auth::user()->hasRole('root'))
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                <a href="{{  URL::route('admin_users') }}" class="thumbnail">
                    <div class="caption text-center">
                        <h4>Gestion des utilisateurs</h4>
                    </div>

                    <img src="{{URL::to('/')}}/icons/vector_user.png" />
                </a>
            </div>
        @endif

        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
            <a href="{{  URL::route('admin_settings') }}" class="thumbnail">
                <div class="caption text-center">
                    <h4>Paramètres</h4>
                </div>

                <img src="{{URL::to('/')}}/icons/vector_settings.png" />
            </a>
        </div>
    </div>
@endsection