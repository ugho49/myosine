@extends('layouts.private')

@section('admin_menu')
    <br>
    <div class="row">
        <div class="col-lg-10 col-md-9 col-sm-9 col-xs-7">
            <p>Connecté : {{ Auth::user()->name }}</p>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-5">
            <a href="{{ URL::route('logout') }}" class="btn btn-danger btn-raised btn-sm" role="button" style="margin: 0px;">Déconnexion &nbsp;<i class="fa fa-lock" aria-hidden="true"></i></a>
        </div>
    </div>
    <hr style="margin-bottom: 10px; margin-top: 0px;">
@endsection

@section('content')

    <div class="row admin_menu">

        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
            <a href="{{  URL::route('admin_bandeau') }}">
                <div class="panel panel-default text-center text-uppercase">
                    <div class="panel-heading">
                        <i class="fa fa-commenting fa-2x" aria-hidden="true"></i>
                    </div>
                    <div class="panel-body">
                        Bandeau déroulant
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
            <a href="{{  URL::route('admin_photo') }}">
                <div class="panel panel-default text-center text-uppercase">
                    <div class="panel-heading">
                        <i class="fa fa-camera fa-2x" aria-hidden="true"></i>
                    </div>
                    <div class="panel-body">
                        Photos
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
            <a href="{{  URL::route('admin_tarif') }}">
                <div class="panel panel-default text-center text-uppercase">
                    <div class="panel-heading">
                        <i class="fa fa-eur fa-2x" aria-hidden="true"></i>
                    </div>
                    <div class="panel-body">
                        Tarifs
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
            <a href="{{  URL::route('admin_horaire_ouv') }}">
                <div class="panel panel-default text-center text-uppercase">
                    <div class="panel-heading">
                        <i class="fa fa-clock-o fa-2x" aria-hidden="true"></i>
                    </div>
                    <div class="panel-body">
                        Horaires d'ouverture
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
            <a href="{{  URL::route('admin_horaire_cours') }}">
                <div class="panel panel-default text-center text-uppercase">
                    <div class="panel-heading">
                        <i class="fa fa-clock-o fa-rotate-90 fa-2x" aria-hidden="true"></i>
                    </div>
                    <div class="panel-body">
                        Horaires des cours
                    </div>
                </div>
            </a>
        </div>

        @if(Auth::user()->hasRole('root'))
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
            <a href="{{  URL::route('admin_users') }}">
                <div class="panel panel-default text-center text-uppercase">
                    <div class="panel-heading">
                        <i class="fa fa-users fa-2x" aria-hidden="true"></i>
                    </div>
                    <div class="panel-body">
                        Gestion des utilisateurs
                    </div>
                </div>
            </a>
        </div>
        @endif

        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
            <a href="{{  URL::route('admin_settings') }}">
                <div class="panel panel-default text-center text-uppercase">
                    <div class="panel-heading">
                        <i class="fa fa-cogs fa-2x" aria-hidden="true"></i>
                    </div>
                    <div class="panel-body">
                        Paramètres
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection