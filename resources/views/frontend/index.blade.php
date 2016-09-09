@extends('layouts.public')

@section('content')
    <h1>Myosine</h1>

    <p class="text-justify">
        Est un club de forme à taille humaine.
        Situé en centre ville, à proximité de la gare et du château, la salle de sport Myosine à Angers
        vous proposera des cours collectifs en musique, du fitness, du renforcement musculaire, de la gym,
        du stretching, de la musculation, du cardio, un sauna.
        Programmes personnalisés, suivi individualisé, conseils...
    </p>

    <div class="row">
        <div class="col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
            <a href="{{ URL::route('tarifs_horaires') }}" class="thumbnail">
                <img src="{{URL::to('/')}}/images/fitness.jpg" alt="pas de frais d'inscription"/>

                <div class="caption text-center">
                    <h4><u>Pas de frais d'inscription</u></h4>
                </div>
            </a>
        </div>
    </div>

    <p class="text-justify">
        De nombreuses informations tels que les horaires ou les tarifs sont disponibles sur notre site, n'hésitez pas à les parcourir !!
        De plus, nous vous invitons à decouvrir notre page facebook pour suivre les dernières actualités :
            <span id="facebook">
               <a href="https://www.facebook.com/pages/Myosine-Club-de-fitnessmuscu-%C3%A0-Angers/172764099435829" target=_blank >Facebook </a>
            </span>
    </p>

    <p class="text-justify">
        Un espace détente est mis à votre disposition afin que vous puissiez vous remettre d'aplomb entre chaque série ou entre chaque cours.
    </p>

    <div class="row">
        <div class="col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
            <a href="{{ URL::route('renseignements') }}#sauna" class="thumbnail">
                <img src="{{URL::to('/')}}/images/sauna-thumb.jpg" alt="pas de frais d'inscription"/>

                <div class="caption text-center">
                    <h4><u>Sauna à votre disposition quand vous le souhaitez.</u></h4>
                </div>
            </a>
        </div>
    </div>

    <p class="text-justify">
        Des programmes personnalisés à chacun selon vos objectifs ! Perte de poids, entretien corporel, développement de la masse musculaire, entraînement sportif...
        Un suivi individuel est réalisé pour vous permettre au mieux d'atteindre vos objectifs ! <a href="{{ URL::route('renseignements') }}">En savoir plus</a>
    </p>
@endsection