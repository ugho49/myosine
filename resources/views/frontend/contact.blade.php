@extends('layouts.public')

@section('title', 'Contact et localisation de la salle myosine Angers')
@section('description', "Contactez nous et trouver la salle de sport Myosine facilement ! Fil d'actualité facebook.")

@section('section_title', 'Contact')

@section('content')
    <h3 id="informations">Informations</h3>
    <hr>
    <div class="row">
        <div class="col-md-5 text-center">
            <br>
            <iframe src='https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FMyosine-Club-de-fitnessmuscu-%C3%A0-Angers-172764099435829&tabs=timeline%2C%20events&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId' width='340' height='500' style='border:none;overflow:hidden' scrolling='no' frameborder='0' allowTransparency='true'></iframe>
        </div>
        <div class="col-md-7">
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Téléphone</h3>
                        </div>
                        <div class="panel-body">
                            {{ Session::get('informations')->tel_salle }}
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Adresse</h3>
                        </div>
                        <div class="panel-body">
                            {{ Session::get('informations')->adresse_salle }}
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">carte</h3>
                        </div>
                        <div class="panel-body" style="padding: 0px;">
                            <a href="https://www.google.com/maps/place/{{ Session::get('informations')->adresse_salle }}/" target="_blank">
                                <img class="img-responsive" src="https://maps.googleapis.com/maps/api/staticmap?center={{ Session::get('informations')->adresse_salle }}&zoom=13&scale=2&size=600x220&maptype=roadmap&format=png&visual_refresh=true&markers=size:mid%7Ccolor:0xff0000%7Clabel:%7C{{ Session::get('informations')->adresse_salle }}" alt="Google Map of {{ Session::get('informations')->adresse_salle }}">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <h3 id="contact" style="margin-top:35px;">Nous contacter</h3>
    <hr>

    <div class="row">
        <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ URL::route('contact') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('nom') ? ' has-error' : '' }}">
                    <label for="name" class="control-label">Nom :</label>
                    <input type="text" class="form-control input-md" id="name" placeholder="Prénom - Nom" name="nom" value="{{ old('nom') }}" required="required">
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="control-label">Email :</label>
                    <input type="email" class="form-control input-md" id="email" placeholder="E-mail" name="email" value="{{ old('email') }}" required="required">
                </div>

                <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                    <label for="message" class="control-label">Message :</label>
                    <textarea class="form-control input-md" rows="3" id="message" placeholder="Ici votre message !" name="message" required="required">{{ old('message') }}</textarea>
                </div>

                <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_PUBLIC') }}"></div>

                <div class="text-center">
                    <button class="btn btn-raised btn-success btn-lg" type="submit">Envoyer</button>
                </div>

            </form>
        </div>
    </div>

@endsection

@section('script')
    <script src="https://www.google.com/recaptcha/api.js"></script>
@endsection