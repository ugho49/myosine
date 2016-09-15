@extends('layouts.public')

@section('title', 'Administration de la salle de sport Myosine')
@section('description', "Administration et gestion du site Myosine. Page réservé uniquement aux administrateurs.")

@section('style')
    <link rel="stylesheet" href="{{ URL::to('/') . elixir('css/vendor_admin.css') }}">
@append

@section('admin_menu')
    @if (!Auth::guest())
        @if(Session::has('breadcrumb'))
            <br>
            <ol class="breadcrumb">
                @for($i = 0; $i < count(Session::get('breadcrumb')); $i++)
                    @if( ($i + 1) == count(Session::get('breadcrumb')) )
                        <li class="active">{{ Session::get('breadcrumb')[$i]['name'] }}</li>
                    @else
                        <li><a href="{{ Session::get('breadcrumb')[$i]['url'] }}">{{ Session::get('breadcrumb')[$i]['name'] }}</a></li>
                    @endif
                @endfor
            </ol>
        @endif
    @endif
@endsection

@section('script')
    <script src="{{ URL::to('/') . elixir('js/vendor_admin.js') }}"></script>
@append