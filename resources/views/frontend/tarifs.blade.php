@extends('layouts.public')

@section('title', 'Tarifs et horaires de la salle de sport Myosine')
@section('description', "Tarifs et horaires d'ouverture de la salle de sport Myosine. Tarifs préférentiel pour les étudiants.")

@section('section_title', 'Tarifs & Horaires')

@section('content')

    <div class="row">
        <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                <li role="presentation" class="active"><a href="#tarifs" aria-controls="tarifs" role="tab" data-toggle="tab">Tarifs</a></li>
                <li role="presentation"><a href="#horaires_ouv" aria-controls="horaires_ouv" role="tab" data-toggle="tab">Horaires d'ouverture de la salle</a></li>
                <li role="presentation"><a href="#horaires_cours" aria-controls="horaires_cours" role="tab" data-toggle="tab">Horaires des cours collectifs</a></li>
            </ul>

            <br/>

            <!-- Tab panes -->
            <div class="tab-content">
                <!-- BEGIN "tarif" Panel -->
                <div role="tabpanel" class="tab-pane active fade in" id="tarifs">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Formules</th>
                                <th>Tarifs de base</th>
                                <th>Tarifs étudiants</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tarifs as $tarif)
                                <tr>
                                    <td class="formules">{{ $tarif->nom_tarif }}</td>
                                    <td>{{ $tarif->prix_tarif }} €</td>
                                    <td>{{ $tarif->prixEtu_tarif }} €</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3">Pas de frais d'inscription</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- END "tarif" Panel -->

                <!-- BEGIN "horaires ouverture" Panel -->
                <div role="tabpanel" class="tab-pane fade" id="horaires_ouv">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Jours</th>
                                <th>Matin</th>
                                <th>Après-midi</th>
                            </tr>
                        </thead>
                            <tbody>
                            @foreach ($horairesOuverture as $hor)
                                <tr>
                                    <td class="formules">{{ $hor[0]->jour_horaire }}</td>
                                    <td>{{ $hor[0]->debut_horaire }} - {{ $hor[0]->fin_horaire }}</td>
                                    <td>{{ $hor[1]->debut_horaire }} - {{ $hor[1]->fin_horaire }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3">Libre accès à la salle</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- END "horaires ouverture" Panel -->

                <!-- BEGIN "horaires cours" Panel -->
                <div role="tabpanel" class="tab-pane fade" id="horaires_cours">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Jours</th>
                                <th>Cours</th>
                                <th>Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($horairesCours as $hor)

                                @if(count($hor) > 1)
                                    <tr>
                                        <td class="formules" rowspan="{{ count($hor) }}">{{ $hor[0]->jour_cours }}</td>
                                        <td>{{ $hor[0]->debut_cours }} - {{ $hor[0]->fin_cours }}</td>
                                        <td>{{ $hor[0]->type->libelle_typeC }}</td>
                                    </tr>

                                    @for($i = 1; $i < count($hor); $i++)
                                        <tr>
                                            <td>{{ $hor[$i]->debut_cours }} - {{ $hor[$i]->fin_cours }}</td>
                                            <td>{{ $hor[$i]->type->libelle_typeC }}</td>
                                        </tr>
                                    @endfor
                                @else
                                    <tr>
                                        <td class="formules">{{ $hor[0]->jour_cours }}</td>
                                        <td>{{ $hor[0]->debut_cours }} - {{ $hor[0]->fin_cours }}</td>
                                        <td>{{ $hor[0]->type->libelle_typeC }}</td>
                                    </tr>
                                @endif

                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3">Cours collectifs</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- END "horaires cours" Panel -->
            </div>
        </div>
    </div>
@endsection