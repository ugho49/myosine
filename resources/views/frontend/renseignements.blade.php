@extends('layouts.public')

@section('title', 'Renseignement de la salle de fitness et musculation Myosine')
@section('description', 'Profitez de programme personnalisés, perte de poid, entretien corporel, developpement de la masse musculaire, choisissez vos objectifs')

@section('section_title', 'Renseignements')

@section('content')

    <div class="row">
        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
            <h2>Musculation</h2>
            <p class="text-justify">
                Des programmes personnalisés à chacun selon vos objectifs ! Perte de poids, entretien corporel, développement de la masse musculaire, entraînement sportif...
                Un suivi individuel est réalisé pour vous permettre au mieux d'atteindre vos objectifs !
            </p>
        </div>

        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
            <img src="{{URL::to('/')}}/images/muscu.jpg" alt="musculation" class="img-responsive">
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
            <img src="{{URL::to('/')}}/images/totalgym.jpg" alt="totalgym" class="img-responsive">
        </div>

        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
            <h2>Total Gym</h2>
            <p class="text-justify">
                Un cours de renforcement musculaire généralisé, toutes les parties du corps sont sollicitées pendant cinquante minutes.
                Composés d'un échauffement, d'un corps de séance, et d'une période de relaxation/étirement,
                ces cours très complets sont adaptés à tous et vous permettront de vous tenir en forme !
            </p>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
            <h2>Cardio +</h2>
            <p class="text-justify">
                Un cours cardio où l'objectif est de mémoriser un enchaînement à un rythme plus ou moins soutenu afin d'activer les rythmes cardiaque et respiratoire.
                Idéal pour transpirer et se défouler ce cours vous permettra d'éliminer et de vous amuser !
            </p>
        </div>

        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
            <img src="{{URL::to('/')}}/images/cardio+.jpg" alt="cardio+" class="img-responsive">
        </div>
    </div>

    <hr>

    <div class="row" id="sauna">
        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
            <img src="{{URL::to('/')}}/images/sauna.jpg" alt="sauna" class="img-responsive">
        </div>

        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
            <h2>Sauna</h2>
            <p class="text-justify">
                Idéal pour souffler l'espace sauna et l'espace détente sont à votre disposition,
                quand vous le souhaitez !!
            </p>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
            <h2>Cardio</h2>
            <p class="text-justify">
                L'entraînement cardio-vasculaire est la base de votre forme !
                <br><br>
                Un programme est réalisé pour atteindre aux mieux vos objectifs, perte de poids, endurance, échauffement.
                La meilleure façon d'entretenir votre système cardiaque et votre système respiratoire !
            </p>
        </div>

        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
            <img src="{{URL::to('/')}}/images/cardio.jpg" alt="cardio" class="img-responsive">
        </div>
    </div>
@endsection