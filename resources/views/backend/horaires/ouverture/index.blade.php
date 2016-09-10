@extends('layouts.private')

@section('content')
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
            <form method="post" action="{{ URL::route('login') }}">
                {{ csrf_field() }}

                Horaires Ouverture
            </form>
        </div>
    </div>
@endsection