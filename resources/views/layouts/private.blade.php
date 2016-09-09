@extends('layouts.public')

@section('title', 'Administration de la salle de sport Myosine')
@section('description', "Administration et gestion du site Myosine. Page réservé uniquement aux administrateurs.")

@section('section_title', 'Administration')

@section('style')
    <link rel="stylesheet" href="{{URL::to('/')}}/css/admin.css">
@endsection

@section('admin_menu')
    @if (!Auth::guest())
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
        @if(Request::url() != URL::route('admin'))
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-12 col-xs-12 text-center">
                    <a href="{{ URL::route('admin') }}" class="btn btn-info btn-raised btn-lg" role="button">
                        << Retour au menu >>
                    </a>
                </div>
            </div>
        @endif
        <hr>
    @endif

@endsection